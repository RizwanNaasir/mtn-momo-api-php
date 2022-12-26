<?php

namespace RizwanNasir\MtnMomo\Http;

use RizwanNasir\MtnMomo\Utilities\AttributesMassAssignable;


class ApiResponse
{
    use AttributesMassAssignable;

    /**
     * Construct object
     *
     * @param int $statusCode
     * @param string $content
     * @param array $headers
     * @param null $requestData
     */
    public function __construct(
        public int      $statusCode,
        public string   $content,
        protected array $headers = array(),
        protected       $requestData = null)
    {
        /**
         * Dynamically create class variables from content array, so content can be accessed directly.
         * eg $response->category, $response->user_id for ['category'=> 'Electronics','user_id'=> 4]
         * $this->content must be set before calling $this->massAssignAttributes()
         */
        $this->massAssignAttributes($this->toArray());
    }

    /**
     * Get array format of api response
     * @return array|null
     */
    public function toArray(): ?array
    {
        return json_decode($this->content, true);
    }

    /**
     * Get json format of api response
     * @return string
     */
    public function toJson(): string
    {
        return $this->content;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Checks if api call was successful ie 200, 201 etc
     * return bool
     */
    public function isSuccess(): bool
    {
        return $this->getStatusCode() < 400;
    }

    /**
     * Get the status code of the response
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function __toString()
    {
        return '[Response] HTTP ' . $this->getStatusCode() . ' ' . $this->content;
    }
}
