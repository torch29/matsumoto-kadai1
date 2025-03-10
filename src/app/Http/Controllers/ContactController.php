<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        return view('admin', compact('contacts', 'genders'));
    }



}
