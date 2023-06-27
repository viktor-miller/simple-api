<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;

class DataLoader
{
    protected array $handlers = [];

    public function __construct(
        private PendingRequest $httpClient
    ) {}

    public function handle(): void
    {
        foreach ($this->handlers as $url => $handler) {
            $this->load($url, $handler);
        }
    }

    /**
     * Add a new handler to stack.
     */
    public function addHandler(string $url, CreateOrUpdateHandler $handler): self
    {
        $this->handlers[$url] = $handler;

        return $this;
    }

    /**
     * Load data and delegate to the handler.
     */
    protected function load(string $url, CreateOrUpdateHandler $handler): void
    {
        $data = $this->getData($url);

        array_walk($data, fn($row) => $handler->createOrUpdate($row));
    }

    /**
     * Load data and get as array back.
     */
    protected function getData(string $url): array
    {
        $response = $this->httpClient->get($url);

        if ($response->failed()) {
            throw new \RuntimeException(
                sprintf('Http request to url %s failed.', $url));
        }

        return $response->json();
    }
}
