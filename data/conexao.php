<?php

function novaConexao($banco = 'meb')
{
  $servidor = 'localhost';
  $usuario = 'root';
  $senha = '';

  try {
    $conexao = new PDO(
      "mysql:host=$servidor;dbname=$banco",
      $usuario,
      $senha
    );
    return $conexao;
  } catch (PDOException $e) {
    die('Erro: ' . $e->getMessage());
    exit;
  }
}
