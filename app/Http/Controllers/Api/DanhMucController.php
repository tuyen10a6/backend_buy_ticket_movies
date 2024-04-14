<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function getDanhMuc()
    {
        $data = DanhMuc::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function addDanhMuc(Request $request)
    {
        $validated = $request->validate([
            'loai_phim' => 'required',
        ]);

        $data = $request->all();

        try {

            $result = DanhMuc::create($data);

            return response()->json([
                'status' => true,
                'data' => $result,
                'message' => 'Thêm dữ liệu thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Lỗi thêm dữ liệu  ! Vui lòng thử lại',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function updateDanhMuc(Request $request, $id)
    {
        $danhmuc = DanhMuc::find($id);

        $data = $request->all();

        if (!$danhmuc) {
            return response()->json([
                'status' => false,
                'message' => 'ID danh mục trên không tồn tại'
            ], 404);
        }

        $danhmuc->update($data);

        return response()->json(['status' => true,
            'message' => 'Danh mục đã được cập nhật thành công!'
        ], 200);
    }

    public function deleteDanhMuc($id)
    {
        $danhmuc = DanhMuc::query()->find($id);

        if ($danhmuc) {
            $danhmuc->delete();

            return response()->json([
                'status' => true,
                'message' => 'Dữ liệu đã được xoá thành công'], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'ID không tồn tại trên hệ thống'], 404);
        }
    }
}
