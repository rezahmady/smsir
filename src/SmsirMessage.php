<?php

namespace Rezahmady\Smsir;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Rezahmady\Smsir\Facades\Smsir;

class SmsirMessage
{
    public $mobileNumber;
    
    public $templateId;
    
    public $parameters;
    
    public $method;
    
    public $code;

    public $to;

    public function trigger()
    {
        switch ($this->method) {
            case 'ultraFastSend':
                try {
                    return Smsir::ultraFastSend($this->parameters, $this->templateId, $this->to);
                } catch (\GuzzleHttp\Exception\GuzzleException $e) {
                    Log::error($e->getMessage());
                }
                break;
            case 'sendVerificationCode':
                try {
                    return Smsir::sendVerificationCode($this->code, $this->to);
                } catch (\GuzzleHttp\Exception\GuzzleException $e) {
                    Log::error($e->getMessage());
                }
                break;
            default:
                # code...
                break;
        }
    }


    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        
        return $this;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        
        return $this;
    }

    public function setCode($code)
    {
        $this->code = $code;
        
        return $this;
    }

    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
        
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        
        return $this;
    }
}
