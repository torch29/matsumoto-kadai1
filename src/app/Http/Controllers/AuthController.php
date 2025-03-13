<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\AuthRequest;
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
        $contacts = Contact::Paginate(7);
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        //$categories = Category::with('category')->get(); // ここを修正していく
        return view('admin', compact('contacts', 'genders'));
    }

    public function logout() {
        return view('auth.login');
    }
}
