<?php

namespace App\Http\Controllers\Admin\Sss;

use App\Helpers\bHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SssRequest;
use App\Models\Sss;
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
        $this->model = 'sss';
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

    public function store(SssRequest $request)
    {
        $all = $request->except('_token');

        $create = Sss::create([
            'question' => $all['question'],
            'answer' => $all['answer'],
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
        $data = Sss::findOrFail($id);
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
        $data = Sss::findOrFail($id);
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'data' => $data,
            'button_link' => $button_link,
            'model' => $this->model,
            'location_page' => $this->location_page,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(SssRequest $request, $id)
    {
        $all = $request->except('_token');
        $old_data = Sss::findOrFail($id);

        $update = Sss::where('id', $id)->update([
            'is_active' => $all['is_active'],
            'question' => $all['question'],
            'answer' => $all['answer'],
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
        $control = Sss::where('id', $id)->count();
        if ($control != 0) {
            $destroy = Sss::where('id', $id)->delete();
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
            $data = Sss::query();

            return DataTables::of($data)
                ->addColumn('bar', function ($data) {
                    return '<div style="color:rgb(124,77,255);  font-size: 20px; cursor: pointer;" title="change display order">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        </div>';
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
                ->rawColumns(['action', 'bar'])
                ->make(true);
        }
    }

    public function sortable(Request $request)
    {
        $ssses = Sss::all();

        foreach ($ssses as $sss) {
            $sss->timestamps = false; // To disable update_at field updation
            $id = $sss->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    Sss::where('id', $id)->update(['order_number' => $order['position']]);
                }
            }
        }

        return response()->json(['success' => true], 200);
    }
}
