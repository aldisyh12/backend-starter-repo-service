<?php

namespace App\Traits;

use App\Helpers\Constants;
use Illuminate\Http\Response;

trait BaseResponse
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param int $code
     * @param string $status
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function buildResponse(int $code = Constants::HTTP_CODE_404, string $status = Constants::HTTP_MESSAGE_404, $data = [])
    {
        return response()->json(array(
            'code' => $code,
            'status' => $status,
            'data' => $data
        ));
    }

    /**
     * @param int $code
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function statusResponse(int $code = Constants::HTTP_CODE_404, string $status = Constants::HTTP_MESSAGE_404)
    {
        return response()->json(array(
            'code' => $code,
            'status' => $status
        ));
    }
}
