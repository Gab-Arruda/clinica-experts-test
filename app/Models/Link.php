<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $table = 'links';
    protected $fillable = ['slug', 'url', 'description', 'counter'];

    public function requisitions()
    {
        return $this->hasMany(
            Requisition::class,
            'link_id',
            'id'
        );
    }
}
