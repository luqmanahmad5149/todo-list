<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{
    private $errorCode;

    public function __construct(string $message=null,int $errorCode=null)
    {
        $this->message = $message ? $message : "Something went wrong";
        $this->errorCode = $errorCode ? $errorCode : 500;
    }

    public function render(){
        return $this->respond_error($this->message,$this->errorCode);
    }

    public function respond_error($errorMessage="Something went wrong", $errorCode=500){
        if(!$errorMessage) $errorMessage = "Something went wrong";
        $result = [
            'status' => 0,
            'error_cd' => $errorCode,
            'error_msg' => $errorMessage,
    
        ];
        return response()->json($result, $errorCode);
    }
}
