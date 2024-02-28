<?php

namespace App\Http\Controllers\Admin\Video;


use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Lang;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    public function __construct()
    {
        $this->model = 'video';
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

    public function store(VideoRequest $request)
    {
        $all = $request->except('_token');
        $create = Video::create([
            'title' => $all['title'],
            'video_url' => $all['video_url'],
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
        $data = Video::findOrFail($id);
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
        $data = Video::findOrFail($id);
        $button_link = route('admin.' . $this->model . '.index');

        return view('admin.' . $this->model . '.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(VideoRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Video::findOrFail($id);

        $update = Video::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'title' => $all['title'],
            'video_url' => $all['video_url'],
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
        $control = Video::where('id', $id)->count();
        if ($control != 0) {
            $destroy = Video::where('id', $id)->delete();
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
            $data = Video::get();

            return DataTables::of($data)
                ->addColumn('img', function ($data) {
                    if ($data->img != null) {
                        return view('admin.' . $this->model . '.component.table-image', ['data' => $data]);
                    } else {
                        return 'görsel yok';
                    }
                })
                ->addColumn('video_url', function ($data) {
                    return '<a target="_blank" href=' . asset($data->video_url) . '>Video Görüntüle </a>';
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
                ->rawColumns(['action', 'img', 'view_count', 'video_url'])
                ->make(true);
        }
    }
}
