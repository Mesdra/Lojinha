<?php
    include_once '../Dao/TipoContaDAO.php';
    include_once '../Models/Produto.php';
    include_once '../Dao/ProdutoDAO.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $produto = new Produto();
        $produtoDAO = new ProdutoDAO();
      

            $produto->setDescricao($_POST['descricao']);
            $produto->setNome($_POST['nome_Produto']);
            $produto->setPathImagem($_POST['caminho_Imagem']);
            $produto->setQtdEstoque($_POST['quant_Estoque']);
            $produto->setTipoProduto($_POST['tipo_Produto']);
            $produto->setValor($_POST['preco']);
            
            echo $produtoDAO->cadastrar($produto);
            
            
            header('Location: ../cadastro/indexGerenciamentoProdutos.php');
            
    }   
        
?>
<html>
        
     <head>
         <meta charset="ISO-8859-1">
         <title>CriaNovoProduto</title>
     </head>
     <body>
            <form method="post">
                <fieldset>
                    <legend>Novo Produto</legend>
                    <div>
                        <label> Nome Produto </label><br/>
                        <input type="text" name = "nome_Produto"/>
                    </div>
                    <div>
                        <label> Descrição </label><br/>
                        <input type="text" name = "descricao"/>
                    </div>
                    <div>
                        <label> Preco </label><br/>
                        <input type="float" name = "preco"/>
                    </div>
                    <div>
                        <label> caminho Imagem </label><br/>
                        <input type="text" name = "caminho_Imagem"/>
                    </div>
                    <div>
                        <label> Quant estoque </label><br/>
                        <input type="text" name = "quant_Estoque"/>
                    </div>
                    <div>
                        <label> Tipo Produto </label><br/>
                        <?php
                            include_once '../Dao/TipoContaDAO.php';
                            $tipocontaDao = new TipoContaDao(); 

                          $result = $tipocontaDao->executarQuery("SELECT * FROM tipo_produto tp;");


                          echo "<select name='tipo_Produto'>";

                          while ($row = $result->fetch_assoc()) {

                                        $tipo = $row["descricao"];

                                        echo '<option value='.$row["id_tipo"].'>'.$row["descricao"].'</option>';

                          }

                          echo "</select>";

                      ?>
                        
                    </div>
                    <br/>
                    <div>
                        <input type="submit" value="Enviar"/>
                    </div>
                </fieldset>

            </form>
  

    </body>
    
    
</html>