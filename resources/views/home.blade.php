<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Rengkuhan</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(145deg, #8dc9f5, #b6cafa 55%, #e5c9ef);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            overflow: hidden;
        }

        .cloud {
            position: fixed;
            width: 280px;
            height: 110px;
            border-radius: 100px;
            background: rgba(255,255,255,.48);
            filter: blur(2px);
        }

        .cloud.one { top: 10%; left: -70px; }
        .cloud.two { bottom: 8%; right: -80px; width: 380px; }

        .container {
            width: 100%;
            max-width: 950px;
            min-height: 510px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(255,255,255,.22);
            border: 1px solid rgba(255,255,255,.65);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 25px 65px rgba(75,85,150,.18);
            backdrop-filter: blur(12px);
            position: relative;
            z-index: 1;
        }

        .intro {
            padding: 65px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-logo {
            width: 230px;
            max-width: 85%;
            height: auto;
            object-fit: contain;
            margin-bottom: 25px;
        }

        .intro .tag {
            color: #6755a5;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        h1 {
            font-size: clamp(38px, 5vw, 54px);
            line-height: 1.1;
            color: #7353a7;
            margin: 20px 0;
        }

        .intro p {
            color: #52658e;
            line-height: 1.8;
            max-width: 350px;
        }

        .illustration {
            margin-top: 35px;
            font-size: 48px;
        }

        .panel {
            background: rgba(255,255,255,.78);
            margin: 25px;
            border: 1px solid white;
            border-radius: 22px;
            padding: 40px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .panel h2 {
            color: #5c4a91;
            font-size: 25px;
            margin-bottom: 10px;
        }

        .panel .subtitle {
            color: #8790a9;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            color: #5c5878;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 15px;
            border: 1px solid #d9d4ed;
            border-radius: 10px;
            background: white;
            font-size: 14px;
            color: #514b70;
            outline: none;
        }

        button {
            border: 0;
            border-radius: 10px;
            background: #8b78bd;
            color: white;
            font-weight: bold;
            padding: 15px;
            margin-top: 22px;
            cursor: pointer;
            font-size: 15px;
            transition: .2s;
        }

        button:hover { background: #705ca6; transform: translateY(-2px); }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #9290a9;
            font-size: 11px;
        }

        @media(max-width:700px) {
            body { overflow: auto; }
            .container { grid-template-columns: 1fr; max-width: 440px; }
            .intro { padding: 40px 30px 15px; }
            .illustration { display: none; }
            .panel { margin: 20px; padding: 30px 25px; }
        }
    </style>
</head>
<body>
    <div class="cloud one"></div>
    <div class="cloud two"></div>

    <main class="container">
        <section class="intro">
            <img
                src="{{ asset('images/logo-ranah-rengkuh.png') }}"
                alt="Logo Ranah Rengkuh"
                class="main-logo"
            >
            <span class="tag">VOLUNTEER COMMUNITY</span>
            <h1>Welcome to<br>Rengkuhan</h1>
            <p>
                Bergabunglah bersama komunitas Ranah Rengkuh.
                Mulai perjalananmu untuk berbagi, bergerak,
                dan memberikan dampak positif.
            </p>
            <div class="illustration">☁️ 🛶 ☀️</div>
        </section>

        <section class="panel">
            <h2>Selamat Datang!</h2>
            <p class="subtitle">Silakan pilih akses akun untuk melanjutkan.</p>

            <form action="/pilih-role" method="POST">
                @csrf
                <label for="role">Login sebagai</label>
                <select name="role" id="role" required>
                    <option value="">Pilih role</option>
                    <option value="mandala">Pengurus</option>
                    <option value="volunteer">Volunteer</option>
                </select>

                <button type="submit">Lanjutkan →</button>
            </form>

            <div class="footer">
                © {{ date('Y') }} Ranah Rengkuh Community
            </div>
        </section>
    </main>
</body>
</html>
