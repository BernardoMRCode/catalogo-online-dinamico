<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Online</title>
    <style>
        body {
            margin: 0;
            font-family: system-ui, Inter, sans-serif;
            background: #0b0f17;
            color: #e6e6e6;
            min-height: 100vh;
        }

        .glass {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(14px);
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.35);
        }

        .card {
            padding: 16px;
            transition: 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(255,255,255,0.25);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        button, .btn {
            background: rgba(79,124,255,0.15);
            border: 1px solid rgba(79,124,255,0.35);
            color: #e6e6e6;
            padding: 10px 14px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        button:hover, .btn:hover {
            background: rgba(79,124,255,0.25);
            transform: scale(1.02);
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.04);
            color: white;
            box-sizing: border-box;
            font-size: 14px;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: rgba(79,124,255,0.5);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            margin: 16px;
            position: sticky;
            top: 16px;
            z-index: 100;
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: 600;
            color: #4f7cff;
        }

        .navbar-links {
            display: flex;
            gap: 12px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px;
        }

        .sucesso {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.35);
            color: #4ade80;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .erro {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #f87171;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .card-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #e6e6e6;
        }

        .card-category {
            font-size: 12px;
            color: #a1a1aa;
            margin-bottom: 8px;
        }

        .card-desc {
            font-size: 13px;
            color: #a1a1aa;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #a1a1aa;
        }

        footer {
            text-align: center;
            padding: 24px;
            color: #a1a1aa;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 12px;
            }
            
            .navbar-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar glass">
        <div class="navbar-brand">📚 Catálogo</div>
        <div class="navbar-links">
            <a href="index.php" class="btn">Home</a>
            <a href="filtrar.php" class="btn">Filtrar</a>
            <?php if (estaLogado()): ?>
                <a href="protegido.php" class="btn">Área Protegida</a>
                <a href="logout.php" class="btn">Sair</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
