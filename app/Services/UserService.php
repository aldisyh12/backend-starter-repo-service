<?php

namespace App\Services;

use App\Helpers\Constants;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\BaseResponse;
use App\Traits\BusinessException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserService
{
    use BaseResponse;

//    public function __construct(UserRepository $userRepository)
//    {
//        $this->userRepository = $userRepository;
//    }

    public function all()
    {
        $record = User::all();

        return self::buildResponse(
            Constants::HTTP_CODE_200,
            Constants::HTTP_MESSAGE_200,
            $record
        );
    }

    public function paginate(Request $request)
    {
        return self::buildResponse(
            Constants::HTTP_CODE_200,
            Constants::HTTP_MESSAGE_200,
            User::paginate($request->per_page)
        );
    }

    public function create($request)
    {
        try{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (\Exception $exception){
            Log::error(Constants::ERROR, [ 'message' => $exception->getMessage()]);
            throw new BusinessException(Constants::HTTP_CODE_500, Constants::HTTP_MESSAGE_500, Constants::HTTP_CODE_500);
        }

        return self::statusResponse(
            Constants::HTTP_CODE_200,
            Constants::HTTP_MESSAGE_200
        );
    }

    public function show($id)
    {
        try{
            $user = User::find($id);
        } catch (\Exception $exception){
            Log::error(Constants::ERROR, [ 'message' => $exception->getMessage()]);
            throw new BusinessException(Constants::HTTP_CODE_500, Constants::HTTP_MESSAGE_500, Constants::HTTP_CODE_500);
        }

        return self::buildResponse(
            Constants::HTTP_CODE_200,
            Constants::HTTP_MESSAGE_200,
            $user
        );
    }
}
