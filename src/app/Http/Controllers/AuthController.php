<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AuthController extends Controller
{

    public function signup() {
        return view('auth.register');
    }


    public function signin() {
        return view('auth.login');
    }

    public function index() {
        $contacts = Contact::Paginate(7);
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        return view('admin', compact('contacts', 'genders'));
    }

    public function logout() {
        return view('auth.login');
    }
}
