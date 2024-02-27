<?php

namespace App\Http\Controllers\Admin\NewsImage;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Models\NewsImage;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function upload(Request $request, $new_id)
    {
        $image = $request->file('file');

        $created = NewsImage::create([
            'new_id' => $new_id,
            'img' => imageHelper::upload800x600(rand(100, 2500), 'news', '800x600', $image),
        ]);

        if ($created) {
            return response()->json(['success' => 'good']);
        }
    }

    public function is_active(Request $request)
    {
        $c = NewsImage::where('id', $request->v_id)->count();
        if ($c != '0') {
            $data = NewsImage::find($request->v_id);
            $data->is_active = $request->is_active;
            $data->save();

            return response()->json(['success' => 'Status change successfully.', 'dataVariable' => $request->is_active]);
        }
    }

    public function destroy($id)
    {
        $control = NewsImage::where('id', $id)->count();
        if ($control != 0) {
            $oldData = NewsImage::find($id);
            \File::delete(public_path($oldData->img));
            $destroy = NewsImage::where('id', $id)->delete();
            if (isset($destroy)) {
                return response()->json(['success' => true], 200);
            }
        } else {
            return response()->json(['error' => true], 400);
        }
    }

    public function data(Request $request, $new_id)
    {
        $query = NewsImage::orderBy('order_number', 'asc')->where('new_id', $new_id);

        return datatables()
            ->of($query)
            ->editColumn('img', function ($data) {
                return '  <a href="'.asset($data->img).'" data-lightbox="gallery"><img  style="border-radius:10px;" height="45" src="'.asset($data->img).'" alt="'.$data->code.'"></a>';
            })
            ->editColumn('created_at', function ($data) {
                return date('d.m.Y H:i:s', strtotime($data->created_at));
            })

            ->editColumn('is_active', function ($data) {
                return view('admin.news.component.image-is-active', ['data' => $data]);
            })

            ->editColumn('action', function ($data) {
                return view('admin.news.component.image-table-button', ['data' => $data]);
            })
            ->rawColumns(['bar', 'action', 'img', 'created_at', 'is_active', 'is_cover'])
            ->make(true);
    }
}
