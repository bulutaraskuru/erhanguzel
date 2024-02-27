<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Lang;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    public function __construct()
    {
        $this->model = 'gallery';
        $this->model_text = Lang::get('cms.'.$this->model);
    }

    public function index()
    {
        return view('admin.'.$this->model.'.index', [
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function upload(Request $request)
    {
        $image = $request->file('file');
        $created = Gallery::create([
            'img' => imageHelper::upload800x600(rand(100, 2500), 'gallery', '800x600', $image),
        ]);

        if ($created) {
            return response()->json(['success' => 'good']);
        }
    }

    public function is_active(Request $request)
    {
        $c = Gallery::where('id', $request->v_id)->count();
        if ($c != '0') {
            $data = Gallery::find($request->v_id);
            $data->is_active = $request->is_active;
            $data->save();

            return response()->json(['success' => 'Status change successfully.', 'dataVariable' => $request->is_active]);
        }
    }

    public function destroy($id)
    {
        $control = Gallery::where('id', $id)->count();
        if ($control != 0) {
            $oldData = Gallery::find($id);
            \File::delete(public_path($oldData->img));
            $destroy = Gallery::where('id', $id)->delete();
            if (isset($destroy)) {
                return response()->json(['success' => true], 200);
            }
        } else {
            return response()->json(['error' => true], 400);
        }
    }

    public function data(Request $request)
    {
        $query = Gallery::orderBy('order_number', 'asc');

        return datatables()
            ->of($query)
            ->editColumn('img', function ($data) {
                return '  <a href="'.asset($data->img).'" data-lightbox="gallery"><img  style="border-radius:10px;" height="45" src="'.asset($data->img).'" alt="'.$data->code.'"></a>';
            })
            ->editColumn('created_at', function ($data) {
                return date('d.m.Y H:i:s', strtotime($data->created_at));
            })

            ->editColumn('is_active', function ($data) {
                return view('admin.gallery.component.image-is-active', ['data' => $data]);
            })

            ->editColumn('action', function ($data) {
                return view('admin.gallery.component.image-table-button', ['data' => $data]);
            })
            ->rawColumns(['bar', 'action', 'img', 'created_at', 'is_active', 'is_cover'])
            ->make(true);
    }
}
