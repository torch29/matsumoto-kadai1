<?php
/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Livewire\Modal;
use App\Models\Contact;
use App\Models\Category;

class ModalController extends Controller
{

        public function testmodal() {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        return view('livewire.testmodal', compact('contacts', 'genders', 'categories'));
    }
}
*/