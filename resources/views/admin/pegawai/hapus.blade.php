{{-- toast --}}
@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    Data Berhasil Ditambahkan
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('berhasil'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    Data Berhasil Diubah
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('selesai'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    Data Berhasil Dihapus   
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



@foreach($pegawai as $data)
<div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" aria-labelledby="HapusLabel{{ $data->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapusLabel{{ $data->id }}">Hapus Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <i>Apakah Anda Yakin Ingin Menghapus Data Ini?</i>
        </div>  
        <form action="{{ url('/pegawai/hapus/' . $data->id) }}" method="POST">
          @method('DELETE')
          @csrf
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-danger">Hapus Data</button>
          </div>
        </form>
        
    </div>
  </div>
</div>
@endforeach
