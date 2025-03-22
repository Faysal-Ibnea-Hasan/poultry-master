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

    public function batch_wise_data_list();
    public function batch_wise_details(int $batch_id);

    public function delete_batch(int $batch_id);

    /*=================================================Expense=========================================================*/
    public function get_feed_expenses(?int $batch_id, ?bool $feed_expenses = false);

    public function get_expense_types();

    public function get_food_types();

    public function get_expenses(?int $batch_id = null);

    public function create_expense(array $data);

    public function update_expense(array $data);

    public function delete_expense(int $expense_id);

    /*=================================================Sell=========================================================*/
    public function create_sell(array $data);

    public function update_sell(array $data);

    public function get_sells(?int $batch_id = null);

    public function delete_sell(int $sell_id);

    /*=================================================Dead Chickens=========================================================*/

    public function create_dead_chicken(array $data);

    public function update_dead_chicken(array $data);

    public function get_dead_chicken_records(?int $batch_id = null);

    public function delete_dead_chicken_record(int $record_id);
}