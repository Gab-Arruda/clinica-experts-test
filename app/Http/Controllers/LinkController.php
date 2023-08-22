<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Link::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $link = new Link();
        $link->slug = $request->input('slug');
        $link->url = $request->input('url');
        $link->description = $request->input('description');

        if ($link->save()) {
            return $link;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Link::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Link::findOrFail($id);
        $link->slug = $request->slug;
        $link->url = $request->url;
        $link->description = $request->description;
        if($link->save()) {
            return $link;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::findOrFail($id);
        if($link->delete()) {
            return $link;
        }
    }
}
