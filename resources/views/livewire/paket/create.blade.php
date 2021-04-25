

        <div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="form-group">
                    <label>Nama </label>
                    <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama">
                    @error('nama')
                        <span class="invalid-feedback">
                                {{ $message }}
                         </span>
                    @enderror
                <div class="form-group">
                    <label>Harga </label>
                    <input type="text" wire:model="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="Masukkan harga">
                    @error('harga')
                        <span class="invalid-feedback">
                                {{ $message }}
                         </span>
                    @enderror
                <div class="form-group">
                    <label>Kecepatan </label>
                    <input type="text" wire:model="kecepatan" class="form-control @error('kecepatan') is-invalid @enderror" placeholder="Masukkan kecepatan">
                    @error('kecepatan')
                        <span class="invalid-feedback">
                                {{ $message }}
                         </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
        </div>
    </div>
</div>
