<?php

namespace App\Services;

class Service
{
    public function index($request)
    {
        $data = $this->model->query();
        $data = $this->sort($data, $request);
        return $this->paginate($data, $request);
    }

    public function show($request, $id)
    {
        return $this->model->find($id);
    }

    public function store($request)
    {
        return $this->model->create($request->toArray());
    }

    public function update($request, $id)
    {
        return $this->model->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->model->delete($id);
    }

    protected function sort($data, $request)
    {
        if ($request->has('sort')) {
            $sortFields = explode(',', $request->input('sort'));
            foreach ($sortFields as $sortField) {
                $sort = explode('|', $sortField);
                $field = $sort[0];
                $direction = $sort[1];
                $data = $data->orderBy($field, $direction);
            } 
        }

        return $data;
    }

    protected function paginate($data, $request)
    {
        if($request->has('per_page')) {
            $per_page = $request->input('per_page');
            return $data->paginate($per_page);
        }
        
        return $data->get();
    }
}