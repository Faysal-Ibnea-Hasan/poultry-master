<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BreedResultResource;
use App\Http\Resources\CompanyAndChicksResource;
use App\Interfaces\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct(protected MenuInterface $menuRepo)
    {
    }

    public function getMenuResults(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'nullable|integer|exists:options,id',
            'day' => 'nullable|integer',
            'company_id' => 'nullable|integer|exists:companies,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'results' => []
            ], 200);

        }
        // Check if both menu_id and day are provided
        if ($request->filled(['menu_id', 'day'])) {
            $results = $this->menuRepo->get_menu_breed_results($request->menu_id, $request->day);
            if ($results) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data was found successfully',
                    'results' => BreedResultResource::collection($results)
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No results found.',
                    'results' => []
                ], 200);
            }
        }
        if ($request->filled(['company_id'])) {
            $results = $this->menuRepo->get_menu_company_and_chicks_result($request->company_id);
            if ($results) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data was found successfully',
                    'results' => CompanyAndChicksResource::collection($results)
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No results found.',
                    'results' => []
                ], 200);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'No results found.',
            'results' => []
        ], 200);
    }
}
