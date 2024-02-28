<?php

namespace App\Http\Controllers\Admin\ProjectGallery;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProjectGallery;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function upload(Request $request, $project_id)
    {
        $image = $request->file('file');

        $created = ProjectGallery::create([
            'project_id' => $project_id,
            'img' => imageHelper::upload800x600(rand(100, 2500), 'project', '800x600', $image),
        ]);

        if ($created) {
            return response()->json(['success' => 'good']);
        }
    }

    public function is_active(Request $request)
    {
        $c = ProjectGallery::where('id', $request->v_id)->count();
        if ($c != '0') {
            $data = ProjectGallery::find($request->v_id);
            $data->is_active = $request->is_active;
            $data->save();

            return response()->json(['success' => 'Status change successfully.', 'dataVariable' => $request->is_active]);
        }
    }

    public function destroy($id)
    {
        $control = ProjectGallery::where('id', $id)->count();
        if ($control != 0) {
            $oldData = ProjectGallery::find($id);
            \File::delete(public_path($oldData->img));
            $destroy = ProjectGallery::where('id', $id)->delete();
            if (isset($destroy)) {
                return response()->json(['success' => true], 200);
            }
        } else {
            return response()->json(['error' => true], 400);
        }
    }

    public function data(Request $request, $project_id)
    {
        $query = ProjectGallery::orderBy('order_number', 'asc')->where('project_id', $project_id);

        return datatables()
            ->of($query)
            ->editColumn('img', function ($data) {
                return '  <a href="'.asset($data->img).'" data-lightbox="gallery"><img  style="border-radius:10px;" height="45" src="'.asset($data->img).'" alt="'.$data->code.'"></a>';
            })
            ->editColumn('created_at', function ($data) {
                return date('d.m.Y H:i:s', strtotime($data->created_at));
            })

            ->editColumn('is_active', function ($data) {
                return view('admin.project.component.image-is-active', ['data' => $data]);
            })

            ->editColumn('action', function ($data) {
                return view('admin.project.component.image-table-button', ['data' => $data]);
            })
            ->rawColumns(['bar', 'action', 'img', 'created_at', 'is_active', 'is_cover'])
            ->make(true);
    }
}
