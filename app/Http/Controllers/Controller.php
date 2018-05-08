<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function _index($request)
    {
        return $this->service->index($request);
    }

    protected function _show($request, $model)
    {
        return $this->service->show($request, $model);
    }

    protected function _store($request)
    {
        return $this->service->store($request);
    }

    protected function _update($request, $model)
    {
        return $this->service->update($request, $model);
    }

    protected function _destroy($model)
    {
        $this->service->destroy($model);
        return response()->json([], 204);
    }
}
