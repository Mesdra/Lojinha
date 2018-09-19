<?php

include_once './Dao/ProdutoDAO.php';
$produtoDao = new ProdutoDAO();

echo 'chegou no bloco';
if (isset($_GET['id'])) {
    echo $_GET['id'];
    
    $resultadoPesquisa = $produtoDao->executarQuery("SELECT * FROM produto WHERE id_produtos = ".$_GET['id'].";");
    $row = $resultadoPesquisa->fetch_assoc();
    echo $row['nome']; 
}
?>

<form>
  <?php echo $row['nome']?><br>
  <br>
  <?php echo $row['descricao']?><br>
  
</form>