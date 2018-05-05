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

    protected function _show($request, $id)
    {
        return $this->service->show($request, $id);
    }

    protected function _store($request)
    {
        return $this->service->store($request);
    }

    protected function _update($request, $id)
    {
        return $this->service->update($request, $id);
    }

    protected function _destroy($id)
    {
        return $this->service->destroy($id);
    }
}
