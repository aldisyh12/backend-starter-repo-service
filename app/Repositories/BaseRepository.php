<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(Request $request)
    {
        return $this->model->all($request);
    }

    public function get()
    {
        return $this->model->get();
    }

    public function paginate($params)
    {
        return $this->model->paginate($params);
    }

    public function create($request)
    {
        return $this->model->save($request);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }
}
