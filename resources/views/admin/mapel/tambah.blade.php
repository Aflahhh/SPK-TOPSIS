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
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Data Mata Pelajaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
   
    
    <form action="{{ route('mapel.tambah') }}" method="POST">
        @csrf
        <div class="modal-body">
        
            <div class="row mb-3">
                <label for="mapel" class="col-sm-4 col-form-label text-nowrap">Mata Pelajaran</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="mapel" name="mapel" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
    </form> 

    
    </div>
</div>
</div>


