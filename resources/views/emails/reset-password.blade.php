<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td { font-family: Arial, Helvetica, sans-serif !important; }
    </style>
    <![endif]-->
</head>
<body style="margin:0; padding:0; background-color:#f1f5f9; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif; -webkit-font-smoothing:antialiased;">

    {{-- Wrapper --}}
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f1f5f9; padding:40px 16px;">
        <tr>
            <td align="center">

                {{-- Main Card --}}
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:560px; background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(15,23,42,0.08);">

                    {{-- HEADER: logo + brand --}}
                    <tr>
                        <td align="center" style="background-color:#0f172a; padding:32px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-bottom:12px;">
                                        <img src="{{ asset('img/logo.jpg') }}"
                                             alt="HIMAFI UNUD"
                                             width="56" height="56"
                                             style="display:block; border-radius:12px; border:1px solid rgba(255,255,255,0.1);">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="color:#ffffff; font-size:18px; font-weight:700; letter-spacing:-0.3px;">
                                        HIMAFI UNUD
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="color:#94a3b8; font-size:12px; padding-top:4px;">
                                        Kabinet Arunika Swakarsa
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td style="padding:40px 32px 24px 32px;">
                            <h1 style="margin:0 0 8px 0; font-size:22px; font-weight:700; color:#0f172a; line-height:1.3;">
                                Halo, {{ $user->name }}!
                            </h1>
                            <p style="margin:0 0 24px 0; font-size:15px; color:#475569; line-height:1.6;">
                                Kami menerima permintaan untuk mengatur ulang kata sandi akun <strong style="color:#0f172a;">HIMAFI</strong> Anda. Klik tombol di bawah ini untuk membuat kata sandi baru.
                            </p>

                            {{-- CTA Button --}}
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 24px auto;">
                                <tr>
                                    <td align="center" style="border-radius:12px; background-color:#2563eb;">
                                        <a href="{{ $url }}"
                                           target="_blank"
                                           style="display:inline-block; padding:14px 32px; font-size:15px; font-weight:700; color:#ffffff; text-decoration:none; border-radius:12px; letter-spacing:0.2px;">
                                            Reset Kata Sandi
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            {{-- Info box --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#eff6ff; border:1px solid #dbeafe; border-radius:12px; margin-bottom:24px;">
                                <tr>
                                    <td style="padding:16px 20px; font-size:13px; color:#1e40af; line-height:1.6;">
                                        <strong>Tautan berlaku selama {{ $expire }} menit.</strong><br>
                                        Jika Anda tidak meminta reset password, abaikan email ini. Kata sandi Anda tidak akan berubah.
                                    </td>
                                </tr>
                            </table>

                            {{-- Fallback URL --}}
                            <p style="margin:0 0 8px 0; font-size:12px; color:#94a3b8; line-height:1.6;">
                                Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:
                            </p>
                            <p style="margin:0; font-size:12px; color:#2563eb; word-break:break-all; line-height:1.6;">
                                {{ $url }}
                            </p>
                        </td>
                    </tr>

                    {{-- DIVIDER --}}
                    <tr>
                        <td style="padding:0 32px;">
                            <div style="height:1px; background-color:#e2e8f0;"></div>
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="padding:24px 32px 32px 32px;">
                            <p style="margin:0 0 4px 0; font-size:13px; color:#64748b; line-height:1.6;">
                                Salam hangat,
                            </p>
                            <p style="margin:0 0 16px 0; font-size:13px; color:#0f172a; font-weight:600;">
                                Tim HIMAFI UNUD
                            </p>
                            <p style="margin:0; font-size:11px; color:#94a3b8; line-height:1.6;">
                                © {{ date('Y') }} HIMAFI UNUD · Kabinet Arunika Swakarsa<br>
                                Email ini dikirim otomatis, mohon tidak membalas.
                            </p>
                        </td>
                    </tr>

                </table>

                {{-- Sub-footer --}}
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:560px; margin-top:16px;">
                    <tr>
                        <td align="center" style="font-size:11px; color:#94a3b8; padding:8px;">
                            Butuh bantuan? Hubungi pengurus HIMAFI.
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>