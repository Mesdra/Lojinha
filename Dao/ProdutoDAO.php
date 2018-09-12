<?php 


include_once ('../Models/Produto.php');
include_once ('../conecBanco/ConnectionPool.php');

class ProdutoDAO {

    public function cadastrar($produto) {
        if (get_class($produto) != 'Produto') {
            return null;
        }
        
   
        $conn = ConnectionPool::getConnection();
       
        $nome_produto = $produto->getNome();
        $descricao = $produto->getDescricao();
        $tipo = $produto->getTipoProduto();
        $valor = $produto->getValor();
        $qt_estoque = $produto->getQtdEstoque();
        $path_imagem = $produto->getPathImagem();
     
         
        $sql = "INSERT INTO produto "
                . "( `nome`, `descricao`,`tipo_produto`, `valor`, `qtd_estoque`, `caminho_img`) "
                . "VALUES "
                . "('".$nome_produto."','".$descricao."',".$tipo.",".$valor.",".$qt_estoque.",'".$path_imagem."');";

        if ($conn->query($sql) === TRUE) {
           echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }  
          }

         public function executarQuery($sql){
         $conn = ConnectionPool::getConnection();
     
       $resp = $conn->query($sql);
     

        return $resp;
        
        }
        }
     