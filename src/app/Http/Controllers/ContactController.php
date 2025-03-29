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
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail', 'channel_ids']);
        $contact['tel'] = $tel;
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        //間違い $channel_ids = $request->input('channel_ids');
        //間違い $cn = Channel::where('id', $request)->get();

        //間違い $ch_id = Channel::where('channel_id', $request)->get('id');

        /* 間違い
        if(is_array($request->input('channel_ids'))){
            $query->where(function($q) use($request){
                foreach($request->input('channel_ids') as $channel_ids){
                    $q->orWhere('channel_ids', $channel_ids);
                }
            });
        }
        */

        $channelNames = Channel::WhereIn('id', $request->input('channel_ids'))->pluck('content')->toArray();

        return view('confirm', compact('contact', 'category', 'genders', 'channelNames'));
    }

    public function store(Request $request) {
        $contactData = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        $contact = Contact::create($contactData);

        if($request->has('channel_ids')) {
            $contact->channels()->attach($request->input('channel_ids'));
        }

        //dd($request->all());
        //dd($contact);
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
