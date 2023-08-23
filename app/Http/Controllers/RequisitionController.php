<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\Link;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Requisition::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requisition = new Requisition();
        $requisition->link_id = $request->input('link_id');
        $requisition->ip = $request->input('ip');
        $requisition->user_agent = $request->input('user_agent');

        if ($requisition->save()) {
            Link::find($request->input('link_id'))->increment('counter');
            return $requisition;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Requisition::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requisition = Requisition::find($id);
        $requisition->link_id = $request->input('link_id');
        $requisition->ip = $request->input('ip');
        $requisition->user_agent = $request->input('user_agent');

        if ($requisition->save()) {
            return $requisition;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requisition = Requisition::findOrFail($id);
        if($requisition->delete()) {
            return $requisition;
        }
    }
}
