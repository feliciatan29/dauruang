<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/minicon.png') }}" />
    <title>Register Nasabah | DaurUang</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }
        .container { display: flex; height: 100vh; }
        .left-side { flex: 1; background-color: #fff; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px; text-align: center; }
        .left-side h1 { color: #115c3b; font-size: 24px; margin-bottom: 20px; font-weight: bold; }
        .left-side img { max-width: 350px; height: auto; margin-bottom: 20px; }
        .left-side p { font-size: 18px; color: #115c3b; font-weight: 600; }
        .right-side { flex: 1; background-color: #0d4028; display: flex; justify-content: center; align-items: center; padding: 40px; }
        .register-box { width: 100%; max-width: 400px; color: #fff; }
        .register-box h2 { font-size: 28px; margin-bottom: 20px; font-weight: bold; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 12px; border: none; border-radius: 6px; font-size: 14px; margin-top: 5px; }
        .btn-register { width: 100%; padding: 12px; background-color: #fff; color: #115c3b; border: none; border-radius: 6px; font-weight: bold; font-size: 16px; cursor: pointer; }
        .btn-register:hover { background-color: #f0f0f0; }
        .link-login { margin-top: 10px; display: block; text-align: center; color: #fff; font-size: 14px; text-decoration: none; }
        .link-login:hover { text-decoration: underline; }
        .alert { padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

<div class="container">
    <!-- Kiri -->
    <div class="left-side">
        <h1>DAURUANG</h1>
        <img src="{{ asset('assets/images/login.png') }}" alt="Ilustrasi Dauruang">
        <p>Gabung sekarang dan mulai menabung<br>dari sampah hari ini.</p>
    </div>

    <!-- Kanan -->
    <div class="right-side">
        <div class="register-box">
            <h2>Register Nasabah</h2>

            {{-- Pesan sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Pesan error --}}
            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('nasabah.register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>
                <button type="submit" class="btn-register">Daftar</button>
            </form>
            <a href="{{ url('/login') }}" class="link-login">Sudah punya akun? Login di sini</a>
        </div>
    </div>
</div>

</body>
</html>
