<?php

namespace App\Http\Controllers\Admin\User;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    protected $model;

    protected $model_text;

    protected $roles;

    public function __construct()
    {
        $this->model = 'user';
        $this->model_text = Lang::get('cms.'.$this->model);
        $this->roles = Role::all();
    }

    public function index()
    {
        $button_link = route('admin.'.$this->model.'.create');

        return view('admin.'.$this->model.'.index', [
            'button_link' => $button_link,
            'roles' => $this->roles,
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
            'roles' => $this->roles,
        ]);
    }

    public function store(UserRequest $request)
    {
        $all = $request->except('_token');
        $create_user = User::create([
            'name' => $all['name'],
            'password' => $all['password'],
            'email' => $all['email'],
        ]);

        $create_user->assignRole([$all['role']]);

        if (isset($create_user)) {
            toast(Lang::get('cms.success_text'), 'success');

            return redirect()->route('admin.user.index');
        } else {
            toast(Lang::get('cms.error_text'), 'success');

            return redirect()->route('admin.user.index');
        }
    }

    public function show(Request $request, $id)
    {
        $data = User::findOrFail($id);
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
        $data = User::findOrFail($id);
        $user_role = $data->roles->pluck('id')->all()[0];
        $button_link = route('admin.'.$this->model.'.index');

        return view('admin.'.$this->model.'.edit', [
            'user_role' => $user_role,
            'data' => $data,
            'button_link' => $button_link,
            'roles' => $this->roles,
            'model' => $this->model,
            'model_text' => $this->model_text,
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $all = $request->except('_token');

        $user = User::findOrFail($id);

        if (isset($all['password'])) {
            $update_password = User::where('id', $id)->update([
                'password' => Hash::make($all['password']),
            ]);
        }

        $update_user = User::where('id', $id)->update([
            'name' => $all['name'],
            'email' => $all['email'],
        ]);

        $user->assignRole([$all['role']]);

        if (isset($update_user)) {
            toast(Lang::get('cms.success_text'), 'success');

            return redirect()->route('admin.user.index');
        } else {
            toast(Lang::get('cms.error_text'), 'success');

            return redirect()->route('admin.user.index');
        }
    }

    public function destroy($id)
    {
        $control = User::where('id', $id)->count();
        if ($control != 0) {
            $destroy = User::where('id', $id)->delete();
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
            $data = User::select('users.*', 'roles.name as role_name', 'roles.display_name as display_name')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('model_has_roles.model_type', 'App\\Models\\User');

            return DataTables::of($data)
                ->editColumn('is_active', function ($data) {
                    return $data->is_active == 1 ? 'Aktif' : 'Pasif';
                })
                ->editColumn('last_seen', function ($data) {
                    return $data->last_seen != null ? date('d.m.Y H:i:s', strtotime($data->last_seen)) : 'Giriş Yapmadı';
                })
                ->editColumn('roles', function ($data) {
                    return $data->role_name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.user.component.table-button', ['data' => $data, 'model' => $this->model]);
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') != 'all') {
                        $instance->where('users.is_active', $request->get('is_active'));
                    }

                    if ($request->get('text') != null) {
                        $instance->where('users.name', 'LIKE', '%'.$request->get('text').'%')->orWhere('users.email', 'LIKE', '%'.$request->get('text').'%');
                    }

                    if ($request->get('roles') != 'all') {
                        $instance->role($request->get('roles'));
                    }
                })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }
    }

    public function export(Request $request)
    {
        $all = $request->except('_token');

        return Excel::download(new UserExport($all), $this->model_text.'_'.time().'.xlsx');
    }
}
