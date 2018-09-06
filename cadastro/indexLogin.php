<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once '../Models/Usuario.php';
        include_once '../Dao/UsuarioDAO.php';
       
        $usuarioDAO = new UsuarioDAO();

        $username = $_POST['nome'];
        $senha = $_POST['senha'];
        
        $usuarioDAO->login($username, $password);
           
            
            header('Location: ../index.php');
       
    }
?>

<html>
        
     <head>
         <meta charset="ISO-8859-1">
         <title>Login Usuario</title>
     </head>
      
     <form method="post">
         <fieldset>
             <legend>Login Usuario</legend>
             <div>
                 <label> Username </label><br/>
                 <input type="text" name = "nome"/>
             </div>
             <div>
                 <label> Senha </label><br/>
                 <input type="password" name = "sobrenome"/>
             </div>
             <br/>
             <div>
                 <input type="submit" value="Enviar"/>
             </div>
         </fieldset>
         
     </form>
    
     <body>
        
      
    </body>
    
    
</html>