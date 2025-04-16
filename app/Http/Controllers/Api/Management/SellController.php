<?php

namespace App\Http\Controllers\Api\Management;

use App\Http\Controllers\Controller;
use App\Interfaces\ManagementInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellController extends Controller
{
    public function __construct(protected ManagementInterface $management)
    {

    }

    public function sells(Request $request)
    {
        if ($request->isMethod('GET')) {
            $validator = Validator::make($request->all(), [
                'batch_id' => 'nullable|exists:batches,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid batch id!',
                    'data' => []
                ]);
            }
            return $this->management->get_sells($request->batch_id);
        } else {
            $validator = Validator::make($request->all(), [
                'id' => 'nullable|exists:sells,id',
                'batch_id' => 'required|exists:batches,id',
                'customer_name' => 'nullable|string|max:255',
                'sell_type' => 'nullable|string',
                'sell_description' => 'nullable|string|max:1000',
                'amount' => 'nullable|string',
                'quantity' => 'nullable|numeric|min:0',
                'unit_price' => 'nullable|integer|min:0',
                'total_weight' => 'nullable|integer|min:0',
                'sale_date' => 'required|date',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'data' => $validator->errors()
                ]);
            }
            if (isset($request->total_weight) && isset($request->unit_price)) {
                $amount = $request->total_weight * $request->unit_price;
                $request['amount'] = $amount;
            } else {
                $request['amount'] = $request->amount;
            }

            // Check if it's an update (e.g., if batch_id is provided)
            if ($request->has('id') && !empty($request->id)) {
                return $this->management->update_sell($request->all());
            } else {
                return $this->management->create_sell($request->all());
            }
        }
    }

    public function deleteSell(Request $request)
    {
        return $this->management->delete_sell($request->id);
    }
}
