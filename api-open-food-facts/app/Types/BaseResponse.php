<?php

namespace App\Types;

class BaseResponse {
    public $success;
    public $data;
    public $message;
    public $status;

    public function __construct($data, $success = true, $message = '', $status = 'active' ) {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
        $this->status = $status;
    }
}