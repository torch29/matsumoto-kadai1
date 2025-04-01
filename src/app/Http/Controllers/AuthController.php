<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Channel;

class AuthController extends Controller
{

    public function signup()
    {
        return view('auth.register');
    }


    public function signin()
    {
        return view('auth.login');
    }

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
}
