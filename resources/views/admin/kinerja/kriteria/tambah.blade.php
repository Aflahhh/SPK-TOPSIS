
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Data Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('kriteria.tambah') }}" method="POST">
                @csrf
                <div class="modal-body">                             
                    <div class="row mb-3 align-items-center">
                        <label for="kode_kriteria" class="col-sm-4 col-form-label text-nowrap">Kode Kriteria</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" required>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="nama_kriteria" class="col-sm-4 col-form-label text-nowrap">Kriteria</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" required>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="atribut" class="col-sm-4 col-form-label text-nowrap">Atribut</label>
                        <div class="col-sm-8">
                            <select name="atribut" id="atribut" class="form-control" required>
                                <option value="">Pilih Atribut</option>
                                <option value="cost" {{ old('atribut') == 'cost' ? 'selected' : '' }}>Cost</option>
                                <option value="benefit" {{ old('atribut') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3 align-items-center">
                        <label for="bobot" class="col-sm-4 col-form-label text-nowrap">Bobot</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="bobot" name="bobot" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>            
        </div>
    </div>
</div>

  



