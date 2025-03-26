<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;
use App\Models\Category;

class Modal extends Component
{
    public $showModal = false;
    public $selectedContact;

    public $keyword;
    public $date;
    public $category_select;
    public $gender_select;
    //public $contacts;

    use WithPagination;
        protected $paginationTheme = 'bootstrap';


    public function wireSearch()
    {

        $this -> resetPage();
        //ページネーションをリセットして１ページ目にする

        /*
        $contacts = Contact::with('category')->KeywordSearch($this->keyword)
        ->DateSearch($this->date)
        ->CategorySearch($this->category_select)
        ->GenderSearch($this->gender_select)
        ->paginate(7);
        */

    }


        public function render() //コントローラー 表示するときによばれる プロパティが変わるとよばれる
    {

        if (!$this->keyword && !$this->gender_select && !$this->category_select && !$this->date) {
            $query = Contact::with('category');
        } else {
            $query = Contact::query();
            if ($this->keyword) {
                $query->KeywordSearch($this->keyword);
            }
            if ($this->gender_select) {
                $query->GenderSearch($this->gender_select);
            }
            if ($this->category_select) {
                $query->CategorySearch($this->category_select);
            }
            if ($this->date) {
                $query->DateSearch($this->date);
            }
        }

        /*
        if ($this->keyword) {
            $contacts = Contact::with('category')->KeywordSearch($this->keyword)->Paginate(7);
        } else {
            $contacts = Contact::with('category')->Paginate(7);
        }

        //20250324 以下おためし追記 Date,Gender,Category Search ちゃんと動かせなかったやつ
        if ($this->date) {
            $contacts = Contact::with('category')->DateSearch($this->date)->Paginate(7);
        } elseif($this->gender_select) {
            $contacts = Contact::with('category')->GenderSearch($this->gender_select)->Paginate(7);
        } elseif($this->category_select) {
            $contacts = Contact::with('category')->CategorySearch($this->category_select)->Paginate(7);
        } else {
            $contacts = Contact::with('category')->Paginate(7);
        }
        //お試し追記ここまで
        */

        /*リアルタイムでない検索 のときつかう
        $keyword = request()->keyword;
        $gender_select = request()->gender_select;
        $category_select = request()->category_select;
        $date = request()->date;

        if (!$keyword && !$gender_select && !$category_select && !$date) {
            $query = Contact::with('category');
        } else {
            $query = Contact::query();
            if ($keyword) {
                $query->KeywordSearch($keyword);
            }
            if ($gender_select) {
                $query->GenderSearch($gender_select);
            }
            if ($category_select) {
                $query->CategorySearch($category_select);
            }
            if ($date) {
                $query->DateSearch($date);
            }
        }
        */

        /* リアルタイムでない検索 のとき使う
        $contacts = $query->paginate(7)->withQueryString()->withPath('/admin');
        */

        $contacts = $query->paginate(7);
        //リアルタイム検索

        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        /* リアルタイムでない検索 のときはこちら
        return view('livewire.modal', compact('contacts', 'genders', 'categories', 'keyword', 'gender_select', 'category_select', 'date'));
        */

        return view('livewire.modal', compact('contacts', 'genders', 'categories'));

    }

    public function openModal($contactId)
    {
        $this->selectedContact = Contact::with('category')->find($contactId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedContact = null;
    }

    public function deleteContact() {
        if ($this->selectedContact) {
            $this->selectedContact->delete();
            $this->closeModal();
        }
    }
}