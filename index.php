<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php session_start();
$string = ' where valor > 10';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
switch ($_POST['valor']){
    case '1000';
        $string = 'where valor < 1000';
        $msg= "Até 1000";
        break;
    case '2000';
        $string = 'where valor BETWEEN 1001 AND 2000';
        $msg= "entre 1001 e 2000";
        break;
     case '3000';
        $string = 'where valor BETWEEN 2001 AND 3000';
        $msg= "entre 2001 e 3000";
        break;
     case '4000';
        $string = 'where valor BETWEEN 3001 AND 4000';
        $msg= "entre 3001 e 4000";
        break;
    case '';
        $string = '';
        break;
}
}
if (isset($_GET['sair']) && $_GET['sair'] == 'true') {
    
    unset($_SESSION['usuarioLogado']);
    unset($_SESSION['carrinhoUsuario']);
    
    echo 'Sessão encerrada';  
}

    
?>
    <head>
        <meta charset="UTF-8">
        <title></title>
        	<title>Menu Horizontal</title>
	<style type="text/css">
	
		body {
			padding:0px;
			margin:0px;
		}
 
		#menu ul {
			padding:0px;
			margin:0px;
			float: left;
			width: 100%;
			background-color:#EDEDED;
			list-style:none;
			font:80% Tahoma;
		}
 
		#menu ul li { display: inline; }
 
		#menu ul li a {
			background-color:#EDEDED;
			color: #333;
			text-decoration: none;
			border-bottom:3px solid #EDEDED;
			padding: 2px 10px;
			float:left;
		}
 
		#menu ul li a:hover {
			background-color:#D6D6D6;
			color: #6D6D6D;
			border-bottom:3px solid #EA0000;
		}
	
	</style>
        
    </head>
    <body>
     	<div id="menu">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="index.php?Tipo=1">Computadores</a></li>
			<li><a href="index.php?Tipo=2">Fone de Ouvido</a></li>
			<li><a href="index.php?Tipo=3">Teclado</a></li>
			<li><a href="index.php?Tipo=4">Mouse</a></li>
                        <?php 
                        if(empty($_SESSION['usuarioLogado']) && !isset($_SESSION['usuarioLogado'])){
                            echo '<li><a href="./cadastro/indexLogin.php">Login</a></li>';  
                            echo '<li><a href="/Lojinha/cadastro/indexCadastro.php">Novo Usuario</a></li>';
                             }else{
                             echo '<li><a href="/Lojinha/indexCarrinho.php">Carrinho</a></li>';
                             echo '<li><a href="index.php?sair=true">Sair</a></li>';
                             }           
                        ?>
		</ul>
            <form name="formCombo" action="" method="post" enctype="multipart?form-data">
                <select name="valor">
                    <option value="" selected> Selecione um Valor </option>
                    <option value="1000" > Até  R$ 1.000,00 </option>
                    <option value="2000" > R$ 1.001,00 Até R$ 2.000,00 </option>
                    <option value="3000" > R$ 2.001,00 Até R$ 3.000,00 </option>
                    <option value="4000" > Acima 3.001,00 </option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" name="botao" value="Filtrar">
                   </form>
	</div>
        
        <?php 
              //include_once './Models/Produto.php';
              include_once './Dao/ProdutoDAO.php';
              include_once './Models/Usuario.php';
              include_once './conecBanco/ConnectionPool.php';
              
            
            if(isset($_SESSION['usuarioLogado']) && !empty($_SESSION['usuarioLogado'])){
                 $sObj = $_SESSION['usuarioLogado'];
                 $usuario = unserialize($sObj);
            
                echo 'seja bem vindo '.$usuario->getUsername(); 
    
            }
            
        ?>
        
        <div id="conteudo">
            <h1>Vitrine de produtos</h1>
            
            <table cellpadding="8" cellspacing="10"border="0" width="100%">
                <tr>
                    <?php
                    
                      $produtoDao = new ProdutoDao(); 
     

                      $res = $produtoDao->executarQuery("SELECT * FROM produto $string;");
                    
                      
                    $LoopH = 3 ;
                   
                   
                    $i = 1;
                    while($row = $res->fetch_assoc()){
                        if($i < $LoopH){
                            echo '<td align="center" valing="top" bgcolor="#FFFFFF">'
                                .'<img src= "'.$row['caminho_img'].'" width ="200" height="150" alt=""/><br/>'
                                .'<a href="DescricaoProdutos.php?id='.$row['id_produtos'].'"> Nome: <strong>'.$row['nome'].'</strong> </a> <br/> '
                                .'Valor: <strong> R$ '. number_format($row['valor'],2,",",".").'</strong> </td>';
                        }elseif($i = $LoopH){
                            echo '<td align="center" valing="top" bgcolor="#FFFFFF">'
                                .'<img src= "'.$row['caminho_img'].'" width ="200" height="150" alt=""/><br/>'
                                .'<a href="DescricaoProdutos.php?id='.$row['id_produtos'].'"> Nome: <strong>'.$row['nome'].'</strong> </a> <br/> '
                                .'Valor: <strong> R$ '. number_format($row['valor'],2,",",".").'</strong> </td>'
                                .'</tr><tr>';
                            $i = 0;
                        }
                        $i++;
                    }
                    
                    ?>
                    
                </tr>
                
            </table>
        </div>
        
    </body>
</html>
