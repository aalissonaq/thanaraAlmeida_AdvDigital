<?php

function connect()
{
  static $con = null;
  try {
    if ($con == null) {
      $con = new PDO('mysql:host=localhost;dbname=lc', 'root', 't5r4e3w2q1');
    }
  } catch (PDOException $e) {
    echo "Erro encontrado" . $e->getMessage() . "com codigo" . $e->getCode();
    die;
  }
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $con;
}

/*****************************
/*         LER DADOS         *
/*****************************/

function ler($tabela, $cond1 = null, $where = null)
{
  $cond1 = ($cond1 != null ? $cond1 : '*');
  $where = ($where != null ? $where : '');
  $pdo = connect();
  $lendo = connect()->prepare("SELECT {$cond1} FROM {$tabela} {$where}");
  $lendo->execute();
  return $lendo;
}
/*****************************
/*         LER DADOS COM JOIN         *
/*****************************/

function lerJoin($tabela1, $tabela2, $refColun, $join = null, $cond1 = null, $where = null)
{
  $cond1 = ($cond1 != null ? $cond1 : '*');
  $join = ($join != null ? $join : 'INNER');
  $where = ($where != null ? $where : '');
  $pdo = connect();
  $lendo = connect()->prepare("SELECT {$cond1} FROM {$tabela1} {$join} JOIN {$tabela2} ON {$tabela1}.{$refColun}={$tabela2}.{$refColun} {$where}");
  $lendo->execute();
  return $lendo;
}

/*****************************
 *       INSERIR DADOS        *
 ******************************/

function inseir($tabela, array $dados)
{
  $campos = implode(', ', array_keys($dados));
  $valores = "'" . implode("', '", array_values($dados)) . "'";
  $insert = connect()->prepare("INSERT INTO {$tabela}($campos) VALUES ($valores)");
  $insert->execute();
  if ($insert->rowCount()) {
    return true;
  }
}

function inseirPadrao($tabela, $campos, $valores)
{
  $qrInserir = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})";
  $exInserir = mysql_query($qrInserir) or die('Erro ao Cadastrar em ' . $tabela . ' ' . mysql_error());
  if ($exInserir) {
    return true;
  }
}

/*****************************
 *      ATUALIZAR DADOS       *
 ******************************/

function atualizar($tabela, array $dados, $cond)
{
  foreach ($dados as $filds => $values) {
    $campos[] = $filds . "= '" . $values . "'";
  }
  $campos = implode(", ", $campos);
  $update = connect()->prepare("UPDATE {$tabela} SET {$campos} WHERE {$cond}");
  $update->execute();
  if ($update->rowCount()) {
    return true;
  }
}

/*****************************
 *      DELATAR DADOS         *
 ******************************/

function deletar($tabela, $cond)
{
  $Del = connect()->prepare("DELETE FROM {$tabela} WHERE {$cond}");
  $Del->execute();
  if ($Del->rowCount()) {
    return true;
  }
}

function get_enum($table_name, $field_name)
{
  $sql = "desc {$table_name} {$field_name}";
  $st = $this->db->prepare($sql);

  if ($st->execute()) {
    $row = $st->fetch();
    if ($row === FALSE)
      return FALSE;

    $type_dec = $row->Type;
    if (substr($type_dec, 0, 5) !== 'enum(')
      return FALSE;

    $values = array();
    foreach (explode(',', substr($type_dec, 5, (strlen($type_dec) - 6))) as $v) {
      array_push($values, trim($v, "'"));
    }

    return $values;
  }
  return FALSE;
}


/* * ***************************
  GERA REGISTRO DE LOG
 **************************** */
function LogRegister($acao, $descricao, $usuario)
{
  $tabela = 'logs';
  //$campos = implode(', ', array_keys($dados));
  //$valores = "'" . implode("', '", array_values($dados)) . "'";
  $insert = connect()->prepare("INSERT INTO {$tabela}(`actionLogs`, `descriptionActionLog`, `nameUserActionLogs`) VALUES ('{$acao}','{$descricao}', '{$usuario}')");
  $insert->execute();
  if ($insert->rowCount()) {
    return true;
  }
}
