<!DOCTYPE html>
<html>
<head>
    <title>Código de Autenticação</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #333333; text-align: center;">VicenteDev Admin</h2>
        <p style="color: #555555; font-size: 16px;">Olá,</p>
        <p style="color: #555555; font-size: 16px;">Você solicitou acesso ao painel administrativo. Use o código de 6 dígitos abaixo para concluir o seu login. Este código é válido por 10 minutos.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #2563eb; background-color: #f3f4f6; padding: 15px 25px; border-radius: 8px;">
                {{ $code }}
            </span>
        </div>
        
        <p style="color: #777777; font-size: 12px; text-align: center;">Se você não tentou acessar o sistema, por favor, ignore este e-mail.</p>
    </div>
</body>
</html>