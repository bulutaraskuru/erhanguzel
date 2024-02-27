<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Helpers\bHelper;
use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\News;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;
use Illuminate\Http\Request;
use Lang;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    protected $location_page;

    public function __construct()
    {
        $this->model = 'slider';
        $this->model_text = Lang::get('cms.'.$this->model);
        $this->location_page = bHelper::location_page();
    }

    public function index()
    {
        $button_link = route('admin.'.$this->model.'.create');

        return view('admin.'.$this->model.'.index', [
            'button_link' => $button_link,
            'model' => $this->model,
            'location_page' => $this->location_page,
            'model_text' => $this->model_text,
        ]);
    }

    public function create()
    {
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.create', [
            'button_link' => $button_link,
            'model' => $this->model,
            'location_page' => $this->location_page,
            'model_text' => $this->model_text,
        ]);
    }

    public function store(SliderRequest $request)
    {
        $all = $request->except('_token');

        $img1920x1080 = imageHelper::upload1920x650(uniqid(), 'slider', '1920x650', $all['img']);

        $create = Slider::create([
            'img' => $img1920x1080,
            'title_small' => $all['title_small'],
            'title_big' => $all['title_big'],
            'description' => '#',
            'link_type' => $all['link_type'],
            'link' => $all['link'],
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
        $data = Slider::findOrFail($id);
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
        $data = Slider::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'location_page' => $this->location_page,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(SliderRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Slider::findOrFail($id);

        if (isset($all['img'])) {
            $img800x600 = imageHelper::upload1920x650(uniqid(), 'slider', '1920x650', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = Slider::where('id', $id)->update([
                'img' => isset($all['img']) ? $img800x600 : $old_data->img,
            ]);
        }

        $update = Slider::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'title_small' => $all['title_small'],
            'title_big' => $all['title_big'],
            'description' => '#',
            'link_type' => $all['link_type'],
            'link' => $all['link'],
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
        $control = Slider::where('id', $id)->count();
        if ($control != 0) {
            $old_data = Slider::findOrFail($id);
            \File::delete(public_path($old_data->img));

            $destroy = Slider::where('id', $id)->delete();
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
            $data = Slider::query();

            return DataTables::of($data)
                ->addColumn('bar', function ($data) {
                    return '<div style="color:rgb(124,77,255);  font-size: 20px; cursor: pointer;" title="change display order">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        </div>';
                })
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
                        $instance->where('question', 'LIKE', '%'.$request->get('text').'%');
                    }
                })
                ->rawColumns(['action', 'bar', 'img'])
                ->make(true);
        }
    }

    public function sortable(Request $request)
    {
        $ssses = Slider::all();

        foreach ($ssses as $sss) {
            $sss->timestamps = false;
            $id = $sss->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    Slider::where('id', $id)->update(['order_number' => $order['position']]);
                }
            }
        }

        return response()->json(['success' => true], 200);
    }

    public function link_type(Request $request, $selected_value)
    {
        if ($selected_value == 1) {
            $query = Product::where('is_active', 1)->get();
        } elseif ($selected_value == '2') {
            $query = ProductCategory::where('is_active', 1)->get();
        } elseif ($selected_value == '3') {
            $query = News::where('is_active', 1)->get();
        }

        return response()->json(['data' => $query], 200);
    }
}
