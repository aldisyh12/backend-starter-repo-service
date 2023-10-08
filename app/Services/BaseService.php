<?php

namespace App\Services;

use Illuminate\Http\Request;

interface BaseService
{
    public function all();

    public function paginate(Request $request);

    public function create(Request $request);
}
