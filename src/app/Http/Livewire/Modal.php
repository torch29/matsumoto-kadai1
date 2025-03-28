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

    /*
    public function wireSearch()
    {

        //$this -> contacts

        $contacts = Contact::with('category')->KeywordSearch($this->keyword)
        ->DateSearch($this->date)
        ->CategorySearch($this->category_select)
        ->GenderSearch($this->gender_select)
        ->paginate(7);

    }
    */

        public function render() //コントローラー 表示するときによばれる プロパティが変わるとよばれる
    {

        if ($this->keyword) {
            $contacts = Contact::with('category')->KeywordSearch($this->keyword)->Paginate(7);
        } else {
            $contacts = Contact::with('category')->Paginate(7);
        }

        //20250324 以下おためし追記 Date,Gender,Category Search
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

        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

        $keywords = $this->keyword;

        return view('livewire.modal', compact('contacts', 'genders', 'categories', 'keywords'));
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