@extends('components.app-layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Pengaturan -->
            <div class="card" id="settingsCard">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Pengaturan Akun') }}</span>
                </div>

                <div class="card-body">
                    <!-- Menampilkan pesan sukses jika ada -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form untuk pengaturan akun -->
                    <form action="{{ route('admin.updateSettings') }}" method="POST">
                        @csrf
                        <!-- Pengaturan Username -->
                        <div class="form-group">
                            <input type="text" class="form-control username-input @error('username') is-invalid @enderror" 
                                   id="username" name="username" value="{{ Auth::user()->username }}" placeholder="Username Baru" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pengaturan Password -->
                        <div class="form-group">
                            <input type="password" class="form-control password-input @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" placeholder="Password Saat Ini" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div class="form-group">
                            <input type="password" class="form-control password-input @error('new_password') is-invalid @enderror" 
                                   id="new_password" name="new_password" placeholder="Password Baru">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="form-group">
                            <input type="password" class="form-control password-input" id="new_password_confirmation" name="new_password_confirmation" placeholder="Konfirmasi Password Baru">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS untuk styling khusus halaman ini -->
<style>
    /* Pembungkus untuk card pengaturan */
    #settingsCard {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 20px;
    }

    #settingsCard .card-header {
        background-color: #f8f9fa;
        font-size: 1.5rem;
        font-weight: 600;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-body {
        padding: 20px;
        background-color: #fdfdfe;
    }

    .form-group {
        margin-bottom: 20px;
    }

    /* Memperbesar ukuran input form agar terlihat lebih besar */
    .username-input,
    .password-input {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 15px;
        font-size: 1.1rem;
        width: 100%;
        display: block;
        margin-bottom: 10px;
    }

    .username-input:focus,
    .password-input:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
    }

    .btn {
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

</style>
@endsection
