<!DOCTYPE html>


<?php
    session_start();

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once '../Models/Usuario.php';
       include_once '../Dao/UsuarioDAO.php';
       
        $usuario = new Usuario();
        $usuarioDAO = new UsuarioDAO();

            $usuario->setPrimeiroNome($_POST['nome']);
            $usuario->setUltimoNome($_POST['sobrenome']);
            $usuario->setUsername($_POST['userName']);
            $usuario->setPassword($_POST['senha']);
            $usuario->setEmail($_POST['email']);
            $usuario->setDtNascimento($_POST['data']);
            $usuario->setCpf($_POST['cpf']);
            $result = $usuarioDAO->cadastrar($usuario);
            echo $result->getPrimeiroNome();
            $_SESSION['usuarioLogado'] = serialize($result);
            header('Location: ../index.php');
       
    }
?>

<html>
        
     <head>
         <meta charset="ISO-8859-1">
         <title>CriaNovoUsuario</title>
     </head>
      
     <form method="post">
         <fieldset>
             <legend>Cria Usuario</legend>
             <div>
                 <label> Nome </label><br/>
                 <input type="text" name = "nome"/>
             </div>
             <div>
                 <label> Sobrenome </label><br/>
                 <input type="text" name = "sobrenome"/>
             </div>
             <div>
                 <label> Email </label><br/>
                 <input type="text" name = "email"/>
             </div>
             <div>
                 <label> cpf </label><br/>
                 <input type="text" name = "cpf"/>
             </div>
             <div>
                 <label> Data Nascimento </label><br/>
                 <input type="date" name = "data"/>
             </div>
             <div>
                 <label> username </label><br/>
                 <input type="text" name = "userName"/>
             </div>
             <div>
                 <label>senha</label><br/>
                 <input type="password" name="senha"/>
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