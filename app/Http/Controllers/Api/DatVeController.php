<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DatVe;
use Illuminate\Http\Request;
use function Spatie\FlareClient\getMessage;

class DatVeController extends Controller
{
    public function getDatVe()
    {
        $data = DatVe::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function addDatVe(Request $request)
    {

        $validateRequest = $request->validate([
            'lich_chieu_id' => 'required',
            'ten_khachhang' => 'required',
            'so_luong' => 'required',
        ]);

        $data = $request->all();

        try {
            DatVe::create($data);

            return response()->json(
                [
                    'status' => true,
                    'data' => $data,
                    'message' => 'Thêm dữ liệu thành công'
                ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $data,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function updateDatVe(Request $request, $id)
    {
        $datVe = DatVe::query()->find($id);

        $data = $request->all();

        if (!$datVe) {
            return response()->json([
                'status' => false,
                'message' => 'ID ' . $id . 'không tồn tại'
            ], 404);
        } else {
            $datVe->update($data);
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Cập nhật dữ liệu trên thành công'
            ], 200);
        }
    }

    public function deleteDatVe($id)
    {
        $datVe = DatVe::query()->find($id);

        if (!$datVe) {
            return response()->json([
                'status' => false,
                'message' => 'ID ' . $id . 'không tồn tại'
            ], 404);
        } else {
            $datVe->delete();
            return response()->json([
                'status' => true,
                'data' => $datVe,
                'message' => 'Xoá dữ liệu trên thành công'
            ], 200);
        }

    }
}
