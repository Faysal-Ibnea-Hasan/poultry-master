<?php

namespace App\Repositories;

use App\Interfaces\HomeInterface;
use App\Models\Company;
use App\Models\Option;

class HomeRepository implements HomeInterface
{
    public function getMenu()
    {
        $options = Option::select('options.*')
            ->join('design_types', 'options.design_type_id', '=', 'design_types.id')
            ->where('options.status', 1)
            ->where('design_types.status', 1)
            ->orderBy('design_types.order', 'asc')
            ->orderBy('options.order', 'asc')
            ->with('designType')
            ->get()
            ->sortBy(function ($option) {
                // Access patches through the dynamic attribute
                $patches = $option->patches; // This will call the getPatchesAttribute method
                // Sort by the first patch's order (if it exists)
                return $patches->first()->order ?? PHP_INT_MAX; // Default to max int if no patches
            });
    }

    public function getCompanies()
    {
        $companies = Company::all();
    }

}
