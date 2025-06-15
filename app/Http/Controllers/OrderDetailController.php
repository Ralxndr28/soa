<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    // Ambil semua data order detail
    public function index()
    {
        return response()->json(OrderDetail::all(), 200);
    }

    // Tambahkan order detail baru
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

        $orderDetail = OrderDetail::create($validated);

        return response()->json($orderDetail, 201);
    }

    // Tampilkan detail berdasarkan order_detail_id
    public function show(string $id)
    {
        $data = OrderDetail::find($id);

        if (!$data) {
            return response()->json(['message' => 'Order Detail not found'], 404);
        }

        return response()->json($data, 200);
    }

    // Tampilkan semua data berdasarkan nama chef
    public function getByChef(string $chef)
    {
        $data = OrderDetail::where('chef', $chef)->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No orders found for this chef'], 404);
        }

        return response()->json($data, 200);
    }

    // Update order detail
    public function update(Request $request, string $id)
    {
        $data = OrderDetail::find($id);

        if (!$data) {
            return response()->json(['message' => 'Order Detail not found'], 404);
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

    // Hapus order detail
    public function destroy(string $id)
    {
        $data = OrderDetail::find($id);

        if (!$data) {
            return response()->json(['message' => 'Order Detail not found'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Order Detail deleted'], 200);
    }
}
