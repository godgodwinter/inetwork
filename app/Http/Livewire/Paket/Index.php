<?php

namespace App\Http\Livewire\Paket;

use Livewire\Component;

use App\Models\paket as ModelsPaket;

class Index extends Component
{
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
