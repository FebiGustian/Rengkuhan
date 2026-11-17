<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login {{ $roleLabel }} | Rengkuhan</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: linear-gradient(145deg,#91cdf5,#b9c8f5,#e8c9ed);
        }
        .container {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255,255,255,.3);
            border: 1px solid white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px #6c70a333;
        }
        .intro {
            padding: 65px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .intro h1 { color: #7253a5; font-size: 48px; line-height: 1.15; }
        .intro p { color: #58678f; margin-top: 20px; line-height: 1.8; }
        .art { font-size: 50px; margin-top: 35px; }
        .panel {
            margin: 25px;
            padding: 40px 32px;
            background: rgba(255,255,255,.85);
            border-radius: 20px;
        }
        h2 { color: #65518f; font-size: 27px; }
        .subtitle { color: #9290a9; margin: 10px 0 28px; font-size: 14px; }
        label {
            display: block;
            color: #55516f;
            font-size: 13px;
            font-weight: bold;
            margin: 16px 0 8px;
        }
        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ded9ed;
            border-radius: 9px;
            outline: none;
        }
        input:focus { border-color: #8b78bd; }
        button {
            width: 100%;
            padding: 15px;
            border: 0;
            border-radius: 9px;
            margin-top: 25px;
            background: #8975b9;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #705ca6; }
        .error {
            background: #fff0f0;
            color: #b42318;
            padding: 12px;
            border-radius: 9px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        .links { text-align: center; margin-top: 22px; font-size: 13px; color: #77738f; }
        a { color: #7253a5; font-weight: bold; text-decoration: none; }
        .back { display: inline-block; margin-top: 20px; }
        @media(max-width:650px) {
            .container { grid-template-columns: 1fr; max-width: 430px; }
            .intro { padding: 35px 30px 10px; }
            .intro h1 { font-size: 38px; }
            .art { display: none; }
            .panel { margin: 20px; padding: 30px 25px; }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="intro">
            <h1>Welcome to<br>Rengkuhan</h1>
            <p>Bersama Ranah Rengkuh, mari bergerak dan memberikan dampak positif untuk sesama.</p>
            <div class="art">☁️ 🛶 ☀️</div>
        </section>

        <section class="panel">
            <h2>Login {{ $roleLabel }}</h2>
            <p class="subtitle">Masuk menggunakan akun {{ strtolower($roleLabel) }} kamu.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ url('/login/' . $role) }}">
                @csrf

                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    placeholder="Masukkan password" required>

                <button type="submit">Login</button>

            @if ($role === 'volunteer')
                <div style="text-align:center; margin-top:20px; font-size:14px; color:#77758b;">
                    Belum punya akun?
                    <a href="{{ url('/register/volunteer') }}"
                       style="color:#6555c9; font-weight:bold; text-decoration:none;">
                        Registrasi sekarang
                    </a>
                </div>
            @endif
            </form>

            <div class="links">
                <a class="back" href="/">← Kembali ke halaman awal</a>
            </div>
        </section>
    </main>
</body>
</html>
