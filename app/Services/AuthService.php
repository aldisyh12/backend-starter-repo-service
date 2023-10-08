<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Traits\BaseResponse;
use App\Traits\BusinessException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    use BaseResponse;
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)) {
            try {
                $user = Auth::user();
                $token = $user->createToken('SSTOken')->accessToken;
            } catch (\Exception $exception) {
                Log::error(Constants::ERROR, [ 'message' => $exception->getMessage()]);
                throw new BusinessException(Constants::HTTP_CODE_500, Constants::HTTP_MESSAGE_500, Constants::HTTP_CODE_500);
            }

            return self::buildResponse(
                Constants::HTTP_CODE_200,
                Constants::HTTP_MESSAGE_200,
                $token
            );
        }
    }
}
