<?php

namespace App\Http\Controllers;

use App\Models\Link;
use \App\Http\Requests\StoreUpdateLinkRequest;
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
    public function store(StoreUpdateLinkRequest $request)
    {
        $link = new Link();
        $link->slug = empty($request->input('slug')) ? $this->random_str() : $request->input('slug');
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
        return Link::with('requisitions')->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Link::findOrFail($id);
        $link->slug = empty($request->input('slug')) ? $this->random_str() : $request->input('slug');
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

    private function random_str(
        int $length = 8,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;

        while(Link::where('slug', implode('', $pieces))->doesntExist()) {
            for ($i = 0; $i < $length; ++$i) {
                $pieces []= $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }
    }
}
