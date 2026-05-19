<?php
session_start();
require_once 'dados.php';
require_once 'funcoes.php';
require_once 'cabecalho.php';

requerLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
    $categoria = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $imagem = isset($_POST['imagem']) ? trim($_POST['imagem']) : '';
    
    if (empty($titulo) || empty($categoria) || empty($descricao)) {
        $erro = 'Por favor, preencha todos os campos obrigatórios.';
    } else {
        if (empty($imagem)) {
            $imagem = 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=400&h=300&fit=crop';
        }
        
        $novo_item = [
            'titulo' => $titulo,
            'categoria' => $categoria,
            'descricao' => $descricao,
            'imagem' => $imagem
        ];
        
        $id = adicionarItemSessao($novo_item);
        $_SESSION['mensagem_sucesso'] = 'Item "' . $titulo . '" cadastrado com sucesso! (ID: ' . $id . ')';
        header('Location: index.php');
        exit;
    }
}
?>

<h1 style="margin-bottom: 24px;">🛡️ Área Protegida</h1>

<div style="margin-bottom: 24px;">
    <p style="color: #a1a1aa;">Bem-vindo, <strong><?php echo sanitizar($_SESSION['usuario']); ?></strong>!</p>
</div>

<div class="glass card" style="max-width: 500px; margin-bottom: 24px;">
    <h2 style="margin-bottom: 16px;">➕ Cadastrar Novo Item</h2>
    
    <?php if (isset($erro)): ?>
        <div class="erro" style="margin-bottom: 16px;"><?php echo sanitizar($erro); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label class="form-label">Título: *</label>
            <input type="text" name="titulo" required placeholder="Ex: O Hobbit">
        </div>
        
        <div class="form-group">
            <label class="form-label">Categoria: *</label>
            <select name="categoria" required>
                <option value="">Selecione...</option>
                <option value="Filme">Filme</option>
                <option value="Livro">Livro</option>
                <option value="Série">Série</option>
                <option value="Jogo">Jogo</option>
            </select>
        </div>
        
        <div class="form-group">
            <label class="form-label">Descrição: *</label>
            <textarea name="descricao" rows="4" required placeholder="Descreva o item..."></textarea>
        </div>
        
        <div class="form-group">
            <label class="form-label">URL da Imagem:</label>
            <input type="url" name="imagem" placeholder="https://...">
        </div>
        
        <button type="submit" style="width: 100%;">Cadastrar Item</button>
    </form>
</div>

<?php if (isset($_SESSION['itens_usuario']) && !empty($_SESSION['itens_usuario'])): ?>
    <div class="glass card">
        <h2 style="margin-bottom: 16px;">📝 Seus Itens Cadastrados</h2>
        <div class="grid">
            <?php foreach ($_SESSION['itens_usuario'] as $item): ?>
                <div class="card" style="background: rgba(79,124,255,0.08); border-color: rgba(79,124,255,0.2);">
                    <h3 class="card-title"><?php echo sanitizar($item['titulo']); ?></h3>
                    <p class="card-category">📂 <?php echo sanitizar($item['categoria']); ?></p>
                    <p class="card-desc"><?php echo substr(sanitizar($item['descricao']), 0, 60) . '...'; ?></p>
                    <span style="font-size: 12px; color: #4f7cff;">ID: <?php echo $item['id']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php require_once 'rodape.php'; ?>
