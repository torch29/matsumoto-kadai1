<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(Request $request) {
        //$contacts = Contact::with('category')->get();
        $category = Category::find($request->category_id);
        $tel = $request -> tel1 . $request -> tel2 . $request -> tel3;
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contact['tel'] = $tel;
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        //dd($request->all()); //デバッグ用
        return view('confirm', compact('contact', 'category', 'genders'));
    }

    public function store(Request $request) {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);

        return view('thanks');
    }


    /*
    //以下、検索機能の追加
    public function search(Request $request) {
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)
        ->DateSearch($request->date)
        ->CategorySearch($request->category_select)
        ->GenderSearch($request->gender_select)
        ->Paginate(7);
        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        //dd($request->all());
        return view('admin', compact('contacts', 'categories', 'genders'));
    }
        */


    public function search(Request $request) {
    // リクエスト内容を確認するデバッグ
    //dd($request->all());

    $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)
        ->DateSearch($request->date)
        ->CategorySearch($request->category_select)
        ->GenderSearch($request->gender_select);

    // 実行されるSQLを確認
    //dd($contacts->toSql(), $contacts->getBindings());

    $contacts = $contacts->paginate(7)->appends($request->query());

    $categories = Category::all();
    $genders = [
        1 => '男性',
        2 => '女性',
        3 => 'その他'
    ];

    return view('admin', compact('contacts', 'categories', 'genders'));
}
}
