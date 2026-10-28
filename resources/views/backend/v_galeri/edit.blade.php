@extends('backend.v_layout.app')

@section('title', 'Edit Galeri')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Edit Galeri</h4>
            <p class="text-muted mb-0">
                Ubah informasi galeri atau tambahkan foto.
            </p>
        </div>

        <a href="{{ route('admin.galeri.index') }}"
           class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>


    {{-- FORM EDIT GALERI --}}
    <form action="{{ route('admin.galeri.update', $galeri) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <h5 class="mb-3">Informasi Galeri</h5>

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label class="form-label">Judul Galeri</label>

                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $galeri->judul) }}"
                           required>
                </div>


                {{-- TANGGAL --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', optional($galeri->tanggal)->format('Y-m-d')) }}">
                </div>


                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select" required>

                        <option value="published"
                            {{ $galeri->status == 'published' ? 'selected' : '' }}>
                            Published
                        </option>

                        <option value="draft"
                            {{ $galeri->status == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                    </select>
                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                </div>

            </div>
        </div>


        {{-- FOTO YANG SUDAH ADA --}}
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">Foto Galeri</h5>

                <div class="row g-3">

                    @forelse($galeri->foto as $foto)

                        <div class="col-md-3">

                            <div class="card h-100">

                                <img src="{{ asset('storage/' . $foto->file_foto) }}"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover;">

                                <div class="card-body p-2">

                                    {{-- FORM HAPUS FOTO --}}
                                    <button type="button"
                                            class="btn btn-danger btn-sm w-100"
                                            onclick="hapusFoto({{ $foto->id }})">

                                        <i class="bi bi-trash me-1"></i>
                                        Hapus Foto

                                    </button>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">
                            <p class="text-muted mb-0">
                                Belum ada foto dalam galeri ini.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- TAMBAH FOTO --}}
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">Tambah Foto</h5>

                <input type="file"
                       name="foto[]"
                       class="form-control"
                       accept="image/jpeg,image/png,image/webp"
                       multiple>

                <small class="text-muted">
                    Kamu bisa memilih beberapa foto sekaligus.
                </small>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="d-flex justify-content-end gap-2 mb-4">

            <a href="{{ route('admin.galeri.index') }}"
               class="btn btn-secondary">
                Batal
            </a>

            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-save me-1"></i>
                Simpan Perubahan

            </button>

        </div>

    </form>


    {{-- FORM HAPUS FOTO --}}
    @foreach($galeri->foto as $foto)

        <form id="form-hapus-{{ $foto->id }}"
              action="{{ route('admin.galeri.foto.destroy', $foto->id) }}"
              method="POST"
              style="display:none;">

            @csrf
            @method('DELETE')

        </form>

    @endforeach


</div>


<script>
function hapusFoto(id) {

    if (confirm('Yakin ingin menghapus foto ini?')) {
        document.getElementById('form-hapus-' + id).submit();
    }

}
</script>

@endsection