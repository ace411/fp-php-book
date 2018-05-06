<?php

class HttpMessage
{
    private $code;

    private $response;

    public function __construct(int $code, string $response)
    {
        $this->code = $code;
        $this->response = $response;
    }

    public function verify(HttpMessage $message) : bool
    {
        return $this->code == $message->code &&
            $this->response == $message->response;
    }

    public function newMessage(int $code, string $response) : HttpMessage
    {
        $newMessage = clone $this;
        $newMessage->code = $code;
        $newMessage->response = $response;
        return $newMessage;
    }
}

$ok = new HttpMessage(200, 'OK');

$created = $ok->newMessage(201, 'Created');

echo $ok->verify($created) ? 'Value objects are equal' : 'Value objects are not equal';