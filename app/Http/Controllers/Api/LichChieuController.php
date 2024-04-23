<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LichChieu;
use App\Models\Phim;
use Illuminate\Http\Request;
use function League\Flysystem\delete;
use function PHPUnit\Runner\validate;
use function Spatie\FlareClient\getMessage;

class LichChieuController extends Controller
{
    public function getLichChieu()
    {
        $data = LichChieu::query()->with(['phim', 'rap'])->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function addLichChieu(Request $request)
    {
        $validateRequest = $request->validate([
            'phim_id' => 'required',
            'rap_id' => 'required',
        ]);

        $data = $request->all();


        try {
            LichChieu::create($data);

            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Thêm dữ liệu thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $data,
                'message' => $e . getMessage()
            ], 404);
        }
    }

    public function updateLichChieu(Request $request, $id)
    {
        $validateRequest = $request->validate([
            'phim_id' => 'required',
            'rap_id' => 'required',
        ]);

        $data = $request->all();

        $lichChieu = LichChieu::query()->find($id);

        if (!$lichChieu) {
            return response()->json([
                'status' => false,
                'message' => 'ID ' . $id . ' không tồn tại trong bảng lịch chiếu'
            ]);
        } else {
            $lichChieu->update($data);
            return response()->json([
                'status' => true,
                'data' => $lichChieu,
                'message' => 'Sửa dữ liệu trên thành công'
            ]);
        }
    }

    public function deleteLichChieu($id)
    {
        $lichChieu = LichChieu::query()->find($id);

        if (!$lichChieu) {
            return response()->json([
                'status' => false,
                'message' => 'Id trên không tồn tại'
            ], 404);
        } else {
            $lichChieu->delete();

            return response()->json([
                'status' => true,
                'data' => $lichChieu,
                'message' => 'Dữ liệu trên đã được xoá'
            ], 200);
        }
    }

    public function getPhimByLichChieu($id)
    {
        $data = LichChieu::query()->with('rap')->where('phim_id', $id)->get();

        return $data;
    }
}
