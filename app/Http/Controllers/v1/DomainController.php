<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestDomain;
use App\Services\CreateDomain;
use App\Services\UpdateDomain;
use Illuminate\Http\Response;

class DomainController extends Controller
{

    public function store(RequestDomain $request)
    {
        try {
            $domain = (new CreateDomain())->handle($request->all());
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($domain, null, Response::HTTP_CREATED);
    }

    public function update(RequestDomain $request)
    {
        try {
            $domain = (new UpdateDomain())->handle($request->all());
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success($domain);
    }

    public function destroy($id)
    {
        //
    }
}
