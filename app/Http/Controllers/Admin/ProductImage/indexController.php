<?php

namespace App\Http\Controllers\Admin\ProductImage;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function upload(Request $request, $product_id)
    {
        $image = $request->file('file');

        $created = ProductImage::create([
            'product_id' => $product_id,

            'img' => imageHelper::upload670x800(uniqid(), 'product', '670x800', $image),
        ]);

        if ($created) {
            return response()->json(['success' => 'good']);
        }
    }

    public function is_active(Request $request)
    {
        $c = ProductImage::where('id', $request->v_id)->count();
        if ($c != '0') {
            $data = ProductImage::find($request->v_id);
            $data->is_active = $request->is_active;
            $data->save();

            return response()->json(['success' => 'Status change successfully.', 'dataVariable' => $request->is_active]);
        }
    }

    public function destroy($id)
    {
        $control = ProductImage::where('id', $id)->count();
        if ($control != 0) {
            $oldData = ProductImage::find($id);
            \File::delete(public_path($oldData->img));
            $destroy = ProductImage::where('id', $id)->delete();
            if (isset($destroy)) {
                return response()->json(['success' => true], 200);
            }
        } else {
            return response()->json(['error' => true], 400);
        }
    }

    public function data(Request $request, $product_id)
    {
        $query = ProductImage::orderBy('order_number', 'asc')->where('product_id', $product_id);

        return datatables()
            ->of($query)
            ->editColumn('img', function ($data) {
                return '  <a href="'.asset($data->img).'" data-lightbox="gallery"><img  style="border-radius:10px;" height="45" src="'.asset($data->img).'" alt="'.$data->code.'"></a>';
            })
            ->editColumn('created_at', function ($data) {
                return date('d.m.Y H:i:s', strtotime($data->created_at));
            })

            ->editColumn('is_active', function ($data) {
                return view('admin.product.component.image-is-active', ['data' => $data]);
            })

            ->editColumn('action', function ($data) {
                return view('admin.product.component.image-table-button', ['data' => $data]);
            })
            ->rawColumns(['bar', 'action', 'img', 'created_at', 'is_active', 'is_cover'])
            ->make(true);
    }
}
