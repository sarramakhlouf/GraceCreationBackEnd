<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Merci de nous contacter</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: #333;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            margin: auto;
        }
        .header {
            font-size: 22px;
            font-weight: bold;
            color: #0072ff;
            text-align: center;
            margin-bottom: 15px;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #444;
        }
        .content p {
            margin: 10px 0;
        }
        .highlight {
            font-weight: bold;
            color: #0072ff;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .button {
            display: inline-block;
            background: #0072ff;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="http://127.0.0.1:8000/assets/imgs/auth/logo.png" alt="Logo" class="Logo">
        <div class="header">📩 Nouveau message de contact</div>
        <div class="content">
            <p><strong>Nom :</strong> {{ $data['name'] }}</p>
            <p><strong>Email :</strong> {{ $data['email'] }}</p>
            <p><strong>Téléphone :</strong> {{ $data['phone'] }}</p>
            <p><strong>Message :</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>
        <div class="footer">Grace Creations Support Team</div>
    </div>
</body>
</html>

