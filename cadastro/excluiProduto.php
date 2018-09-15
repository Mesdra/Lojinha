<?php
    include_once '../Dao/TipoContaDAO.php';
    include_once '../Models/Produto.php';
    include_once '../Dao/ProdutoDAO.php';
    
      if(isset($_POST['submitTwo'])) {
        
    
        $produtoDAO = new ProdutoDAO();
      
            $produto= $_POST['id_produto'];
            
            $produtoDAO->deletaProduto($produto);
            
            header('Location: ../cadastro/indexGerenciamentoProdutos.php');
            
    }   
        
?>



<html>
        
     <head>
         <meta charset="ISO-8859-1">
         <title>ExcluirProduto</title>
     </head>
     <body>
         
         <?php
         
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        
          $produtoDao = new ProdutoDao(); 

          $result = $produtoDao->executarQuery("SELECT * FROM produto tp;");

      echo '<form method="post">';      
      echo "<select name='lista_De_Produtos'>";

      while ($row = $result->fetch_assoc()) {

         $tipo = $row["nome"];

      echo '<option value='.$row["id_produtos"].'>'.$tipo.'</option>';

      }

      echo "</select>";
      echo '<input type="submit" name="submit" value="Busca Produto" />';
      echo '</form>';

                      ?>
         
            <form method="post">
                <fieldset>
                    <legend>Editar Produto</legend>
                    
                    <div>
                        <label> Nome Produto </label><br/>
                        <input type="text" name = "nome_Produto" value= "<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["nome"];
                             
                        }
                    ?>
                         "/>
                    </div>
                    <div>
                        <label> Descrição </label><br/>
                        <input type="text" name = "descricao" value="<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["descricao"];
                             
                        }
                    ?>"/>
                    </div>
                    <div>
                        <label> Preco </label><br/>
                        <input type="float" name = "preco" value="<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["valor"];
                             
                        }
                    ?>"/>
                    </div>
                    <div>
                        <label> caminho Imagem </label><br/>
                        <input type="text" name = "caminho_Imagem" value="<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["caminho_img"];
                             
                        }
                    ?>"/>
                    </div>
                    <div>
                        <label> Tipo Produto </label><br/>
                        <input type="text" name = "tipo_Produto" value="<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["tipo_produto"];
                             
                        }
                    ?>"/>
                    </div>
                    <div>
                        <label> ID </label><br/>
                        <input type="text" name = "id_produto" value="<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["id_produtos"];
                             
                        }
                    ?>"/>
                    </div>
                    <div>
                        <label> Quantidade em Estoque </label><br/>
                        <input type="text" name = "quant_Estoque" value="<?php
                
                        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                            $selected_val = $_POST['lista_De_Produtos'];  // Storing Selected Value In Variable
                            $result = $produtoDao->executarQuery("SELECT * FROM produto tp WHERE tp.id_produtos= ".$selected_val.";");
                            $row = $result->fetch_assoc();

                            echo $row["qtd_estoque"];
                             
                        }
                    ?>"/>
                    </div>
                    <br/>
                     
                    <div>
                        <input type="submit" name="submitTwo" value="Excluir Produto"/>
                    </div>
                </fieldset>

            </form>
  

    </body>
    
    
</html>



