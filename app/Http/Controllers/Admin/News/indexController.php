<?php

namespace App\Http\Controllers\Admin\News;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Lang;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    public function __construct()
    {
        $this->model = 'news';
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

    public function store(NewsRequest $request)
    {
        $all = $request->except('_token');

        $img800x600 = imageHelper::upload800x600(uniqid(), 'news', '800x600', $all['img']);

        $create = News::create([
            'img' => $img800x600,
            'title' => $all['title'],
            'description' => $all['description'],
            'seo_title' => $all['seo_title'],
            'seo_keywords' => $all['seo_keywords'],
            'seo_description' => $all['seo_description'],
            'created_at' => date('Y-m-d H:i:s', strtotime($all['created_at'])),
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
        $data = News::findOrFail($id);
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
        $data = News::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(NewsRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = News::findOrFail($id);

        if (isset($all['img'])) {
            $img800x600 = imageHelper::upload800x600(uniqid(), 'news', '800x600', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = News::where('id', $id)->update([
                'img' => isset($all['img']) ? $img800x600 : $old_data->img,
            ]);
        }

        $update = News::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'title' => $all['title'],
            'description' => $all['description'],
            'seo_title' => $all['seo_title'],
            'seo_keywords' => $all['seo_keywords'],
            'seo_description' => $all['seo_description'],
            'created_at' => date('Y-m-d H:i:s', strtotime($all['created_at'])),

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
        $control = News::where('id', $id)->count();
        if ($control != 0) {
            $destroy = News::where('id', $id)->delete();
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
            $data = News::get();

            return DataTables::of($data)
                ->addColumn('img', function ($data) {
                    return view('admin.'.$this->model.'.component.table-image', ['data' => $data]);
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
                ->rawColumns(['action', 'img', 'view_count'])
                ->make(true);
        }
    }

    public function upload(Request $request)
    {
        $mainImage = $request->file('file');
        $fileName = uniqid().time().'.'.$mainImage->extension();
        \Image::make($mainImage)->save(public_path('images/news/content_image/'.$fileName));

        return response()->json(['location' => url('/images/news/content_image/'.$fileName)]);
    }

    public function image(Request $request, $id)
    {
        $data = News::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.image', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }
}