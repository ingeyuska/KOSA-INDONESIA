<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Aktivasi Akun Alumni</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f7fa; padding:30px;">

    <div style="
        max-width:600px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:10px;
    ">

        <h2 style="color:#0b2c4d;">
            Aktivasi Akun Alumni
        </h2>

        <p>
            Halo <strong>{{ $invitation->nama_lengkap }}</strong>,
        </p>

        <p>
            Anda tercatat sebagai Alumni Existing
            KOSA Indonesia.
        </p>

        <p>
            Silakan melakukan aktivasi akun Alumni melalui
            tombol berikut:
        </p>

        <div style="text-align:center; margin:30px 0;">

            <a href="{{ route('alumni.activation.show', $invitation->token) }}"
               style="
                    display:inline-block;
                    background:#0b2c4d;
                    color:white;
                    text-decoration:none;
                    padding:14px 25px;
                    border-radius:6px;
               ">
                AKTIVASI AKUN
            </a>

        </div>

        <p>
            Setelah aktivasi, Anda akan diminta membuat password
            dan melengkapi profil Alumni.
        </p>

        <p>
            Jika Anda tidak merasa sebagai penerima email ini,
            silakan abaikan email ini.
        </p>

        <hr>

        <p style="font-size:12px; color:#777;">
            Email ini dikirim secara otomatis oleh sistem
            KOSA Indonesia.
        </p>

    </div>

</body>
</html>