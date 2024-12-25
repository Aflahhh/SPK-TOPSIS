<!-- Modal Edit-->
@foreach ($pensiun as $data)
  <div class="modal fade" id="edit{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('pensiun/edit/' . $data->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="card-body" style="margin-top: 10px;">
              <div class="mb-3">
                <label for="id_pegawai" class="form-label" style="color: grey;">Nama Pegawai</label>
                <input class="form-control" type="text" id="id_pegawai" name="id_pegawai" value="{{ $data->id_pegawai }}" autofocus/>
              </div>
              <div class="mb-3">
                <label for="id_jabatan" class="form-label" style="color: grey;">Jabatan</label>
                <input class="form-control" type="text" id="id_jabatan" name="id_jabatan" value="{{ $data->id_jabatan }}" autofocus/>
              </div>
              <div class="mb-3">
                <label for="id_golongan" class="form-label" style="color: grey;">id_golongan</label>
                <input class="form-control" type="text" id="id_golongan" name="id_golongan" value="{{ $data->id_golongan }}" autofocus/>
              </div>
              <div class="mb-3">
                <label for="tgl_pengajuan" class="form-label" style="color: grey;">Tanggal Pengajuan</label>
                <input class="form-control" type="date" id="tgl_pengajuan" name="tgl_pengajuan" value="{{ $data->tgl_pengajuan }}" autofocus/>
              </div>
              <div class="mb-3">
                <label for="tgl_pensiun" class="form-label" style="color: grey;">Tanggal Akan Pensiun</label>
                <input class="form-control" type="date" id="tgl_pensiun" name="tgl_pensiun" value="{{ $data->tgl_pensiun }}" autofocus/>
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

@endforeach