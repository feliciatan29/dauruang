<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('../assets/images/minicon.png')}}" />
    <title>Login | DaurUang</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        /* Bagian kiri */
        .left-side {
            flex: 1;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }
        .left-side h1 {
            color: #115c3b;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .left-side img {
            max-width: 350px;
            height: auto;
            margin-bottom: 20px;
        }
        .left-side p {
            font-size: 18px;
            color: #115c3b;
            font-weight: 600;
        }

        /* Bagian kanan */
        .right-side {
            flex: 1;
            background-color: #0d4028;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            background: transparent;
            color: #fff;
        }
        .login-box h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            margin-top: 5px;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        label {
            font-size: 14px;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #fff;
            color: #115c3b;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Kiri -->
    <div class="left-side">
        <h1>DAURUANG</h1>
        <img src="{{ asset('../assets/images/login.png') }}" alt="Ilustrasi Dauruang">
        <p>Gabung untuk mulai menabung<br>dari sampah hari ini.</p>
    </div>

    <!-- Kanan -->
    <div class="right-side">
        <div class="login-box">
            <h2>Login.</h2>
            <form action="/login-nasabah" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="E-mail" value="intan@gmail.com" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group" style="display: flex; align-items: center;">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingatkan Saya</label>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
