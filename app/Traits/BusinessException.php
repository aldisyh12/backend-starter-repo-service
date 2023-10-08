<?php

namespace App\Traits;

use App\Helpers\Constants;
use Exception;
use Throwable;

class BusinessException extends Exception
{
    public $message;
    protected $httpStatus;
    protected $code;

    public function __construct(int $httpStatus, string $message = Constants::HTTP_MESSAGE_404, int $code = Constants::HTTP_CODE_404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->httpStatus = $httpStatus;
        $this->code = $code;
        $this->message = $message;
    }

    public function render()
    {
        return abort(response()->json([
            "code" => $this->code,
            "message" => $this->message
        ], $this->httpStatus));
    }
}
