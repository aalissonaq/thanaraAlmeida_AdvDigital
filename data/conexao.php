<?php

function novaConexao($banco = 'meb')
{
  $servidor = 'localhost';
  $usuario = 'root';
  $senha = 't5r4e3w2q1';

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
