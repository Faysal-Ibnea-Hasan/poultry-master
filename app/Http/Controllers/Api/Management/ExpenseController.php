<?php

namespace App\Http\Controllers\Api\Management;

use App\Http\Controllers\Controller;
use App\Interfaces\ManagementInterface;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function __construct(protected ManagementInterface $management)
    {

    }

    public function expenseTypes()
    {
        return $this->management->get_expense_types();
    }

    public function foodTypes()
    {
        return $this->management->get_food_types();
    }

    public function expenses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:expenses,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid batch id!',
                'data' => []
            ]);
        }
        return $this->management->get_expenses($request->id);
    }

    public function createOrUpdateExpense(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:expenses,id',
            'batch_id' => 'required|exists:batches,id',
            'expense_type' => 'required|integer|exists:expense_types,id',
            'amount' => 'nullable|numeric|min:0',
            'number_of_sack' => 'nullable|integer|min:0',
            'cost_per_sack' => 'nullable|integer|min:0',
            'food_type' => 'nullable|integer|exists:food_types,id',
            'date' => 'required|date|date_format:d-m-Y',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'data' => []
            ]);
        }
        // If the Expense type is food
        $expense_type = ExpenseType::find($request->expense_type);
        $is_expense_type_is_food = $expense_type->type == 'food';
        if ($is_expense_type_is_food) {
            $number_of_sack = $request->number_of_sack;
            $cost_per_sack = $request->cost_per_sack;
            $request['amount'] = $number_of_sack * $cost_per_sack;
        }
        // Check if it's an update (e.g., if batch_id is provided)
        if ($request->has('id')) {
            return $this->management->update_expense($request->all());
        } else {
            return $this->management->create_expense($request->all());
        }
    }

    public function deleteExpense(Request $request)
    {
        return $this->management->delete_expense($request->id);
    }
}
