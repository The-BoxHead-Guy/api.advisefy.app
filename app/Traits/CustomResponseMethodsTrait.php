<?php

namespace App\Traits;

trait CustomResponseMethodsTrait
{
    public function withMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function withCode(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function withData($data): self
    {
        $this->data = $data;
        return $this;
    }

    public function withErrors($errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function withMeta(array $meta): self
    {
        $this->meta = array_merge($this->meta, $meta);
        return $this;
    }
}
