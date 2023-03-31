<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserVerifyFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
    public function search($query)
    {
        return $this->orWhere('status', 'LIKE', '%' . $query . '%')
            ->orWhere('first_name', 'LIKE', '%' . $query . '%')
            ->orWhere('last_name', 'LIKE', '%' . $query . '%')
            ->orWhere('id_number', 'LIKE', '%' . $query . '%');
    }
}
