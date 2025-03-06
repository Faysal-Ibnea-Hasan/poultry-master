<?php

namespace App\Repositories;

use App\Interfaces\MenuInterface;
use App\Models\CompanyAndChick;
use App\Models\OptionResult;

class MenuRepository implements MenuInterface
{
    public function get_menu_breed_results(int $menu_id, int $day)
    {
        $menu_results = OptionResult::with(['attribute', 'breed'])->where('option_id', $menu_id)
            ->where('day', $day)
            ->get();
        if ($menu_results->isEmpty()) {
            return false;
        }
        return $menu_results;
    }

    public function get_menu_company_and_chicks_result(int $company_id)
    {
        $menu_results = CompanyAndChick::with(['company', 'breed', 'chickType'])->where('company_id', $company_id)->get();
        if ($menu_results->isEmpty()) {
            return false;
        }
        return $menu_results;
    }
}