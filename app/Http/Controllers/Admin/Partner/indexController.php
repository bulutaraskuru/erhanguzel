<?php

namespace App\Http\Controllers\Admin\Partner;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Lang;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    public function __construct()
    {
        $this->model = 'partner';
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

    public function store(PartnerRequest $request)
    {
        $all = $request->except('_token');

        $img350x150 = imageHelper::upload350x150(uniqid(), 'icon', '350x150', $all['img']);

        $create = Partner::create([
            'img' => $img350x150,
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
        $data = Partner::findOrFail($id);
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
        $data = Partner::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(PartnerRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Partner::findOrFail($id);

        if (isset($all['img'])) {
            $img350x150 = imageHelper::upload350x150(uniqid(), 'icon', '350x150', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = Partner::where('id', $id)->update([
                'img' => isset($all['img']) ? $img350x150 : $old_data->img,
            ]);
        }

        $update = Partner::where('id', $id)->update([
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
        $control = Partner::where('id', $id)->count();
        if ($control != 0) {
            $destroy = Partner::where('id', $id)->delete();
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
            $data = Partner::get();

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
