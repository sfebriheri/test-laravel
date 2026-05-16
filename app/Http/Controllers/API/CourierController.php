<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourierRequest;
use App\Http\Requests\UpdateCourierRequest;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Courier::query();

        // Search by name
        if ($request->has('search')) {
            $search = $request->search;
            $terms = explode(' ', $search);
            $query->where(function($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->where('name', 'like', '%' . $term . '%');
                }
            });
        }

        // Filter by level (comma separated)
        if ($request->has('level')) {
            $levels = explode(',', $request->level);
            $query->whereIn('level', $levels);
        }

        // Sorting
        $sort = $request->get('sort', 'name'); // Default sort by name
        $direction = $request->get('direction', 'asc');

        if ($sort === 'date') {
            $query->orderBy('created_at', $direction);
        } else {
            $query->orderBy('name', $direction);
        }

        return response()->json($query->paginate($request->get('per_page', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourierRequest $request)
    {
        $courier = Courier::create($request->validated());

        return response()->json([
            'message' => 'Courier created successfully',
            'data' => $courier
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Courier $courier)
    {
        return response()->json($courier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourierRequest $request, Courier $courier)
    {
        $courier->update($request->validated());

        return response()->json([
            'message' => 'Courier updated successfully',
            'data' => $courier
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();

        return response()->json([
            'message' => 'Courier deleted successfully'
        ]);
    }
}
