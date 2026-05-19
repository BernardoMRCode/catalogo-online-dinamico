<?php
session_start();
require_once 'dados.php';
require_once 'funcoes.php';
require_once 'cabecalho.php';

$itens = todosItens();
?>

<h1 style="margin-bottom: 24px;">📚 Catálogo Online</h1>

<?php if (isset($_SESSION['mensagem_sucesso'])): ?>
    <div class="sucesso glass">
        <?php echo sanitizar($_SESSION['mensagem_sucesso']); ?>
    </div>
    <?php unset($_SESSION['mensagem_sucesso']); ?>
<?php endif; ?>

<div class="grid">
    <?php foreach ($itens as $item): ?>
        <div class="glass card">
            <img src="<?php echo sanitizar($item['imagem']); ?>" alt="<?php echo sanitizar($item['titulo']); ?>" class="card-img">
            <h3 class="card-title"><?php echo sanitizar($item['titulo']); ?></h3>
            <p class="card-category">📂 <?php echo sanitizar($item['categoria']); ?></p>
            <p class="card-desc"><?php echo substr(sanitizar($item['descricao']), 0, 80) . '...'; ?></p>
            <a href="detalhes.php?id=<?php echo sanitizar($item['id']); ?>" class="btn">Ver mais</a>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'rodape.php'; ?>
