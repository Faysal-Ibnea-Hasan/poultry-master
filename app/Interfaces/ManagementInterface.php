<?php

namespace App\Interfaces;
interface ManagementInterface
{
    /*=================================================Batch=========================================================*/
    public function add_batch_to_old(string $batch_id);

    public function get_batch_for_dropdown();

    public function get_chick_types();

    public function get_batches(?int $batch_id, ?bool $old_batch);

    public function create_batch(array $data);

    public function update_batch(array $data);

    public function delete_batch(int $batch_id);

    /*=================================================Expense=========================================================*/
    public function get_expense_types();

    public function get_food_types();

    public function get_expenses(?int $expense_id = null);

    public function create_expense(array $data);

    public function update_expense(array $data);

    public function delete_expense(int $expense_id);
}