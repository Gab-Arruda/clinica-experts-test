<?php

namespace App\Services;

use App\Models\Requisition;
use App\Models\Link;

class RequisitionService
{
    public function list()
    {
        return Requisition::all();
    }

    public function store(array $params) {
        $requisition = new Requisition();
        $requisition->link_id = $params['link_id'];
        $requisition->ip = $params['ip'];
        $requisition->user_agent = $params['user_agent'];

        if ($requisition->save()) {
            Link::find($params['link_id'])->increment('counter');
            return $requisition;
        }
    }

    public function show(int $id) {
        return Requisition::findOrFail($id);
    }

    public function update(array $params, int $id) {
        $requisition = Requisition::findOrFail($id);
        $requisition->link_id = $params['link_id'];
        $requisition->ip = $params['ip'];
        $requisition->user_agent = $params['user_agent'];

        if ($requisition->save()) {
            return $requisition;
        }
    }

    public function delete(int $id) {
        $link = Requisition::findOrFail($id);
        if($link->delete()) {
            return $link;
        }
    }
}
