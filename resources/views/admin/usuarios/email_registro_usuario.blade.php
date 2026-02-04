<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Estilos de respaldo para clientes que aceptan etiquetas style */
        .button:hover {
            background-color: #204d74 !important;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc; background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                    <tr>
                        <td align="center" bgcolor="#007bff" style="padding: 40px 0 30px 0; color: #ffffff; font-size: 28px; font-weight: bold;">
                            <img src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" alt="Logo" width="80" style="display: block; margin-bottom: 10px;" />
                            ¡Bienvenido al Sistema!
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="color: #333333; font-size: 20px; font-weight: bold;">
                                        Hola, {{ $usuario->nombres }} {{ $usuario->apellidos }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 0 30px 0; color: #555555; font-size: 16px; line-height: 24px;">
                                        Nos complace informarte que tu cuenta ha sido creada exitosamente en nuestra plataforma de parqueo. A continuación, encontrarás tus credenciales de acceso temporal.
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#f9f9f9" style="padding: 20px; border: 1px dashed #cccccc; border-radius: 5px;">
                                        <p style="margin: 0; color: #777777; font-size: 14px;">Contraseña Temporal:</p>
                                        <h2 style="margin: 10px 0; color: #007bff; letter-spacing: 2px;">{{ $passwordTemporal }}</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 30px 0 10px 0; color: #555555; font-size: 15px; text-align: center;">
                                        Por motivos de seguridad, te recomendamos cambiar esta contraseña inmediatamente después de ingresar.
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 30px 0 0 0;">
                                        <a href="{{ url('/login') }}" style="background-color: #007bff; color: #ffffff; padding: 15px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">
                                            Acceder a mi cuenta
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#f4f7f6" style="padding: 30px 30px 30px 30px; color: #999999; font-size: 12px; text-align: center;">
                            <p style="margin: 0;">Este es un correo automático, por favor no respondas a este mensaje.</p>
                            <p style="margin: 5px 0 0 0;">&copy; {{ date('Y') }} Sistema de Parqueo - Soporte Técnico</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>