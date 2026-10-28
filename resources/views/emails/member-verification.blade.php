<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Akun Member</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f8fc; padding:30px;">

<div style="
    max-width:600px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:12px;
">

    <h2 style="color:#0b2c5f;">
        KOSA Indonesia
    </h2>

    <p>
        Yth. Bapak/Ibu <strong>{{ $verification->user->nama }}</strong>,
    </p>

    <p>
        Terima kasih telah melakukan registrasi pada
        Portal KOSA Indonesia.
    </p>

    <p>
        Untuk menyelesaikan proses pendaftaran dan
        mengaktifkan akun Anda, silakan melakukan
        konfirmasi alamat email dengan mengklik tombol
        berikut:
    </p>

    <div style="text-align:center; margin:30px 0;">

        <a
            href="{{ route('member.verification', $verification->token) }}"
            style="
                display:inline-block;
                background:#0b2c5f;
                color:white;
                padding:13px 25px;
                border-radius:7px;
                text-decoration:none;
                font-weight:bold;
            "
        >
            KONFIRMASI AKUN
        </a>

    </div>

    <p>
        atau melalui tautan berikut:
    </p>

    <p>
        <a href="{{ route('member.verification', $verification->token) }}">
            {{ route('member.verification', $verification->token) }}
        </a>
    </p>

    <hr>

    <h4>Informasi Akun</h4>

    <p>
        <strong>Nama:</strong>
        {{ $verification->user->nama }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $verification->user->email }}
    </p>

    <p>
        <strong>Member ID:</strong>
        {{ $verification->user->memberProfile->member_id }}
    </p>

    <p>
        Apabila Anda tidak pernah melakukan registrasi
        pada Portal KOSA Indonesia, abaikan email ini.
    </p>

    <p>
        Untuk keamanan, tautan verifikasi hanya berlaku
        selama <strong>24 jam</strong> sejak email ini dikirimkan.
    </p>

    <p>
        Terima kasih telah bergabung dengan jejaring
        KOSA Indonesia.
    </p>

    <p>
        Salam,<br>
        <strong>KOSA Indonesia</strong><br>
        KOICA Scholarship Alumni Indonesia
    </p>

</div>

</body>
</html>