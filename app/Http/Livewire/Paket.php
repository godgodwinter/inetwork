<?php

namespace App\Http\Livewire;

use Livewire\Component;

use UxWeb\SweetAlert\SweetAlert;
use Alert;
use App\Models\paket as ModelsPaket;
// use SweetAlert;

class Paket extends Component
{

    // protected $listeners=[
    //     //update suplier

    //     'removeItem'=>'updateKeranjang'
    // ];
    public $data, $nama, $harga, $kecepatan, $selected_id;
    public $updateMode = false;

    public function render()
    {

        // alert
        Alert::success('pesan yang ingin disampaikan', 'Judul Pesan');

        //data
        $pakets=ModelsPaket::all();

            return view('livewire.paket',[
                'pakets'=>$pakets
            ])
            ->layout('layouts.adminty');
    }

    private function resetInput()
    {
        $this->nama = null;
        $this->harga = null;
        $this->kecepatan = null;
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required|min:1'
        ]);
        ModelsPaket::create([
            'nama' => $this->nama,
            'kecepatan' => $this->kecepatan,
            'harga' => $this->harga
        ]);
        $this->resetInput();
    }
    public function destroy($id)
    {
        if ($id) {
            $record = ModelsPaket::where('id', $id);
            $record->delete();
        }
    }

}
