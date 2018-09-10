<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
			<li><a href="">Home</a></li>
			<li><a href="">Eestou com Sorte</a></li>
			<li><a href="">Roupas Esportivas</a></li>
			<li><a href="">Roupas Sociais</a></li>
			<li><a href="">Roupas Infantis</a></li>
			<li><a href="">Login</a></li>
                        <li><a href="/Lojinha/cadastro/indexCadastro.php">Novo Usuario</a></li>
		</ul>
	</div>
        
        <?php
            if(!isset($_SESSION['usuarioLogado']) || empty($_SESSION['usuarioLogago']))
            
        ?>
        
    </body>
</html>
