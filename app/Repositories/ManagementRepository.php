<?php

namespace App\Repositories;

use App\Http\Resources\BatchDropdownResource;
use App\Http\Resources\BatchListResource;
use App\Http\Resources\ExpenseListResource;
use App\Http\Resources\ExpenseTypeResource;
use App\Http\Resources\FoodTypeResource;
use App\Interfaces\ManagementInterface;
use App\Models\Batch;
use App\Models\ChickType;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\FoodType;
use Illuminate\Support\Facades\DB;

class ManagementRepository implements ManagementInterface
{
    /*=================================================================SEED===============================================================*/
    public function get_batch_for_dropdown()
    {
        $batches = Batch::where('status', 'active')->orderBy('batch_number', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => BatchDropdownResource::collection($batches)
        ]);
    }

    public function get_chick_types()
    {
        $chick_type = ChickType::all();
        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => $chick_type
        ]);
    }

    public function get_expense_types()
    {
        $types = ExpenseType::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => ExpenseTypeResource::collection($types)
        ]);
    }

    public function get_food_types()
    {
        $food_types = FoodType::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data fetched successfully',
            'data' => FoodTypeResource::collection($food_types)
        ]);
    }

    /*=================================================================SEED===============================================================*/

    public function get_batches(?int $batch_id = null, ?bool $old_batch = false)
    {
        if ($batch_id) {
            $batch = Batch::with('chickType')->where('id', $batch_id)->first();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => new BatchListResource($batch)
            ]);
        } elseif ($old_batch) {
            $batch = Batch::with('chickType')->where('status', 'terminated')->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => BatchListResource::collection($batch)
            ]);
        } else {
            $batches = Batch::with('chickType')->where('status', 'active')->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => BatchListResource::collection($batches)
            ]);
        }
    }

    public function create_batch(array $data)
    {
        try {
            DB::beginTransaction();
            $batch = Batch::create($data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Batch created successfully!',
                'data' => new BatchListResource($batch)
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => []
            ]);
        }
    }

    public function update_batch(array $data)
    {
        try {
            DB::beginTransaction();
            $batch = Batch::find($data['id']);
            if ($batch) {
                $batch->update($data);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Batch updated successfully!',
                    'data' => new BatchListResource($batch)
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Batch not found!',
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => []
            ]);
        }
    }

    public function add_batch_to_old(string $batch_id)
    {
        $batch = Batch::find($batch_id);
        if ($batch) {
            if ($batch->status == 'active') {
                $batch->update(['status' => 'terminated']);
                return response()->json([
                    'status' => true,
                    'message' => 'Batch moved to old successfully!',
                    'data' => []
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Batch is already terminated or inactive!',
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data not found',
                'data' => []
            ]);
        }
    }

    public function delete_batch(int $batch_id)
    {
        $batch = Batch::find($batch_id);
        if ($batch) {
            $batch->delete();
            return response()->json([
                'status' => true,
                'message' => 'Batch deleted successfully!',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Batch not found!',
                'data' => []
            ]);
        }
    }

    /*=================================================Expense=========================================================*/
    public function create_expense(array $data)
    {
        try {
            DB::beginTransaction();
            $expense = Expense::create($data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Expense created successfully!',
                'data' => new ExpenseListResource($expense)
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => []
            ]);
        }
    }

    public function update_expense(array $data)
    {
        try {
            DB::beginTransaction();
            $expense = Expense::find($data['id']);
            if ($expense) {
                $expense->update($data);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Expense updated successfully!',
                    'data' => new ExpenseListResource($expense)
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Expense not found!',
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'data' => []
            ]);
        }
    }

    public function get_expenses(?int $expense_id = null)
    {
        if ($expense_id) {
            $expense = Expense::with(['batch', 'expenseType', 'foodType'])->first();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => new ExpenseListResource($expense)
            ]);
        } else {
            $expense = Expense::with(['batch', 'expenseType', 'foodType'])->latest()->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => ExpenseListResource::collection($expense)
            ]);
        }
    }
    public function delete_expense(int $expense_id)
    {
        $expense = Expense::find($expense_id);
        if ($expense) {
            $expense->delete();
            return response()->json([
                'status' => true,
                'message' => 'Expense deleted successfully!',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Expense not found!',
                'data' => []
            ]);
        }
    }
}
