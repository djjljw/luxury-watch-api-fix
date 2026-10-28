<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWatchRequest;
use App\Http\Requests\UpdateWatchRequest;
use App\Http\Resources\WatchResource;
use App\Models\Watch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller untuk mengelola katalog jam tangan mewah (Luxury Watch API).
 */
class WatchController extends Controller
{
    /**
     * Mengambil seluruh daftar koleksi jam mewah.
     *
     * Endpoint ini mengembalikan seluruh data koleksi jam tangan mewah yang tersedia di database.
     * Mendukung filter opsional berdasarkan brand, status, atau kata kunci pencarian.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Watch::query();

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->query('brand') . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('material', 'like', "%{$search}%");
            });
        }

        $watches = $query->orderBy('id', 'desc')->get();

        return response()->json([
            'message' => 'Daftar koleksi jam mewah berhasil diambil',
            'data' => WatchResource::collection($watches),
        ], 200);
    }

    /**
     * Menambahkan data jam mewah baru.
     *
     * Endpoint ini memvalidasi dan menyimpan jam tangan mewah baru ke dalam database.
     *
     * @param StoreWatchRequest $request
     * @return JsonResponse
     */
    public function store(StoreWatchRequest $request): JsonResponse
    {
        $watch = Watch::create($request->validated());

        return response()->json([
            'message' => 'Data jam mewah berhasil ditambahkan',
            'data' => new WatchResource($watch),
        ], 201);
    }

    /**
     * Mengambil detail 1 jam mewah berdasarkan ID.
     *
     * Endpoint ini menampilkan rincian spesifikasi lengkap satu jam tangan mewah berdasarkan ID.
     *
     * @param int|string $id ID koleksi jam mewah
     * @return JsonResponse
     */
    public function show(string|int $id): JsonResponse
    {
        $watch = Watch::find($id);

        if (!$watch) {
            return response()->json([
                'message' => 'Data jam mewah tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'message' => 'Detail jam mewah berhasil diambil',
            'data' => new WatchResource($watch),
        ], 200);
    }

    /**
     * Memperbarui data jam mewah yang tersimpan.
     *
     * Endpoint ini memperbarui atribut jam tangan mewah berdasarkan ID (mendukung PUT dan PATCH).
     *
     * @param UpdateWatchRequest $request
     * @param int|string $id ID koleksi jam mewah
     * @return JsonResponse
     */
    public function update(UpdateWatchRequest $request, string|int $id): JsonResponse
    {
        $watch = Watch::find($id);

        if (!$watch) {
            return response()->json([
                'message' => 'Data jam mewah tidak ditemukan',
                'data' => null,
            ], 404);
        }

        $watch->update($request->validated());

        return response()->json([
            'message' => 'Data jam mewah berhasil diperbarui',
            'data' => new WatchResource($watch->fresh()),
        ], 200);
    }

    /**
     * Menghapus data jam mewah dari basis data.
     *
     * Endpoint ini menghapus jam tangan mewah yang tersimpan berdasarkan ID.
     *
     * @param int|string $id ID koleksi jam mewah
     * @return JsonResponse
     */
    public function destroy(string|int $id): JsonResponse
    {
        $watch = Watch::find($id);

        if (!$watch) {
            return response()->json([
                'message' => 'Data jam mewah tidak ditemukan',
                'data' => null,
            ], 404);
        }

        $watch->delete();

        return response()->json([
            'message' => 'Data jam mewah berhasil dihapus',
            'data' => null,
        ], 200);
    }
}
