<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('../assets/images/minicon.png')}}" />
    <title>Login | Trash2Cash</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 20px;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        .form-container {
            margin-top: 10px;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ced4da;
            border-radius: 5px;
            overflow: hidden;
        }

        .input-icon {
            padding: 10px;
            background-color: #f1f1f1;
            border-right: 1px solid #ced4da;
            color: #6c757d;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            outline: none;
            font-size: 14px;
        }



        .btn-login {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .signup-text {
            margin-top: 15px;
            font-size: 14px;
        }

        .signup-text a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('../assets/images/logo1.png') }}" alt="Logo Utama" style="width: 150px; height: auto;" />

                </a>
              </div>

              <div class="form-container">
                <h2 class="login-title">Login To Your Account</h2>
                <p class="login-subtitle">Enter your email & password to login</p>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <span class="input-icon">@</span>
                            <input type="email" id="email" name="email" value="intan@gmail.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>
                <p class="signup-text">
                    Don't have an account? <a href="/register">Create an account</a>
                </p>
            </div>
        </div>
    </body>
    </html>
