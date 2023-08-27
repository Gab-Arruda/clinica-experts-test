<?php

namespace App\Services;

use App\Models\Link;
use App\Models\Requisition;


class LinkService
{
    public function list(array $params)
    {
        $link = Link::query();
        if(isset($params['filterByColumn']) && isset($params['filterOrderType'])) {
            $link->orderBy($params['filterByColumn'], $params['filterOrderType']);
        }
        if(isset($params['searchString'])) {
            $link->where('slug', 'LIKE', '%'.$params['searchString'].'%')
                ->OrWhere('url', 'LIKE', '%'.$params['searchString'].'%')
                ->OrWhere('description', 'LIKE', '%'.$params['searchString'].'%');
        }

        return $link->get();
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
        return Link::with('requisitions')->findOrFail($id);
    }

    public function update(array $params, int $id) {
        $link = Link::findOrFail($id);
        $existingLink = Link::where('slug', $params['slug'])->first();
        if($existingLink && $existingLink->id != $id) {
            throw new \Exception("Slug already taken", 422);
        }
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

    public function app_metrics() {
        return [
            'links_amount' => Link::count(),
            'requisitions_amount' => Requisition::count(),
            'requisitions_this_month' => Link::sum('counter')
        ];
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
