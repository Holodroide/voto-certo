<?php
session_start();
 
require_once 'init.php';
 
require 'check.php'; 
 
// pega o ID da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
 
// valida o ID
if (empty($id))
{
    echo "ID não informado";
    exit;
}

$PDO = db_connect();

// SQL para selecionar os registros
$sql = "SELECT * FROM tbl_usuario WHERE id_usr = :id";
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (count($user) <= 0)
{
    echo "<script>
          alert('Erro: Nenhum cliente encontrado para esse id.');
          window.history.back()
		  </script>";
    exit;
}


//deleta o registro
$sql = "DELETE FROM tbl_usuario WHERE id_usr = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
if ($stmt->execute())
{
    echo "<script>
          alert('Registro apagado.');
          window.history.back()
      </script>";
}
else
{
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}