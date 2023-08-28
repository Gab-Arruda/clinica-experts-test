<?php

namespace App\Http\Controllers;

use \App\Http\Requests\StoreRequisitionRequest;
use App\Services\RequisitionService;

class RequisitionController extends Controller
{
    public function __construct(protected RequisitionService $service){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->list();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequisitionRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequisitionRequest $request, string $id)
    {
        return $this->service->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->service->delete($id);
    }
}
