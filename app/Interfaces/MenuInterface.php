<?php

namespace App\Interfaces;
interface MenuInterface
{
    public function get_menu_breed_results(int $menu_id, int $day);

    public function get_menu_company_and_chicks_result(int $company_id);
}
