<?php

namespace App\Http\Controllers\Admin\Box;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoxRequest;
use App\Models\Box;
use Illuminate\Http\Request;
use Lang;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    public function __construct()
    {
        $this->model = 'box';
        $this->model_text = Lang::get('cms.'.$this->model);
    }

    public function index()
    {
        $button_link = route('admin.'.$this->model.'.create');

        return view('admin.'.$this->model.'.index', [
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function create()
    {
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.create', [
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function store(BoxRequest $request)
    {
        $all = $request->except('_token');

        $img64x64 = imageHelper::upload64x64(uniqid(), 'icon', '64x64', $all['img']);

        $create = Box::create([
            'img' => $img64x64,
            'title' => $all['title'],
            'description' => $all['description'],
        ]);

        if (isset($create)) {
            toast(Lang::get('cms.success_text'), 'success');

            return redirect()->route('admin.'.$this->model.'.index');
        } else {
            toast(Lang::get('cms.error_text'), 'success');

            return redirect()->route('admin.'.$this->model.'.index');
        }
    }

    public function show(Request $request, $id)
    {
        $data = Box::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.create', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = Box::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(BoxRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Box::findOrFail($id);

        if (isset($all['img'])) {
            $img64x64 = imageHelper::upload64x64(uniqid(), 'icon', '64x64', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = Box::where('id', $id)->update([
                'img' => isset($all['img']) ? $img64x64 : $old_data->img,
            ]);
        }

        $update = Box::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'title' => $all['title'],
            'description' => $all['description'],
        ]);

        if (isset($update)) {
            toast(Lang::get('cms.success_text'), 'success');

            return redirect()->route('admin.'.$this->model.'.index');
        } else {
            toast(Lang::get('cms.error_text'), 'success');

            return redirect()->route('admin.'.$this->model.'.index');
        }
    }

    public function destroy($id)
    {
        $control = Box::where('id', $id)->count();
        if ($control != 0) {
            $destroy = Box::where('id', $id)->delete();
            if (isset($destroy)) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['error' => true], 400);
            }
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Box::get();

            return DataTables::of($data)
                ->addColumn('img', function ($data) {
                    return view('admin.'.$this->model.'.component.table-image', ['data' => $data]);
                })
                ->editColumn('is_active', function ($data) {
                    return $data->is_active == 1 ? 'Aktif' : 'Pasif';
                })
                ->editColumn('created_at', function ($data) {
                    return date('d.m.Y H:i:s', strtotime($data->created_at));
                })
                ->editColumn('updated_at', function ($data) {
                    return date('d.m.Y H:i:s', strtotime($data->updated_at));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.'.$this->model.'.component.table-button', ['data' => $data, 'model' => $this->model]);
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') != 'all') {
                        $instance->where('is_active', $request->get('is_active'));
                    }

                    if ($request->get('text') != null) {
                        $instance->where('title', 'LIKE', '%'.$request->get('text').'%');
                    }
                })
                ->rawColumns(['action', 'img', 'created_at', 'updated_at'])
                ->make(true);
        }
    }
}
