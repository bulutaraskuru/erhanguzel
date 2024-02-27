<?php

namespace App\Http\Controllers\Site\Contact;

use App\Http\Controllers\Controller;
use App\Mail\VoluntarilyMail;
use App\Models\Voluntarily;
use Illuminate\Http\Request;
use Mail;

class indexController extends Controller
{
    public function index()
    {
        $page_title = 'İletişim';

        return view('site.contact.index', [
            'page_title' => $page_title,
        ]);
    }

    public function voluntarily(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:voluntarilies,email', // Replace 'voluntarilies' with the actual table name
            'phone' => 'required|unique:voluntarilies,phone', // Replace 'voluntarilies' with the actual table name
            'neighbourhood' => 'required',
            'year' => 'required|numeric',
        ], [
            'name.required' => 'Ad ve Soyad alanı zorunludur.',
            'email.required' => 'E-mail alanı zorunludur.',
            'email.email' => 'Geçerli bir e-mail adresi giriniz.',
            'email.unique' => 'Bu e-mail adresi zaten kullanılıyor.',
            'phone.required' => 'Telefon No alanı zorunludur.',
            'phone.unique' => 'Bu telefon numarası zaten kullanılıyor.',
            'neighbourhood.required' => 'Mahalle alanı zorunludur.',
            'year.required' => 'Doğum Yılı alanı zorunludur.',
            'year.numeric' => 'Doğum Yılı sadece rakamlardan oluşmalıdır.',
        ]);
        //        Mail::to('site@erhanguzel.com.tr')->send(new VoluntarilyMail($request->all()));
        $create = Voluntarily::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'message' => $request->get('message'),
            'neighbourhood' => $request->get('neighbourhood'),
            'year' => $request->get('year'),
        ]);

        return response()->json(['message' => 'Success', 'data' => $request->all()], 200);
    }
}
