<?php

namespace N7olkachev\LaravelFilterable;

use N7olkachev\LaravelFilterable\Exceptions\FilterableException;

trait Filterable
{
    public function scopeFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
            if (!$this->isFilterable($key)) {
                throw new FilterableException("[$key] is not allowed for filtering");
            }

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

    protected function isFilterable($key)
    {
        $filterable = $this->filterable ?: [];

        return in_array($key, $filterable);
    }
}