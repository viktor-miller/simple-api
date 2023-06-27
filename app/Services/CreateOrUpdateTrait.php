<?php

namespace App\Services;

use InvalidArgumentException;

trait CreateOrUpdateTrait
{
    /**
     * The method updated the data in DB or create a new one.
     */
    public function createOrUpdate(array $data): void
    {
        if (!isset($data['id'])) {
            throw new InvalidArgumentException('Missing id key.');
        }

        $id = $data['id'];

        if ($obj = $this->find($id)) {
            $this->update($obj, $data);
        } else {
            $this->create($data);
        }
    }
}
