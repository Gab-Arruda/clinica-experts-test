<?php

namespace App\Http\Controllers;

use \App\Http\Requests\StoreUpdateLinkRequest;
use App\Services\LinkService;

class LinkController extends Controller
{
    protected LinkService $service;

    public function __construct(LinkService $service)
    {
        $this->service = $service;
    }

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
    public function store(StoreUpdateLinkRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // return Link::with('requisitions')->find($id);
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateLinkRequest $request, int $id)
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
