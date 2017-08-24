<?php

namespace N7olkachev\LaravelFilterable\Test\Models;

use Illuminate\Database\Eloquent\Model;
use N7olkachev\LaravelFilterable\Filterable;

class Page extends Model
{
    use Filterable;

    protected $fillable = [
        'title',
        'created_at',
    ];

    public function scopeCreatedAfter($query, $time)
    {
        return $query->where('created_at', '>', $time);
    }
}