<?php

namespace App\Libraries\Responder;

use Illuminate\Http\JsonResponse;

class ResponseBuilder
{
    private $message;
    private $status_code;
    private $status = 200;
    private $data;

    /**
     * @param string $message
     * @return ResponseBuilder
     */
    public function setMessage(string $message): ResponseBuilder
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param int $status_code
     * @return ResponseBuilder
     */
    public function setStatusCode(int $status_code): ResponseBuilder
    {
        $this->status_code = $status_code;
        return $this;
    }

    /**
     * @param $data
     * @return ResponseBuilder
     */
    public function setData($data): ResponseBuilder
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->status_code;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function respond(): JsonResponse
    {
        $response = [
            'Code' => $this->status,
            'Message' => $this->message ?? trans('messages.success_status.status')
        ];
        if (isset($this->data)) {
            $response['Data'] = $this->data;
        }
        return response()
            ->json($response, $this->status_code ?? 200);
    }

    public function respondStore(): JsonResponse
    {
        $this->setMessage(trans('messages.success_store.status'));

        return $this->respond();
    }
    public function respondDelete(): JsonResponse
    {
        $this->setStatus(204);
        $this->setMessage(trans('messages.success_delete.status'));

        return $this->respond();
    }

    public function respondUpdate(): JsonResponse
    {
        $this->setMessage(trans('messages.success_update.status'));

        return $this->respond();
    }

    /**
     * @param int $status
     * @return ResponseBuilder
     */
    public function setStatus(int $status): ResponseBuilder
    {
        $this->status = $status;
        return $this;
    }

    public function respondNotFound(): JsonResponse
    {
        $this->setMessage($this->message ?? trans('messages.not_found_status.status'));
        $this->setStatus(404);

        return $this->respond();
    }

    public function respondError(): JsonResponse
    {
        $this->setMessage($this->message ?? trans('messages.error_status.status'));
        $this->setStatus(500);

        return $this->respond();
    }

}
