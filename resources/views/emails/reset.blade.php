<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body
    style="background-color: #0f1117; color: #ffffff; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; margin: 0; padding: 40px 20px;">

    <div
        style="max-width: 600px; margin: 0 auto; background-color: #151821; border: 1px solid #1f2937; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);">

        <div style="padding: 40px; text-align: center;">
            <div style="margin-bottom: 24px;">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo Ludexis" style="max-width: 150px; height: auto;" />
            </div>

            <h1
                style="color: #ffffff; font-size: 24px; font-weight: 900; margin-bottom: 16px; letter-spacing: -0.025em;">
                Recuperar Contraseña
            </h1>

            <p style="color: #9ca3af; font-size: 16px; line-height: 1.5; margin-bottom: 32px;">
                Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Haz clic en el botón inferior
                para establecer una nueva.
            </p>

            <a href="{{ $url }}"
                style="display: inline-block; background-color: #0891b2; color: #ffffff; text-decoration: none; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; padding: 16px 32px; border-radius: 12px;">
                Restablecer Contraseña
            </a>

            <p style="color: #4b5563; font-size: 13px; margin-top: 32px; margin-bottom: 0;">
                Este enlace caducará en 60 minutos. Si no has solicitado este cambio, puedes ignorar este correo de
                forma segura.
            </p>
        </div>

        <div style="background-color: #0f1117; padding: 20px; text-align: center; border-top: 1px solid #1f2937;">
            <p style="color: #4b5563; font-size: 12px; margin: 0;">
                &copy; {{ date('Y') }} Ludexis. Todos los derechos reservados.
            </p>
        </div>

    </div>
</body>

</html>
