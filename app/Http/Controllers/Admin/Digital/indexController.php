<?php

namespace App\Http\Controllers\Admin\Digital;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DigitalRequest;
use App\Models\Digital;
use Illuminate\Http\Request;
use Lang;
use Str;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    public function __construct()
    {
        $this->model = 'digital';
        $this->model_text = Lang::get('cms.' . $this->model);
    }

    public function index()
    {
        $button_link = route('admin.' . $this->model . '.create');

        return view('admin.' . $this->model . '.index', [
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function create()
    {
        $button_link = route('admin.' . $this->model . '.index');

        return view('admin.' . $this->model . '.create', [
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function store(DigitalRequest $request)
    {
        $all = $request->except('_token');
        $img800x600 = imageHelper::upload800x600(uniqid(), 'digital', '800x600', $all['img'] ?? null);

        $fileName = Str::slug($all['title']) . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);
        $path = 'uploads/' . $fileName;

        $create = Digital::create([
            'img' => $img800x600,
            'file_url' => $path,
            'title' => $all['title'],
            'description' => $all['description'],
        ]);

        if (isset($create)) {
            toast(Lang::get('cms.success_text'), 'success');
            return redirect()->route('admin.' . $this->model . '.index');
        } else {
            toast(Lang::get('cms.error_text'), 'success');
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function show(Request $request, $id)
    {
        $data = Digital::findOrFail($id);
        $button_link = route('admin.' . $this->model . '.index');

        return view('admin.' . $this->model . '.create', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = Digital::findOrFail($id);
        $button_link = route('admin.' . $this->model . '.index');

        return view('admin.' . $this->model . '.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(DigitalRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Digital::findOrFail($id);

        if (isset($all['img'])) {
            $img800x600 = imageHelper::upload800x600(uniqid(), 'digital', '800x600', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = Digital::where('id', $id)->update([
                'img' => isset($all['img']) ? $img800x600 : $old_data->img,
            ]);
        }

        if (isset($all['file'])) {
            \File::delete(public_path($old_data->file_url));
            $fileName = Str::slug($all['title']) . '.' . $request->file->extension();
            $request->file->move(public_path('uploads'), $fileName);
            $path = 'uploads/' . $fileName;
        }

        $update = Digital::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'title' => $all['title'],
            'description' => $all['description'],
        ]);

        if (isset($update)) {
            toast(Lang::get('cms.success_text'), 'success');
            return redirect()->route('admin.' . $this->model . '.index');
        } else {
            toast(Lang::get('cms.error_text'), 'success');
            return redirect()->route('admin.' . $this->model . '.index');
        }
    }

    public function destroy($id)
    {
        $control = Digital::where('id', $id)->count();
        if ($control != 0) {
            $old_data = Digital::where('id', $id)->delete();
            \File::delete(public_path($old_data->file_url));
            if ($old_data->img != null) {
                \File::delete(public_path($old_data->img));
            }
            $destroy = Digital::where('id', $id)->delete();
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
            $data = Digital::get();

            return DataTables::of($data)
                ->addColumn('img', function ($data) {
                    if ($data->img != null) {
                        return view('admin.' . $this->model . '.component.table-image', ['data' => $data]);
                    } else {
                        return 'görsel yok';
                    }
                })
                ->addColumn('file_url', function ($data) {
                    return '<a target="_blank" href=' . asset($data->file_url) . '>Dosyayı Görüntüle </a>';
                })
                ->addColumn('view_count', function ($data) {
                    return views($data)->period(\CyrildeWit\EloquentViewable\Support\Period::since())->count();
                })
                ->editColumn('is_active', function ($data) {
                    return $data->is_active == 1 ? 'Aktif' : 'Pasif';
                })
                ->editColumn('created_at', function ($data) {
                    return date('d.m.Y', strtotime($data->created_at));
                })
                ->editColumn('updated_at', function ($data) {
                    return date('d.m.Y', strtotime($data->updated_at));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.' . $this->model . '.component.table-button', ['data' => $data, 'model' => $this->model]);
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') != 'all') {
                        $instance->where('is_active', $request->get('is_active'));
                    }

                    if ($request->get('text') != null) {
                        $instance->where('title', 'LIKE', '%' . $request->get('text') . '%');
                    }
                })
                ->rawColumns(['action', 'img', 'view_count', 'file_url'])
                ->make(true);
        }
    }
}
