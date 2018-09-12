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