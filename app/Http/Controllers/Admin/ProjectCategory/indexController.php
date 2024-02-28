<?php

namespace App\Http\Controllers\Admin\ProjectCategory;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCategoryRequest;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Lang;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    protected $project_categories;

    public function __construct()
    {
        $this->model = 'projectcategory';
        $this->model_text = Lang::get('cms.'.$this->model);
        $this->project_categories = ProjectCategory::all();
    }

    public function index()
    {
        $button_link = route('admin.'.$this->model.'.create');

        return view('admin.'.$this->model.'.index', [
            'button_link' => $button_link,
            'model' => $this->model,
            'project_categories' => $this->project_categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function create()
    {
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.create', [
            'button_link' => $button_link,
            'model' => $this->model,
            'project_categories' => $this->project_categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function store(ProjectCategoryRequest $request)
    {
        $all = $request->except('_token');

        $img800x600 = imageHelper::upload800x600(uniqid(), 'projectcategory', '800x600', $all['img'] ?? null);

        $create = ProjectCategory::create([
            'img' => $img800x600 ?? null,
            'title' => $all['title'],
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
        $data = ProjectCategory::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.create', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'project_categories' => $this->project_categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = ProjectCategory::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'project_categories' => $this->project_categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(ProjectCategoryRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = ProjectCategory::findOrFail($id);

        if (isset($all['img'])) {
            $img800x600 = imageHelper::upload800x600(uniqid(), 'projectcategory', '800x600', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = ProjectCategory::where('id', $id)->update([
                'img' => isset($all['img']) ? $img800x600 : $old_data->img,
            ]);
        }

        $update = ProjectCategory::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'title' => $all['title'],
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
        $control = ProjectCategory::where('id', $id)->count();
        if ($control != 0) {
            $destroy = ProjectCategory::where('id', $id)->delete();
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
            $data = ProjectCategory::get();

            return DataTables::of($data)
                ->addColumn('img', function ($data) {
                    if ($data->img != null) {
                        return view('admin.'.$this->model.'.component.table-image', ['data' => $data]);
                    } else {
                        return 'görsel yok';
                    }
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
        \Image::make($mainImage)->save(public_path('images/projectcategory/content_image/'.$fileName));

        return response()->json(['location' => url('/images/projectcategory/content_image/'.$fileName)]);
    }
}
