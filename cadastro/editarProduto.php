







<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        include_once '../Dao/ProdutoDAO.php';
          $produtoDao = new ProdutoDao(); 

          $result = $produtoDao->executarQuery("SELECT * FROM produto tp;");


      echo "<select name='Lista_De_Produtos'>";

      while ($row = $result->fetch_assoc()) {

         $tipo = $row["descricao"];

      echo '<option value='.$row["id_tipo"].'>'.$tipo.'</option>';

      }

      echo "</select>";

                      ?>

<html>
        
     <head>
         <meta charset="ISO-8859-1">
         <title>CriaNovoProduto</title>
     </head>
     <body>
            <form method="post">
                <fieldset>
                    <legend>Editar Produto</legend>
                    <div>
                        <label> Nome Produto </label><br/>
                        <input type="text" name = "nome_Produto" value= "asdasd" />
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
                    <br/>
                    <div>
                        <input type="submit" value="Enviar"/>
                    </div>
                </fieldset>

            </form>
  

    </body>
    
    
</html>