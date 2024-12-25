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
                <h5 class="modal-title" id="modalTambahLabel">Tambah Data Sub Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('subkriteria.tambah') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="nama_kriteria" class="col-sm-4 col-form-label text-nowrap">Kriteria</label>
                        <div class="col-sm-8">
                            <select name="kriteria_id" id="kriteria_id" class="form-control mt-2 mb-2" required>
                                <option value="">Pilih Kriteria</option>
                                @foreach ($kriteria as $data)
                                    <option value="{{ $data->id }}" 
                                            data-kode="{{ $data->kode_kriteria }}" 
                                            {{ old('kriteria_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_kriteria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kode_kriteria" class="col-sm-4 col-form-label text-nowrap">Kode Kriteria</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_subkriteria" class="col-sm-4 col-form-label text-nowrap">Sub kriteria </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_subkriteria" name="nama_subkriteria" required>
                        </div>
                    </div>
                    <div class="row mb-3">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kriteriaSelect = document.getElementById('kriteria_id');
        const kodeKriteriaInput = document.getElementById('kode_kriteria');

        kriteriaSelect.addEventListener('change', function () {
            const selectedOption = kriteriaSelect.options[kriteriaSelect.selectedIndex];
            const kodeKriteria = selectedOption.getAttribute('data-kode');
            kodeKriteriaInput.value = kodeKriteria || ''; // Set nilai input read-only
        });
    });
</script>
