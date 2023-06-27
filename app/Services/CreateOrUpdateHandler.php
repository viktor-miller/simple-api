<?php

namespace App\Services;

interface CreateOrUpdateHandler
{
    public function createOrUpdate(array $data): void;
}
