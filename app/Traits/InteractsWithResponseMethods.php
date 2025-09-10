<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

/**
 * Trait InteractsWithResponseMethods
 *
 * Provides common methods and meta handling for API responses.
 */
trait InteractsWithResponseMethods
{
    /**
     * @var string ISO8601 formatted current timestamp
     */
    protected $currentTime;

    /**
     * @var string API version string
     */
    protected $apiVersion;

    /**
     * @var string Copyright notice
     */
    protected $copyright;

    /**
     * Set the meta properties (timestamp, apiVersion)
     *
     * @return void
     */
    protected function setMeta()
    {
        $this->currentTime = Carbon::now()->toIso8601String();
        $this->apiVersion = config('api.version', 'v1.0.0');
        $this->copyright = config('api.copyright');
    }

    /**
     * Generate the meta block for the response
     *
     * @return array<string, mixed> The meta information for the response
     */
    protected function withMeta(): array
    {
        $this->setMeta();

        return [
            'timestamp' => $this->currentTime,
            'api_version' => $this->apiVersion,
            'copyright' => $this->copyright,
        ];
    }

    /**
     * Set the response message
     *
     * @param string $message
     * @return $this
     */
    public function withMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Set the response status code
     *
     * @param int $status
     * @return $this
     */
    public function withCode(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set the response data
     *
     * @param mixed $data
     * @return $this
     */
    public function withData($data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set the response errors
     *
     * @param mixed $errors
     * @return $this
     */
    public function withErrors($errors): self
    {
        $this->errors = $errors;
        return $this;
    }
}
