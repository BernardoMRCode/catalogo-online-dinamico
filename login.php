<?php
session_start();
require_once 'dados.php';
require_once 'funcoes.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    
    if (empty($usuario) || empty($senha)) {
        $erro = 'Por favor, preencha todos os campos.';
    } else {
        if ($usuario === $usuario_sistema['usuario'] && password_verify($senha, $usuario_sistema['senha'])) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario;
            header('Location: protegido.php');
            exit;
        } else {
            $erro = 'Usuário ou senha incorretos.';
        }
    }
}

require_once 'cabecalho.php';
?>

<h1 style="margin-bottom: 24px;">🔐 Login</h1>

<div class="glass card" style="max-width: 400px; margin: 0 auto;">
    <?php if ($erro): ?>
        <div class="erro" style="margin-bottom: 16px;"><?php echo sanitizar($erro); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label class="form-label">Usuário:</label>
            <input type="text" name="usuario" required placeholder="admin">
        </div>
        
        <div class="form-group">
            <label class="form-label">Senha:</label>
            <input type="password" name="senha" required placeholder="admin123">
        </div>
        
        <button type="submit" style="width: 100%;">Entrar</button>
    </form>
    
    <p style="margin-top: 16px; font-size: 13px; color: #a1a1aa; text-align: center;">
        <strong>Credenciais:</strong><br>
        Usuário: admin<br>
        Senha: admin123
    </p>
</div>

<?php require_once 'rodape.php'; ?>
