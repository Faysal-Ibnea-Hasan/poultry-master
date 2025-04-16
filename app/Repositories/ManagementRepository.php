<?php

namespace App\Repositories;

use App\Filament\Resources\SellLineResource;
use App\Helpers\Helper;
use App\Http\Resources\BatchDropdownResource;
use App\Http\Resources\BatchListResource;
use App\Http\Resources\BatchWiseDataListResource;
use App\Http\Resources\BatchWiseDetailsResource;
use App\Http\Resources\ChickTypeResource;
use App\Http\Resources\DeadChickenListResource;
use App\Http\Resources\ExpenseListResource;
use App\Http\Resources\ExpenseTypeResource;
use App\Http\Resources\FeedExpenseListResource;
use App\Http\Resources\FoodTypeResource;
use App\Http\Resources\SellListResource;
use App\Http\Resources\SellSummaryResource;
use App\Interfaces\ManagementInterface;
use App\Models\Batch;
use App\Models\ChickType;
use App\Models\DeadChicken;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\FoodType;
use App\Models\Sell;
use App\Models\SellLine;
use Illuminate\Support\Facades\DB;

class ManagementRepository implements ManagementInterface
{
    protected $user;

    public function __construct()
    {
        // Check if the user is authenticated
        if (!Helper::isAuthenticated()) {
            // Return an unauthorized response or throw an exception
            abort(response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401));
        }
        // Store the authenticated user
        $this->user = Helper::getAuthenticatedUser();
    }

    /*=================================================================SEED===============================================================*/
    public function get_batch_for_dropdown()
    {
        $batches = Batch::where('created_by', $this->user->id)
            ->where('status', 'active')
            ->orderBy('batch_number', 'asc')
            ->get();
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
            'data' => ChickTypeResource::collection($chick_type)
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
            $batch = Batch::where('created_by', $this->user->id)
                ->with(['chickType', 'deadChickens'])
                ->where('id', $batch_id)
                ->first();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => new BatchListResource($batch)
            ]);
        } elseif ($old_batch) {
            $batch = Batch::with(['chickType', 'deadChickens'])->where('status', 'terminated')->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => BatchListResource::collection($batch)
            ]);
        } else {
            $batches = Batch::with('chickType')
                ->where('created_by', $this->user->id)
                ->where('status', 'active')->get();
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
            $data['created_by'] = $this->user->id;
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
            $batch_does_not_belongs_to_user = $batch->created_by !== $this->user->id;
            if ($batch_does_not_belongs_to_user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Batch does not belongs to user',
                    'data' => []
                ]);
            }
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
        $batch_does_not_belongs_to_user = $batch->created_by !== $this->user->id;
        if ($batch_does_not_belongs_to_user) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
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

    public function batch_wise_data_list()
    {
        $batches = Batch::with(['chickType'])->latest()->get();
        if ($batches->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => BatchWiseDataListResource::collection($batches)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => []
            ]);
        }
    }

    public function batch_wise_details(int $batch_id)
    {
        $batch = Batch::where('id', $batch_id)->with(['chickType', 'deadChickens', 'expenses.expenseType', 'sells.sellLine'])->first();
        if ($batch) {
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => new BatchWiseDetailsResource($batch)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => []
            ]);
        }
    }

    public function delete_batch(int $batch_id)
    {
        $batch = Batch::find($batch_id);
        $batch_does_not_belongs_to_user = $batch->created_by !== $this->user->id;
        if ($batch_does_not_belongs_to_user) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
        if ($batch) {
            $batch->delete();
            Expense::where('batch_id', $batch->id)->delete();
            Sell::where('batch_id', $batch->id)->delete();
            DeadChicken::where('batch_id', $batch->id)->delete();
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
    public function get_feed_expenses(?int $batch_id, ?bool $feed_expenses = false)
    {
        $expense_type = ExpenseType::where('type', 'food')->first();
        if ($feed_expenses) {
            $expenses = Expense::with(['batch', 'expenseType', 'foodType'])
                ->where('batch_id', $batch_id)
                ->where('expense_type', $expense_type->id)
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'total_sack' => (string)$expenses->sum('number_of_sack'),
                'total_amount' => (string)$expenses->sum('amount'),
                'total_sack_feed_wise' => $expenses->groupBy('foodType.name')->map(fn($group, $key) => [
                    'label' => $key,
                    'value' => (string)$group->sum('number_of_sack')
                ])->values(),
                'data' => FeedExpenseListResource::collection($expenses)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => []
            ]);
        }
    }

    public function create_expense(array $data)
    {
        $batch = Batch::find($data['batch_id']);
        if ($batch->created_by !== $this->user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
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
        $batch = Batch::find($data['batch_id']);
        if ($batch->created_by !== $this->user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
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

    public function get_expenses(?int $batch_id = null)
    {
        if ($batch_id) {
            $batch = Batch::find($batch_id);
            if ($batch->created_by !== $this->user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Batch does not belongs to user',
                    'data' => []
                ]);
            }
            $expense = Expense::with(['batch', 'expenseType', 'foodType'])
                ->whereHas('batch', function ($query) {
                    $query->where('created_by', $this->user->id);
                })
                ->where('batch_id', $batch_id)
                ->latest()
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'total_sack' => (string)$expense->sum('number_of_sack'),
                'total_amount' => (string)$expense->sum('amount'),
                'data' => ExpenseListResource::collection($expense)
            ]);
        } else {
            $expenses = Expense::with(['batch', 'expenseType', 'foodType'])
                ->whereHas('batch', function ($query) {
                    $query->where('created_by', $this->user->id);
                })
                ->latest()
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => ExpenseListResource::collection($expenses)
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

    /*=================================================Expense=========================================================*/

    /*=================================================Sell=========================================================*/
    public function create_sell(array $data)
    {
        $batch = Batch::find($data['batch_id']);
        if ($batch->created_by !== $this->user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
        try {
            DB::beginTransaction();
            $sell = Sell::create([
                'batch_id' => $data['batch_id'],
                'customer_name' => $data['customer_name'] ?? null,
                'sale_date' => $data['sale_date']
            ]);
            if ($sell) {
                SellLine::create([
                    'sell_id' => $sell->id,
                    'sell_description' => $data['sell_description'] ?? null,
                    'product_type' => $data['sell_type'] ?? null,
                    'quantity' => $data['quantity'] ?? null,
                    'total_weight' => $data['total_weight'] ?? null,
                    'unit_price' => $data['unit_price'] ?? null,
                    'amount' => $data['amount'] ?? 0
                ]);
            } else {
                DB::rollBack();
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Sell created successfully!',
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

    public function update_sell(array $data)
    {
        $batch = Batch::find($data['batch_id']);
        if ($batch->created_by !== $this->user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
        try {
            DB::beginTransaction();
            $sell = Sell::find($data['id']);
            if ($sell) {
                $sell->update([
                    'batch_id' => $data['batch_id'],
                    'customer_name' => $data['customer_name'] ?? null,
                    'sale_date' => $data['sale_date']
                ]);
                $sell_line = SellLine::find($sell->id);
                if ($sell_line) {
                    $sell_line->update([
                        'sell_id' => $sell->id,
                        'sell_description' => $data['sell_description'] ?? null,
                        'product_type' => $data['sell_type'] ?? null,
                        'quantity' => $data['quantity'] ?? null,
                        'total_weight' => $data['total_weight'] ?? null,
                        'unit_price' => $data['unit_price'] ?? null,
                        'amount' => $data['amount'] ?? 0
                    ]);
                } else {
                    DB::rollBack();
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Sell updated successfully!',
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

    public function get_sells(?int $batch_id = null)
    {
        if ($batch_id) {
            $batch = Batch::find($batch_id);
            if ($batch->created_by !== $this->user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Batch does not belongs to user',
                    'data' => []
                ]);
            }
            $sell = SellLine::with('sell.batch')
                ->whereHas('sell.batch', fn($q) => $q->where('id', $batch_id))
                ->latest()
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'summary' => new SellSummaryResource($sell),
                'data' => SellListResource::collection($sell)
            ]);
        } else {
            $sells = Sell::with(['batch', 'sellLine'])
                ->whereHas('batch', function ($query) {
                    $query->where('created_by', $this->user->id);
                })
                ->latest()
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => SellListResource::collection($sells)
            ]);
        }
    }

    public function delete_sell(int $sell_id)
    {
        $sell = Sell::find($sell_id);
        $sell_line = SellLine::where('sell_id', $sell->id)->first();
        if ($sell_id) {
            $sell->delete();
            $sell_line->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sell deleted successfully!',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sell not found!',
                'data' => []
            ]);
        }
    }
    /*=================================================Sell=========================================================*/

    /*=================================================Dead Chickens=========================================================*/

    public function create_dead_chicken(array $data)
    {
        $batch = Batch::find($data['batch_id']);
        if ($batch->created_by !== $this->user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
        try {
            DB::beginTransaction();
            $dead_chickens = DeadChicken::create($data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Dead chicken added successfully!',
                'data' => new DeadChickenListResource($dead_chickens)
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

    public function update_dead_chicken(array $data)
    {
        $batch = Batch::find($data['batch_id']);
        if ($batch->created_by !== $this->user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Batch does not belongs to user',
                'data' => []
            ]);
        }
        try {
            DB::beginTransaction();
            $dead_chickens = DeadChicken::find($data['id']);
            if ($dead_chickens) {
                $dead_chickens->update($data);
                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'Dead chicken updated successfully!',
                    'data' => new DeadChickenListResource($dead_chickens)
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Dead chicken data not found!',
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

    public function get_dead_chicken_records(?int $batch_id = null)
    {
        if ($batch_id) {
            $batch = Batch::find($batch_id);
            if ($batch->created_by !== $this->user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Batch does not belongs to user',
                    'data' => []
                ]);
            }
            $dead_chicken = DeadChicken::with('batch')
                ->whereHas('batch', function ($query) {
                    $query->where('created_by', $this->user->id);
                })
                ->where('batch_id', $batch_id)
                ->latest()
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => DeadChickenListResource::collection($dead_chicken)
            ]);
        } else {
            $dead_chickens = DeadChicken::with('batch')
                ->latest()
                ->get();
            return response()->json([
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => DeadChickenListResource::collection($dead_chickens)
            ]);
        }
    }

    public function delete_dead_chicken_record(int $record_id)
    {
        $record = DeadChicken::find($record_id);
        if ($record) {
            $record->delete();
            return response()->json([
                'status' => true,
                'message' => 'Dead chicken record deleted successfully!',
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Dead chicken record not found!',
                'data' => []
            ]);
        }
    }
}
