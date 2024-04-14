<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RapPhim;
use http\Env\Response;
use Illuminate\Http\Request;

class RapPhimController extends Controller
{
    public function getRapPhim()
    {
        $data = RapPhim::all();

        return response()->json([
            'status' => 'true',
            'data' => $data
        ]);
    }

    public function addRapPhim(Request $request)
    {
        $validateRequest = $request->validate([
            'ten_rap' => 'required',
            'dia_chi_rap' => 'required',
            'trang_thai' => 'required'
        ]);

        $data = $request->all();

        try {
            $result = RapPhim::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Thêm dữ liệu thành công',
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function updateRapPhim(Request $request, $id)
    {
        $validateRequest = $request->validate([
            'ten_rap' => 'required',
            'dia_chi_rap' => 'required',
            'trang_thai' => 'required'
        ]);

        $rapPhim = RapPhim::find($id);

        $data = $request->all();

        if (!$rapPhim) {
            return response()->json([
                'status' => false,
                'message' => 'ID rạp phim trên không tồn tại'
            ]);
        } else {
            $rapPhim->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Update rạp phim thành công',
                'data' => $rapPhim
            ]);
        }
    }

    public function deleteRapPhim($id)
    {
        $rapPhim = RapPhim::find($id);

        if (!$rapPhim) {
            return response()->json([
                'status' => 'false',
                'message' => 'ID rạp phim không tồn tại!'
            ], 404);
        } else {
            $rapPhim->delete();

            return response()->json([
                'status' => 'true',
                'message' => 'ID ' . $id . 'đã xoá thành công'
            ], 200);
        }
    }

}
