<?php

namespace App\Http\Controllers\Admin\Product;

use App\Helpers\imageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Lang;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    protected $categories;

    public function __construct()
    {
        $this->model = 'product';
        $this->model_text = Lang::get('cms.'.$this->model);
        $this->categories = ProductCategory::where('is_active', 1)->get();
    }

    public function index()
    {
        $button_link = route('admin.'.$this->model.'.create');

        return view('admin.'.$this->model.'.index', [
            'button_link' => $button_link,
            'model' => $this->model,
            'categories' => $this->categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function create()
    {
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.create', [
            'button_link' => $button_link,
            'model' => $this->model,
            'categories' => $this->categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $all = $request->except('_token');

        $img800x600 = imageHelper::upload670x800(uniqid(), 'product', '670x800', $all['img']);

        $create = Product::create([
            'img' => $img800x600,
            'category_id' => $all['category_id'],
            'title' => $all['title'],
            'description' => $all['description'],
            'seo_title' => $all['seo_title'],
            'seo_keywords' => $all['seo_keywords'],
            'seo_description' => $all['seo_description'],
            'stock' => $all['stock'],
            'price' => $all['price'],
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
        $data = Product::findOrFail($id);
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
        $data = Product::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'categories' => $this->categories,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Product::findOrFail($id);

        if (isset($all['img'])) {
            $img800x600 = imageHelper::upload670x800(uniqid(), 'product', '670x800', $all['img']);
            \File::delete(public_path($old_data->img));
            $updateImage = Product::where('id', $id)->update([
                'img' => isset($all['img']) ? $img800x600 : $old_data->img,
            ]);
        }

        $update = Product::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'category_id' => $all['category_id'],
            'title' => $all['title'],
            'description' => $all['description'],
            'seo_title' => $all['seo_title'],
            'seo_keywords' => $all['seo_keywords'],
            'seo_description' => $all['seo_description'],
            'stock' => $all['stock'],
            'price' => $all['price'],
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
        $control = Product::where('id', $id)->count();
        if ($control != 0) {
            $destroy = Product::where('id', $id)->delete();
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
            $data = Product::with(['product_category']);

            return DataTables::of($data)
                ->addColumn('img', function ($data) {
                    return view('admin.'.$this->model.'.component.table-image', ['data' => $data]);
                })
                ->editColumn('category_id', function ($data) {
                    return $data->product_category->title;
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
                    if ($request->get('category_id') != 'all') {
                        $instance->where('category_id', $request->get('category_id'));
                    }

                    if ($request->get('text') != null) {
                        $instance->where('title', 'LIKE', '%'.$request->get('text').'%');
                    }
                })
                ->rawColumns(['action', 'img', 'category_id'])
                ->make(true);
        }
    }

    public function upload(Request $request)
    {
        $mainImage = $request->file('file');
        $fileName = uniqid().time().'.'.$mainImage->extension();
        \Image::make($mainImage)->save(public_path('images/product/content_image/'.$fileName));

        return response()->json(['location' => url('/images/product/content_image/'.$fileName)]);
    }

    public function image(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.image', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'categories' => $this->categories,
            'model_text' => $this->model_text,
        ]);
    }
}
