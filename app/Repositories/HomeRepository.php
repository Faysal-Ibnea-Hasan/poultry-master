<?php

namespace App\Repositories;

use App\Interfaces\HomeInterface;
use App\Models\Company;
use App\Models\Option;
use App\Models\Patch;

class HomeRepository implements HomeInterface
{
    public function getMenu()
    {
        return Patch::with([
            'designType' => function ($query) {
                $query->where('status', 1); // Ensure only active design types
            },
            'options' => function ($query) {
                $query->where('status', 1)
                    ->whereHas('designType', function ($q) {
                        $q->where('status', 1); // Ensure option's design type is active
                    })
                    ->with('designType')
                    ->orderBy('order', 'asc');
            }
        ])
            ->where('status', 1)
            ->whereHas('designType', function ($query) {
                $query->where('status', 1); // Ensure patch's design type is active
            })
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getCompanies()
    {
        return Company::all();
    }

}
