<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}"> 

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
    <main id="wrapper-form">
        <div class="wrapper-register">
            <div class="container">
                <!-- Registrasi Umum -->
                <div id="form-regis-umum">
                    <h1 class=" mb-5 fw-bold">Register</h1>
                    <form action="{{ route('store.umum') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="role" value="1">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control shadow-none" value="{{ old('nama') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control shadow-none @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="custom-select shadow-none" name="jenis_kelamin">
                                        <option value="laki - laki">Laki - Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="kota" value="{{ old('kota') }}" class="form-control shadow-none" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea rows="3" name="alamat" class="form-control shadow-none" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No Hp</label>
                                    <input type="text" name="notelp" value="{{ old('notelp') }}" class="form-control shadow-none" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control shadow-none @error('password') is-invalid @enderror" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ulangi Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control shadow-none" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="form-control btn btn-primary p-2 mt-3">Register</button>
                    </form>
                    <p class="text-center mt-5 text-dark">Sudah Punya Akun ? <a href="/login/u">Login</a></p>
                    <p class="text-center text-dark">Register Untuk Petani ? <a href="/register/p">Disini</a></p>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>

</html>