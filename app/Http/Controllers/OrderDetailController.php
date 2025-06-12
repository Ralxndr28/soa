<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function index() {
        return OrderDetail::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'menu' => 'required|string',
            'quantity' => 'required|integer',
            'chef' => 'nullable|string',
            'status' => 'nullable|string|in:pending,cooking,done',
            'notes' => 'nullable|string',
        ]);

        return OrderDetail::create($validated);
    }

    public function show(string $id) {
        $data = OrderDetail::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($data, 200);
    }

    public function update(Request $request, string $id) {
        $data = OrderDetail::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validated = $request->validate([
            'order_id' => 'sometimes|integer',
            'menu' => 'sometimes|string',
            'quantity' => 'sometimes|integer',
            'chef' => 'nullable|string',
            'status' => 'nullable|string|in:pending,cooking,done',
            'notes' => 'nullable|string',
        ]);

        $data->update($validated);
        return response()->json($data, 200);
    }

    public function destroy(string $id) {
        $data = OrderDetail::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
