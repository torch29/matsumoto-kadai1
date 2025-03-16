<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{

    public function signup() {
        return view('auth.register');
    }


    public function signin() {
        return view('auth.login');
    }

    public function admin() {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        return view('admin', compact('contacts', 'genders', 'categories'));
    }

    public function logout() {
        return view('auth.login');
    }

}
