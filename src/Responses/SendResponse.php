<?php

namespace Rezahmady\Smsir\Responses;

class SendResponse extends BaseResponse
{
    /**
     * @var SentMessage[]
     */
    public $sentMessages;

    /**
     * @var string
     */
    public $batchKey;

    public function __construct(bool $isSuccessful, string $message, string $batchKey, array $sentMessages)
    {
        $this->isSuccessful = $isSuccessful;
        $this->message = $message;
        $this->batchKey = $batchKey;
        $this->sentMessages = $sentMessages;
    }
}
