<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi {{ $roleLabel }} - Ranah Rengkuh</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #f4f3ff;
        }

        .container {
            width: 100%;
            max-width: 460px;
            padding: 36px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(50, 40, 100, 0.08);
        }

        .logo {
            text-align: center;
            color: #6254c7;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 24px;
        }

        h1 {
            color: #25213f;
            font-size: 26px;
            text-align: center;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #77758b;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            color: #38354e;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dedce9;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #7567d8;
            box-shadow: 0 0 0 3px rgba(117, 103, 216, 0.1);
        }

        .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            background: #fff0f0;
            color: #bd3333;
            font-size: 13px;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #6c5dd3;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        button:hover {
            background: #5849bd;
        }

        .footer {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: #77758b;
        }

        a {
            color: #6555c9;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">RANAH RENGKUH</div>

        <h1>Buat Akun {{ $roleLabel }}</h1>
        <p class="subtitle">Daftarkan dirimu dan mulai bergabung bersama kami.</p>

        @if ($errors->any())
            <div class="alert">
                Terdapat kesalahan pada formulir. Silakan periksa kembali.
            </div>
        @endif

        <form method="POST" action="{{ url('/register/volunteer') }}">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama"
                    value="{{ old('nama') }}" placeholder="Masukkan nama lengkap"
                    required>
                @error('nama') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}" placeholder="nama@email.com"
                    required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="no_telpon">Nomor Telepon</label>
                <input type="tel" id="no_telpon" name="no_telpon"
                    value="{{ old('no_telpon') }}" placeholder="08xxxxxxxxxx"
                    required>
                @error('no_telpon') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    placeholder="Minimal 8 karakter" required>
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password" required>
            </div>

            <button type="submit">Daftar Sekarang</button>
        </form>

        <div class="footer">
            Sudah punya akun?
            <a href="{{ url('/login/volunteer') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>
