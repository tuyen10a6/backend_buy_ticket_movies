<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Phim;
use Illuminate\Http\Request;
use function Spatie\FlareClient\getMessage;

class PhimController extends Controller
{
    public function getPhim()
    {
        $data = Phim::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function addPhim(Request $request)
    {

        $validatedData = $request->validate([
            'ten_phim' => 'required|unique:phim',
            'danhmuc_id' => 'required'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/phim'), $imageName);
                $data['image'] = '/images/phim/' . $imageName;
            }

            Phim::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Thêm dữ liệu thành công',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }


    public function updatePhim(Request $request, $id)
    {
        $validateRequest = $request->validate([
            'ten_phim' => 'required|unique:phim',
            'danhmuc_id' => 'required'
        ]);

        $phim = Phim::query()->find($id);

        $data = $request->all();

        if (!$phim) {
            return response()->json([
                'status' => false,
                'message' => 'ID ' . $id . 'không tồn tại'
            ], 404);
        } else {
            $phim->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Update dữ liệu thành công!',
                'data' => $phim
            ], 200);
        }
    }

    public function deletePhim($id)
    {
        $phim = Phim::query()->find($id);

        if (!$phim) {
            return response()->json([
                'status' => false,
                'message' => 'ID ' . $id . 'không tồn tại trong bảng phim'
            ], 404);
        } else {
            $phim->delete();

            return response()->json([
                'status' => true,
                'data' => $phim,
                'message' => 'Xoá dữ liệu trên thành công',
            ], 200);
        }
    }

    public function searchPhim(Request $request)
    {
        $data = Phim::query()->where('ten_phim', 'like', '%' . $request['name'] . '%')->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function getPhimByDanhMuc($id)
    {
        $data = Phim::query()->where('danhmuc_id', $id)->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
