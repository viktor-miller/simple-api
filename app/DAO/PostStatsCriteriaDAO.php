<?php

namespace App\DAO;

class PostStatsCriteriaDAO
{
    protected ?string $gender = null;

    protected ?string $status = null;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }

        $this->validate();
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    protected function validate(): void
    {
        if ($this->gender && !in_array($this->gender, ['male', 'female'])) {
            $this->gender = null;
        }

        if ($this->status && !in_array($this->status, ['active', 'inactive'])) {
            $this->status = null;
        }
    }
}
