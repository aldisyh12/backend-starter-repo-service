<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function all()
    {
        return $this->userService->all();
    }

    public function paginate(Request $request)
    {
        return $this->userService->paginate($request);
    }

    public function create(Request $request)
    {
        return $this->userService->create($request);
    }

    public function show($id)
    {
        return $this->userService->show($id);
    }
}
