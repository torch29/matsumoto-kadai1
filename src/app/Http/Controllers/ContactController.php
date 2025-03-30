<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //画像の保存に使用するStorageクラス
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Channel; //追加
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //public $selectedContact;

    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        $channels = Channel::all(); //追加

        return view('index', compact('contacts', 'categories', 'channels'));
    }

    public function confirm(ContactRequest $request)
    {

        $category = Category::find($request->category_id);
        $tel = $request->tel1 . $request->tel2 . $request->tel3;
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail', 'channel_ids']);
        $contact['tel'] = $tel;
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        $channelIds = $request->input('channel_ids', []); // nullなら空配列に
        $contact['channel_ids'] = $channelIds;

        $channelNames = Channel::WhereIn('id', $channelIds)->pluck('content')->toArray();

        $img_path = null;
        $image = $request->file('img_path');
        if ($image) {
            $new_name = uniqid(); //新しいファイル名（ランダムな文字数）を作成
            $img_path = Storage::putFileAs(
                'public/tmp',
                $request->file('img_path'),
                $new_name
            ); //一時的にtmpフォルダに保存する
        }

        return view('confirm', compact('contact', 'category', 'genders', 'channelNames', 'img_path'));
    }

    public function store(Request $request)
    {
        $contactData = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        $contact = Contact::create($contactData);

        // アンケートチェックボックス
        if ($request->has('channel_ids')) {
            $contact->channels()->attach($request->input('channel_ids'));
        }

        /* 最初に書いたやつ 画像の移動のみ可能 テーブルに保存はまだ
        $new_img_name = $contact->id; //新しいファイル名：id＋拡張子のファイル名
        if ($request->has('img_path')) {
            Storage::move($request->img_path, 'img/' . $new_img_name); //一時保存のtmpから本番の格納場所imgへ移動
        }
        */

        // 画像の処理
        if ($request->has('img_path') && Storage::exists($request->input('img_path'))) {
            $tmp_img_path = $request->input('img_path');
            $fileName = $contact->id;
            $new_img_path = 'public/img/' . $fileName;

            Storage::move($tmp_img_path, $new_img_path);

            $contact->img_path = $new_img_path;
            $contact->save();
        }

        //dd($request->all());
        //dd($contact);
        return view('thanks');
    }


    public function search(Request $request)
    {

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

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
