<?php
session_start();
require_once 'dados.php';
require_once 'funcoes.php';
require_once 'cabecalho.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$item = buscarItemPorId($id);

if (!$item) {
    echo '<div class="erro glass">Item não encontrado.</div>';
    require_once 'rodape.php';
    exit;
}
?>

<h1 style="margin-bottom: 24px;">📖 Detalhes do Item</h1>

<div class="glass card" style="max-width: 600px; margin: 0 auto;">
    <img src="<?php echo sanitizar($item['imagem']); ?>" alt="<?php echo sanitizar($item['titulo']); ?>" class="card-img" style="height: 250px;">
    
    <h2 class="card-title" style="font-size: 24px; margin-bottom: 12px;"><?php echo sanitizar($item['titulo']); ?></h2>
    
    <p class="card-category" style="font-size: 14px; margin-bottom: 16px;">
        📂 Categoria: <?php echo sanitizar($item['categoria']); ?>
    </p>
    
    <div style="padding: 16px; background: rgba(255,255,255,0.03); border-radius: 12px; margin-bottom: 16px;">
        <p class="card-desc" style="color: #e6e6e6; margin: 0;">
            <?php echo sanitizar($item['descricao']); ?>
        </p>
    </div>
    
    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="index.php" class="btn">← Voltar</a>
        <a href="filtrar.php?categoria=<?php echo urlencode($item['categoria']); ?>" class="btn">
            Ver mais <?php echo sanitizar($item['categoria']); ?>s
        </a>
    </div>
</div>

<?php require_once 'rodape.php'; ?>
