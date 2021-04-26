<?php

declare(strict_types=1);

namespace Rezahmady\Smsir\Responses;

class CreditResponse extends BaseResponse
{
    /**
     * @var float
     */
    public $credit;

    public function __construct(bool $isSuccessful, string $message, float $credit)
    {
        $this->isSuccessful = $isSuccessful;
        $this->message = $message;
        $this->credit = $credit;
    }
}
