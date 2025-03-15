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

    use WithPagination;
        protected $paginationTheme = 'bootstrap';

    //public $contacts;

    public function wireSearch()
    {
        //dd($this->keyword, $this->date, $this->category_select, $this->gender_select);
        
        /*
        $contacts = Contact::with('category')
        ->KeywordSearch('keyword')
        ->DateSearch('date')
        ->CategorySearch('category_select')
        ->GenderSearch('gender_select')
        ->Paginate(7);
        */

        /*$this->contacts = Contact::with('category')*/

        $contacts = Contact::with('category')->KeywordSearch($this->keyword)
        ->DateSearch($this->date)
        ->CategorySearch($this->category_select)
        ->GenderSearch($this->gender_select)
        ->paginate(7);

        //dd($this->keyword, $this->date, $this->category_select, $this->gender_select);  // デバッグ

    }

        public function render()
    {

        //return view('livewire.modal');
        //初期データがない場合に表示
        /*$contacts = $this->contacts ?? Contact::with('category')->Paginate(7);*/

        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

            // searchメソッドが呼び出されていない場合は全てのデータを表示
        /*
        if (!isset($this->contacts)) {
            $contacts = Contact::with('category')->paginate(7);
        } else {
            $contacts = $this->contacts;
        }
        */

        /*
        if ($this->keyword) {
        $contacts = Contact::with('category')
            ->KeywordSearch($this->keyword)
            ->DateSearch($this->date)
            ->CategorySearch($this->category_select)
            ->GenderSearch($this->gender_select)
            ->Paginate(7);
        }
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