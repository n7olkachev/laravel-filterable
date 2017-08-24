<?php

namespace N7olkachev\LaravelFilterable;

trait Filterable
{
    public function scopeFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
            if (is_null($value) || $value === '') continue;

            $scopeName = ucfirst(camel_case($key));

            if (method_exists($this, 'scope' . $scopeName)) {
                $query->$scopeName($value);
            } else if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }
    }
}