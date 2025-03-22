<?php

namespace App\Http\Controllers\Api\Management;

use App\Http\Controllers\Controller;
use App\Interfaces\ManagementInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchManagementController extends Controller
{
    public function __construct(protected ManagementInterface $management)
    {

    }

    public function batchDropdown()
    {
        return $this->management->get_batch_for_dropdown();
    }

    public function chickTypes()
    {
        return $this->management->get_chick_types();
    }

    public function batches(Request $request)
    {
        if ($request->isMethod('GET')) {
            $validator = Validator::make($request->all(), [
                'id' => 'nullable|exists:batches,id',
                'old_batch' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid batch id!',
                    'data' => []
                ]);
            }
            return $this->management->get_batches($request->id, $request->old_batch);
        } else {
            $validator = Validator::make($request->all(), [
                'id' => 'nullable|exists:batches,id',
                'batch_number' => 'required|string|unique:batches,batch_number,' . $request->id,
                'chick_type_id' => 'nullable|integer|exists:chick_types,id',
                'company_name' => 'nullable|string|max:255',
                'quantity' => 'nullable|integer|min:1',
                'cost_per_chick' => 'nullable|numeric|min:0',
                'arrival_date' => 'nullable|date|date_format:d-m-Y',
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
                return $this->management->update_batch($request->all());
            } else {
                return $this->management->create_batch($request->all());
            }
        }
    }


    public function addBatchToOLd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:batches,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid batch id!',
                'data' => []
            ]);
        }
        return $this->management->add_batch_to_old($request->id);
    }

    public function batch_wise_all_data(Request $request)
    {
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
        if ($request->has('batch_id') && !empty($request->batch_id)) {
            return $this->management->batch_wise_details($request->batch_id);
        } else {
            return $this->management->batch_wise_data_list();

        }
    }

    public function deleteBatch(Request $request)
    {
        return $this->management->delete_batch($request->id);
    }
}
