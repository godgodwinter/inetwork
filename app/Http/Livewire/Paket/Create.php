<?php

namespace App\Http\Livewire\Paket;

use App\Models\paket;
use Livewire\Component;

class Create extends Component
{
    public $nama;
    public $harga;
    public $kecepatan;

    /**
     * store function
     */
    public function store()
    {
        $this->validate([
            'nama'   => 'required',
            'harga' => 'required',
            'kecepatan' => 'required',
        ]);

        $post = paket::create([
            'nama'     => $this->nama,
            'harga'   => $this->harga,
            'kecepatan'   => $this->kecepatan
        ]);

        //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        //redirect
        return redirect()->route('paket.index');
    }
    public function render()
    {
        return view('livewire.paket.create')
        ->layout('layouts.adminty');
    }
}
