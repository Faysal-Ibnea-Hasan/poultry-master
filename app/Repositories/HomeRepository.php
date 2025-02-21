<?php

namespace App\Repositories;

use App\Interfaces\HomeInterface;
use App\Models\Option;

class HomeRepository implements HomeInterface
{
    public function getMenu()
    {
        return Option::select('options.*')
            ->join('design_types', 'options.design_type_id', '=', 'design_types.id')
            ->where('options.status', 1)
            ->where('design_types.status', 1)
            ->orderBy('design_types.order', 'asc')
            ->orderBy('options.order', 'asc')
            ->with('designType')
            ->get();
    }

}
