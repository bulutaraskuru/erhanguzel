<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Auth;
use Illuminate\Http\Request;
use Illuminate\support\Facades\File;

class indexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function profile()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('site.user.profile', ['user' => $user]);
    }

    public function profile_update(Request $request, $id)
    {
        $all = $request->except('_token');

        $update_user = User::whereId($id)->update([
            'name' => $all['name'],
            'email' => $all['email'],
            'phone' => $all['phone'],
            'phone_two' => $all['phone_two'],
        ]);

        if (isset($update_user)) {
            toast('işlem başarılı bir şekilde gerçekleştir', 'success');

            return redirect()->back();

        }
    }

    public function address()
    {
        $user = User::findOrFail(Auth::user()->id);
        $path_json = public_path('iller.json');
        $provinces = json_decode(File::get($path_json), true);
        $user_address = UserAddress::where('user_id', $user->id)->get();

        return view('site.user.address', ['user' => $user, 'provinces' => $provinces, 'user_address' => $user_address]);
    }

    public function address_store(Request $request, $user_id)
    {
        $all = $request->except('_token');
        $create = UserAddress::create([
            'user_id' => $user_id,
            'title' => $all['title'],
            'name' => $all['name'],
            'phone' => $all['phone'],
            'address' => $all['address'],
            'province' => $all['province'],
            'is_invoice' => $all['is_invoice'] ?? 0,
        ]);
        if (isset($create)) {
            toast('Adres başarılı bir şekilde eklendi.', 'success');

            return redirect()->back();
        }
    }

    public function address_destroy(Request $request, $id)
    {
        $delete = UserAddress::where('id', $id)->delete();

        if (isset($delete)) {
            toast('Adres başarışı bir şekilde silindi.', 'success');

            return redirect()->back();
        }
    }
}
