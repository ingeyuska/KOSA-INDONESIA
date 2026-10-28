<div class="card shadow-sm">

    <div class="card-body">

        <h5 class="mb-4">
            Data Akun
        </h5>


        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nama
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama', $alumni->nama ?? '') }}"
                    required>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $alumni->email ?? '') }}"
                    required>

            </div>

        </div>


        <hr>


        <h5 class="mb-4">
            Data Alumni
        </h5>


        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Angkatan
                </label>

                <input
                    type="text"
                    name="angkatan"
                    class="form-control"
                    value="{{ old('angkatan', $alumni->angkatan ?? '') }}">

            </div>


            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Jurusan
                </label>

                <input
                    type="text"
                    name="jurusan"
                    class="form-control"
                    value="{{ old('jurusan', $alumni->jurusan ?? '') }}">

            </div>


            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Fakultas
                </label>

                <input
                    type="text"
                    name="fakultas"
                    class="form-control"
                    value="{{ old('fakultas', $alumni->fakultas ?? '') }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Program
                </label>

                <select
                    name="program"
                    class="form-select">

                    <option value="">
                        -- Pilih Program --
                    </option>

                    <option value="Degree"
                        @selected(old('program', $alumni->program ?? '') === 'Degree')>
                        Degree
                    </option>

                    <option value="Short Course"
                        @selected(old('program', $alumni->program ?? '') === 'Short Course')>
                        Short Course
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Klasifikasi Program
                </label>

                <select
                    name="klasifikasi_program"
                    class="form-select">

                    <option value="">
                        -- Pilih Klasifikasi --
                    </option>

                    <option value="Short Course"
                        @selected(old('klasifikasi_program', $alumni->klasifikasi_program ?? '') === 'Short Course')>
                        Short Course
                    </option>

                    <option value="Master"
                        @selected(old('klasifikasi_program', $alumni->klasifikasi_program ?? '') === 'Master')>
                        Master
                    </option>

                    <option value="PhD"
                        @selected(old('klasifikasi_program', $alumni->klasifikasi_program ?? '') === 'PhD')>
                        PhD
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jenis Kelamin
                </label>

                <select
                    name="jenis_kelamin"
                    class="form-select">

                    <option value="">
                        -- Pilih Jenis Kelamin --
                    </option>

                    <option value="Laki-laki"
                        @selected(old('jenis_kelamin', $alumni->jenis_kelamin ?? '') === 'Laki-laki')>
                        Laki-laki
                    </option>

                    <option value="Perempuan"
                        @selected(old('jenis_kelamin', $alumni->jenis_kelamin ?? '') === 'Perempuan')>
                        Perempuan
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jenis Keilmuan
                </label>

                <select
                    name="jenis_keilmuan"
                    class="form-select">

                    <option value="">
                        -- Pilih Bidang --
                    </option>

                    <option value="Social Science"
                        @selected(old('jenis_keilmuan', $alumni->jenis_keilmuan ?? '') === 'Social Science')>
                        Social Science
                    </option>

                    <option value="STEM"
                        @selected(old('jenis_keilmuan', $alumni->jenis_keilmuan ?? '') === 'STEM')>
                        STEM
                    </option>

                </select>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Pekerjaan
                </label>

                <input
                    type="text"
                    name="pekerjaan"
                    class="form-control"
                    value="{{ old('pekerjaan', $alumni->pekerjaan ?? '') }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Institusi / Universitas
                </label>

                <input
                    type="text"
                    name="institusi"
                    class="form-control"
                    value="{{ old('institusi', $alumni->institusi ?? '') }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Pendidikan
                </label>

                <input
                    type="text"
                    name="pendidikan"
                    class="form-control"
                    value="{{ old('pendidikan', $alumni->pendidikan ?? '') }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Domisili
                </label>

                <input
                    type="text"
                    name="domisili"
                    class="form-control"
                    value="{{ old('domisili', $alumni->domisili ?? '') }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    class="form-control"
                    value="{{ old('no_hp', $alumni->nomor_hp ?? '') }}">

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Telepon Kantor
                </label>

                <input
                    type="text"
                    name="telepon_kantor"
                    class="form-control"
                    value="{{ old('telepon_kantor', $alumni->telepon_kantor ?? '') }}">

            </div>


            <div class="col-12 mb-3">

                <label class="form-label">
                    Alamat Kantor
                </label>

                <textarea
                    name="alamat_kantor"
                    class="form-control"
                    rows="3">{{ old('alamat_kantor', $alumni->alamat_kantor ?? '') }}</textarea>

            </div>


            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Foto
                </label>

                <input
                    type="file"
                    name="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp">

                @if(isset($alumni) && $alumni->foto)

                    <div class="mt-2">

                        <img
                            src="{{ asset('storage/' . $alumni->foto) }}"
                            width="100"
                            style="border-radius:10px;">

                    </div>

                @endif

            </div>

        </div>


        <div class="mt-4">

            <a
                href="{{ route('admin.alumni.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

            <button
                type="submit"
                class="btn btn-primary">

                {{ isset($alumni) ? 'Simpan Perubahan' : 'Simpan Alumni' }}

            </button>

        </div>

    </div>

</div>