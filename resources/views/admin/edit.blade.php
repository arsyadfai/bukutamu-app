@extends('components.app-layout') <!-- Menggunakan layout utama -->

@section('content')
    <div class="main-content flex-grow-1 p-4" id="mainContent">
        <div class="container form-container">
            <h1 class="text-center mb-4">Edit Data Tamu</h1>

            <!-- Notifikasi Sukses atau Gagal -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Card untuk Form -->
            <div class="card shadow-lg border-light p-4">
                <form action="{{ route('admin.update', $guest->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control floating-label" placeholder=" " value="{{ old('name', $guest->name) }}" required>
                                <label for="name">Nama:</label>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="alamat" id="alamat" class="form-control floating-label" placeholder=" " value="{{ old('alamat', $guest->alamat) }}" required>
                                <label for="alamat">Alamat:</label>
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="nope" id="nope" class="form-control floating-label" placeholder=" " value="{{ old('nope', $guest->nope) }}" required>
                                <label for="nope">Nomor Telepon:</label>
                                @error('nope')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="Laki-laki" {{ $guest->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $guest->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="bertemu" id="bertemu" class="form-control floating-label" placeholder=" " value="{{ old('bertemu', $guest->bertemu) }}" required>
                                <label for="bertemu">Bertemu Dengan:</label>
                                @error('bertemu')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="keperluan" id="keperluan" class="form-control floating-label" placeholder=" " value="{{ old('keperluan', $guest->keperluan) }}" required>
                                <label for="keperluan">Keperluan:</label>
                                @error('keperluan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="photo"></label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        @if($guest->photo)
                            <img src="{{ asset($guest->photo) }}" alt="Guest Photo" width="100" class="mt-2">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection


