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


    public function wireSearch()
    {

        $contacts = Contact::with('category')->KeywordSearch($this->keyword)
        ->DateSearch($this->date)
        ->CategorySearch($this->category_select)
        ->GenderSearch($this->gender_select)
        ->paginate(7);

    }

        public function render()
    {

        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];

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