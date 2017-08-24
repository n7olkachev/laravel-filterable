<?php

namespace N7olkachev\LaravelFilterable;

trait Filterable
{
    public function scopeFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
            if (is_null($value) || $value === '') continue;
            if (method_exists($this, 'scope' . ucfirst(camel_case($key)))) {
                $query->{ucfirst(camel_case($key))}($value);
            } else if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }
    }
}