<?php

namespace App\Services;

use App\Models\Link;

class LinkService
{
    public function list()
    {
        return Link::all();
    }

    public function store(array $params) {
        $link = new Link();
        $link->slug = empty($params['slug']) ? $this->random_str() : $params['slug'];
        $link->url = $params['url'];
        $link->description = $params['description'];

        if ($link->save()) {
            return $link;
        }
    }

    public function show(int $id) {
        return Link::with('requisitions')->find($id);
    }

    public function update(array $params, int $id) {
        $link = Link::findOrFail($id);
        $link->slug = empty($params['slug']) ? $this->random_str() : $params['slug'];
        $link->url = $params['url'];
        $link->description = $params['description'];

        if ($link->save()) {
            return $link;
        }
    }

    public function delete(int $id) {
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
