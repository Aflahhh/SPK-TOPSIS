@foreach($mapel as $data)
<div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Data Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('master/mapel/hapus/' .$data->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <i>Apakah Anda Yakin Ingin Menghapus Data?</i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach