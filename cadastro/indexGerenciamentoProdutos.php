<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        	<title>Menu Horizontal</title>
	<style type="text/css">
	<!--
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
	-->
	</style>
        
    </head>
    <body>
     	<div id="menu">
		<ul>
                    <li><a href="./addProduto.php">Cadastrar Novo Produto</a></li>
                    <li><a href="./excluiProduto.php">Excluir Produto</a></li>
                        <li><a href="./editarProduto.php">EditarProduto</a></li>
		</ul>
	</div>
        
        <?php session_start();
              include_once ('../Models/Usuario.php');
              
            
            if(isset($_SESSION['usuarioLogado']) && !empty($_SESSION['usuarioLogado'])){
                 $sObj = $_SESSION['usuarioLogado'];
                 $usuario = unserialize($sObj);
            
                echo 'seja bem vindo '.$usuario->getUsername(); 
    
            }
            
        ?>
        
    </body>
</html>