<?php
function buscarItemPorId($id) {
    global $itens;
    
    foreach ($itens as $item) {
        if ($item['id'] === $id) {
            return $item;
        }
    }
    
    return null;
}

function filtrarItens($categoria) {
    global $itens;
    
    if (empty($categoria) || $categoria === 'todas') {
        return $itens;
    }
    
    $filtrados = [];
    foreach ($itens as $item) {
        if (strtolower($item['categoria']) === strtolower($categoria)) {
            $filtrados[] = $item;
        }
    }
    
    return $filtrados;
}

function sanitizar($texto) {
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

function adicionarItemSessao($item) {
    if (!isset($_SESSION['itens_usuario'])) {
        $_SESSION['itens_usuario'] = [];
    }
    
    $novo_id = count($_SESSION['itens_usuario']) + 100; // IDs a partir de 100
    $item['id'] = $novo_id;
    
    $_SESSION['itens_usuario'][] = $item;
    
    return $novo_id;
}

function todosItens() {
    global $itens;
    
    $todos = $itens;
    
    if (isset($_SESSION['itens_usuario']) && is_array($_SESSION['itens_usuario'])) {
        $todos = array_merge($todos, $_SESSION['itens_usuario']);
    }
    
    return $todos;
}

function estaLogado() {
    return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
}

function requerLogin() {
    if (!estaLogado()) {
        header('Location: login.php');
        exit;
    }
}
