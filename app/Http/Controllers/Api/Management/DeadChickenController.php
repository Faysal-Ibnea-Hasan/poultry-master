<?php

namespace App\Http\Controllers\Api\Management;

use App\Http\Controllers\Controller;
use App\Interfaces\ManagementInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeadChickenController extends Controller
{
    public function __construct(protected ManagementInterface $management)
    {

    }

    public function deadChickens(Request $request)
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

            return $this->management->get_dead_chicken_records($request->batch_id);
        } else{
            $validator = Validator::make($request->all(), [
                'id' => 'nullable|exists:dead_chickens,id',
                'batch_id' => 'required|exists:batches,id',
                'quantity' => 'required|numeric|min:0',
                'date' => 'required|date',
                'reason' => 'nullable|string'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'data' => []
                ]);
            }
            // Check if it's an update (e.g., if batch_id is provided)
            if ($request->has('id') && !empty($request->id)) {
                return $this->management->update_dead_chicken($request->all());
            } else {
                return $this->management->create_dead_chicken($request->all());
            }
        }

    }

    public function deleteDeadChickenRecord(Request $request)
    {
        return $this->management->delete_dead_chicken_record($request->id);
    }
}
