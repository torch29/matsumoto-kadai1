<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Livewire\Modal;

class ModalController extends Controller
{
    public function testmodal() {
        return view('livewire.testmodal');
    }
}
