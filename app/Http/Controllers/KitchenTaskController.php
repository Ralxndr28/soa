<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KitchenTask;

class KitchenTaskController extends Controller
{
    // Ambil semua data Kitchen Task
    public function index()
    {
        return response()->json(KitchenTask::all(), 200);
    }

    // Tambahkan Kitchen Task baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'menu' => 'required|string',
            'quantity' => 'required|integer',
            'chef' => 'nullable|string',
            'status' => 'nullable|string|in:pending,cooking,done',
            'notes' => 'nullable|string',
        ]);

        $kitchenTask = KitchenTask::create($validated);

        return response()->json($kitchenTask, 201);
    }

    // Tampilkan detail berdasarkan order_detail_id
    public function show(string $id)
    {
        $data = KitchenTask::find($id);

        if (!$data) {
            return response()->json(['message' => 'KitchenTask not found'], 404);
        }

        return response()->json($data, 200);
    }

    // Tampilkan semua data berdasarkan nama chef
    public function getByChef(string $chef)
    {
        $data = KitchenTask::where('chef', $chef)->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No orders found for this chef'], 404);
        }

        return response()->json($data, 200);
    }

    // Update Kitchen Task
    public function update(Request $request, string $id)
    {
        $data = KitchenTask::find($id);

        if (!$data) {
            return response()->json(['message' => 'Kitchen Task not found'], 404);
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

    // Hapus Kitchen Task
    public function destroy(string $id)
    {
        $data = KitchenTask::find($id);

        if (!$data) {
            return response()->json(['message' => 'Kitchen Task not found'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Kitchen Task deleted'], 200);
    }
}
