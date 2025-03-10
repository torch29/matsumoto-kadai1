<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    /*public function admin() {
        $contacts = Contact::Paginate(5);
        return view('/admin', ['contacts' => $contacts]);
    }*/

    public function register() {
        return view('/auth/login');
    }

    public function login() {
        return view('/admin');
    }

    public function logout() {
        return view('/auth/login');
    }
}
