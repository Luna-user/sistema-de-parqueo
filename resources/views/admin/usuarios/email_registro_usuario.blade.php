<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Sistema de Parqueo</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #007bff, #0056b3); padding: 30px 20px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 600; }
        .content { padding: 30px; color: #333333; line-height: 1.6; }
        .content h2 { color: #0056b3; margin-top: 0; }
        .credentials-box { background-color: #f8f9fa; border-left: 4px solid #007bff; padding: 20px; margin: 25px 0; border-radius: 4px; }
        .credentials-box p { margin: 5px 0; font-size: 16px; }
        .credentials-box strong { color: #0056b3; }
        .btn { display: inline-block; background-color: #28a745; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; text-align: center; margin-top: 15px; }
        .footer { background-color: #e9ecef; padding: 20px; text-align: center; font-size: 13px; color: #6c757d; border-top: 1px solid #dee2e6; }
        .footer p { margin: 5px 0; }
        .alert-text { color: #dc3545; font-size: 14px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Bienvenido al Sistema de Parqueo</h1>
        </div>
        <div class="content">
            <h2>¡Hola, {{ $usuario->nombres }}!</h2>
            <p>Tu cuenta ha sido creada exitosamente. Ahora tienes acceso al sistema de gestión de parqueo con los roles y permisos asignados a tu perfil.</p>
            
            <div class="credentials-box">
                <p><strong>Tus credenciales de acceso:</strong></p>
                <p>Email: <strong>{{ $usuario->email }}</strong></p>
                <p>Contraseña Temporal: <strong>{{ $passwordTemporal }}</strong></p>
            </div>

            <p class="alert-text">⚠️ Importante: Te recomendamos cambiar esta contraseña temporal inmediatamente después de iniciar sesión por primera vez.</p>

            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="btn">Ir al Sistema</a>
            </div>
        </div>
        <div class="footer">
            <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
            <p>&copy; {{ date('Y') }} Sistema de Parqueo. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>