<?php
session_start();
require_once 'dados.php';
require_once 'funcoes.php';
require_once 'cabecalho.php';

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
$itens_filtrados = filtrarItens($categoria);
?>

<h1 style="margin-bottom: 24px;">🔍 Filtrar por Categoria</h1>

<div class="glass card" style="max-width: 500px; margin-bottom: 24px;">
    <form method="GET" action="filtrar.php">
        <div class="form-group">
            <label class="form-label">Selecione a Categoria:</label>
            <select name="categoria">
                <option value="todas" <?php echo $categoria === 'todas' ? 'selected' : ''; ?>>Todas</option>
                <option value="Filme" <?php echo $categoria === 'Filme' ? 'selected' : ''; ?>>Filme</option>
                <option value="Livro" <?php echo $categoria === 'Livro' ? 'selected' : ''; ?>>Livro</option>
            </select>
        </div>
        <button type="submit">Filtrar</button>
    </form>
</div>

<?php if ($categoria !== 'todas'): ?>
    <p style="margin-bottom: 16px; color: #a1a1aa;">
        Mostrando <strong><?php echo sanitizar($categoria); ?>s</strong> (<?php echo count($itens_filtrados); ?> itens)
    </p>
<?php else: ?>
    <p style="margin-bottom: 16px; color: #a1a1aa;">
        Mostrando <strong>todos os itens</strong> (<?php echo count($itens_filtrados); ?> itens)
    </p>
<?php endif; ?>

<?php if (empty($itens_filtrados)): ?>
    <div class="erro glass">Nenhum item encontrado para esta categoria.</div>
<?php else: ?>
    <div class="grid">
        <?php foreach ($itens_filtrados as $item): ?>
            <div class="glass card">
                <img src="<?php echo sanitizar($item['imagem']); ?>" alt="<?php echo sanitizar($item['titulo']); ?>" class="card-img">
                <h3 class="card-title"><?php echo sanitizar($item['titulo']); ?></h3>
                <p class="card-category">📂 <?php echo sanitizar($item['categoria']); ?></p>
                <p class="card-desc"><?php echo substr(sanitizar($item['descricao']), 0, 80) . '...'; ?></p>
                <a href="detalhes.php?id=<?php echo sanitizar($item['id']); ?>">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once 'rodape.php'; ?>
