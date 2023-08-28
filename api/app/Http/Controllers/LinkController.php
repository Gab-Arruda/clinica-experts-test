<?php

namespace App\Http\Controllers;

use \App\Http\Requests\StoreUpdateLinkRequest;
use \App\Http\Requests\ListLinkRequest;
use App\Services\LinkService;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class LinkController extends Controller
{
    public function __construct(protected LinkService $service){}

    /**
     * Display a listing of the resource.
     */
    public function index(ListLinkRequest $request)
    {
        return $this->service->list($request->toArray());
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
        try {
            return $this->service->update($request->validated(), $id);
        } catch (\Exception $e) {
            $response = response()->json([
                'message' => 'Invalid data',
                'details' => $e->getMessage(),
            ], $e->getCode());

            throw new HttpResponseException($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->service->delete($id);
    }

    /**
     * Display the amount of links and requisitions.
     */
    public function app_metrics()
    {
        return $this->service->app_metrics();
    }
}
