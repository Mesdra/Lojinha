




<?php
 session_start();
include_once './Dao/ProdutoDAO.php';
include_once './Models/Usuario.php';
include_once './conecBanco/ConnectionPool.php';
include_once '/opt/lampp/htdocs/Lojinha/Models/Carrinho.php';

$produtoDao = new ProdutoDAO();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            if(isset($_SESSION['usuarioLogado']) && !empty($_SESSION['usuarioLogado'])){
                 $sObj = $_SESSION['usuarioLogado'];
                 $usuario = unserialize($sObj);
                 $s_Car = $_SESSION['carrinhoUsuario'];
                 $carrinho = unserialize($s_Car);
                $carrinho->addAoCarrinho($_GET['id'],$_POST['quantidade']);
            }else{
                echo 'voce deve logar ou criar uma conta para realizar uma compra.';
                echo '<br>';
                echo '<ul>
			<li><a href="./cadastro/indexLogin.php">Login</a></li>
			<li><a href="/Lojinha/cadastro/indexCadastro.php">Criar Conta</a></li>
		</ul>';
                
            }
            
            header('Location: ./index.php');
            
            
    
    
    
}

if (isset($_GET['id'])) {

    
    $resultadoPesquisa = $produtoDao->executarQuery("SELECT * FROM produto WHERE id_produtos = ".$_GET['id'].";");
    $row = $resultadoPesquisa->fetch_assoc();
    echo $row['nome']; 
}
?>

<form>
  <?php echo '<td align="center" valing="top" bgcolor="#FFFFFF">'
                                .'<img src= "'.$row['caminho_img'].'" width ="200" height="150" alt=""/><br/>'
                                .'Nome: <strong>'.$row['nome'].'</strong> </a> <br/> '
                                .'Valor: <strong> R$ '. number_format($row['valor'],2,",",".").'</strong> </td>';
  ?><br>
  <br>
  <?php echo $row['descricao']
 ?><br>
 
  
</form>    
 <form method="post">
     <fieldset>
             <div>
                  <label> Quantidade Produtos </label><br/>
                 <input type="int" name = "quantidade" value="1">
                 <input type="submit" name="compra" value="Adicionar ao Carrinho"/>
             </div>
         </fieldset>
         
     </form>