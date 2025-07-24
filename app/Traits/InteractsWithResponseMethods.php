<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait InteractsWithResponseMethods
{
    /**
     * Generate the meta block for the response
     *
     * @return array<string, mixed>
     */
    protected function withMeta(): array
    {
        $currentTime = Carbon::now()->toIso8601String();
        $apiVersion = config('api.version', 'v1.0.0');
        $copyright = '© 2025 api.advisefy.app. All rights reserved.';

        $meta = [
            'timestamp' => $currentTime,
            'api_version' => $apiVersion,
            'copyright' => $copyright,
        ];

        return $meta;
    }

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
}
