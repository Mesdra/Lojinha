<?php 


include_once ('./Models/Produto.php');
include_once ('./conecBanco/ConnectionPool.php');

class ProdutoDAO {
    
    public function atualizarProduto($produto){
        
        $conn = ConnectionPool::getConnection();
        
        $id = $produto->getId();
        $nome_produto = $produto->getNome();
        $descricao = $produto->getDescricao();
        $tipo = $produto->getTipoProduto();
        $valor = $produto->getValor();
        $qt_estoque = $produto->getQtdEstoque();
        $path_imagem = $produto->getPathImagem();
        
        $sql = "UPDATE produto SET nome='".$nome_produto."',descricao='".$descricao."',tipo_produto=".$tipo.",valor=".$valor.",qtd_estoque=".$qt_estoque.",caminho_img='".$path_imagem."'WHERE id_produtos=".$id.";";
        
         if ($conn->query($sql) === TRUE) {
           return "New record created successfully";
        } else {
           return "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
    
    public function deletaProduto($produtoID){
        
         $conn = ConnectionPool::getConnection();
        
         $sql = "DELETE FROM produto
WHERE id_produtos=".$produtoID.";";
         
            if ($conn->query($sql) === TRUE) {
           return "New record created successfully";
        } else {
           return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

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
           return "New record created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }  
          }

         public function executarQuery($sql){
             
         $conn = ConnectionPool::getConnection();
     
       $resp = $conn->query($sql);
     

        return $resp;
        
        }
        }
     