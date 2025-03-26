<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Channel; //追加
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //public $selectedContact;

    public function index() {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        $channels = Channel::all(); //追加

        return view('index', compact('contacts', 'categories', 'channels'));

    }

    public function confirm(ContactRequest $request) {

        $category = Category::find($request->category_id);
        $tel = $request -> tel1 . $request -> tel2 . $request -> tel3;
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contact['tel'] = $tel;
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        $channel = Channel::find($request->channel_id);

        return view('confirm', compact('contact', 'category', 'genders', 'channel'));
    }

    public function store(Request $request) {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);

        return view('thanks');
    }


    public function search(Request $request) {

    $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)
        ->DateSearch($request->date)
        ->CategorySearch($request->category_select)
        ->GenderSearch($request->gender_select);

    $contacts = $contacts->paginate(7)->appends($request->query());

    $categories = Category::all();
    $genders = [
        1 => '男性',
        2 => '女性',
        3 => 'その他'
    ];

    return view('admin', compact('contacts', 'categories', 'genders'));
}

    public function delete(Request $request) {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

}
