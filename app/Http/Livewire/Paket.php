<?php

namespace App\Http\Livewire;

use Livewire\Component;

use UxWeb\SweetAlert\SweetAlert;
use Alert;
use App\Models\paket as ModelsPaket;
// use SweetAlert;

class Paket extends Component
{
    public $search;
    public $name;
    protected $updatequeryString = ['search'];
    public $data, $nama, $harga, $kecepatan, $selected_id;
    public $updateMode = false;

    public function render()
    {


        //data
        $pakets=ModelsPaket::all();

            return view('livewire.paket',[
                'pakets'=>$pakets
            ])
            ->layout('layouts.adminty');
    }



}
