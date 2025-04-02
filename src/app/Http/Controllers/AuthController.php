<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 現在認証しているユーザーID取得のために追加
use App\Models\Contact;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Profile;


class AuthController extends Controller
{

    /*
    public function signup()
    {
        return view('auth.register');
    }
        */

    /* 不要
    public function signin()
    {
        return view('auth.login');
    }
        */

    public function admin()
    {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        $channels = Contact::with('channels');
        return view('admin', compact('contacts', 'genders', 'categories', 'channels'));
    }

    public function logout()
    {
        return view('auth.login');
    }

    public function profile()
    {
        $id = Auth::id(); //現在認証しているユーザIDを取得
        $user = Auth::user();
        //$inputs = ['user_id' => $id];

        return view('auth.profile', compact('id', 'user'));
    }

    public function profile_entry(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        //$inputs = ['user_id' => $id];
        $profile = $request->only(['gender', 'birthday']);
        $profile['user_id'] = $user->id;
        //$profile = $request->only(['user_id', 'gender', 'birthday']);
        Profile::create($profile);

        //return redirect('/admin')->with('message', 'プロフィールを登録しました');
        return redirect('/admin');
    }
}
