<?php

function novaConexao()
{
  $servidor = 'localhost';
  $usuario = 'ci';
  $senha = '4l15s0n3aQ!';
  $banco = 'advDigital';

  try {
    $conexao = new PDO(
      "mysql:host=$servidor;dbname=$banco;charset=utf8;",
      $usuario,
      $senha
    );
    return $conexao;
  } catch (PDOException $e) {
    die('Erro: ' . $e->getMessage());
    exit;
  }
}
