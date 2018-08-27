<!DOCTYPE html>


<?php
    session_start();
    if (isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser'])){
        header('Location: ../');
        die();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once '../models/Usuario.php';
        include_once '../dao/UsuarioDAO.php';
        
        $usuario = new Usuario();
        $usuarioDAO = new UsuarioDAO();
        try{
            $usuario->setPrimeiroNome($_POST['primeiroNome']);
            $usuario->setUltimoNome($_POST['ultimoNome']);
            $usuario->setUsername($_POST['username']);
            $usuario->setPassword($_POST['password']);
            $usuario->setEmail($_POST['email']);
            $usuario->setDtNascimento($_POST['dtNascimento']);
            $usuario->setCpf($_POST['cpf']);
            $usuarioDAO->validaUsuario($usuario);
            $usuarioDAO->cadastrar($usuario);
            header("Location: ../?successMessage=Usuario cadastrado com sucesso!");
        } catch (Exception $ex) {
            header("Location: ../cadastro/usuario.php?errorMessage=" . $ex->getMessage());
            die();
        }
    }
?>

<html>
    
     <head>
        <title>Lojinha do Abel</title>
        <script src="../js/jquery-1.9.1.js"></script>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
        <script src="../bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/main-style.css">
        <link rel="stylesheet" type="text/css" href="../noty/noty.css">
        <link rel="stylesheet" type="text/css" href="../noty/themes/bootstrap-v3.css">
        <link rel="stylesheet" type="text/css" href="../datepicker/css/bootstrap-datepicker3.min.css">
        <script src="../datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
        <script src="../noty/noty.js"></script>

    </head>
      <style>
        .form-container{
            background-color: #FFF;
            border-radius: 10px;
            margin:20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 11px 24px 0 rgba(0, 0, 0, 0.05);
            padding: 30px;
            color: #999;
        }
        .form-input-shadow{
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
    <body>
        
        <!-- Main navbar -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../" id="logo">LOJINHA DO ABEL</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(!isset($_SESSION['loggedUser']) || empty($_SESSION['loggedUser'])){ ?>
                        
                        <li class="active" data-toggle="modal"
		        data-target="#loginModal" id="login"><a href="javascript:void(0)">Entrar</a></li>
                        <li><a href="cadastro/usuario.php" id="register">Registrar</a></li>
                        
                        <?php } else { 
                            $usuario = unserialize($_SESSION['loggedUser']);
                        ?>
                        
                        <li class="active"  id="nome-usuario"><a href="#"><?php echo $usuario->getUsername(); ?></a></li>
                        <li><a href="#" id="carrinho"><span class="glyphicon glyphicon-shopping-cart" style="font-weight: bold;"></span></a></li>
                        <li><a href="../controllers/logout.php" id="register">Sair</a></li>
                        
                        <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLongTitle">Login</h3>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true" style="font-size: 2em;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST"
                              action="../controllers/login.php" id="login-form">
                            <div class="form-group">
                                <label for="email">Usuario</label> <input
                                    type="text" class="form-control modal-input-fix" id="username"
                                    placeholder="Nome de usuário"
                                    name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label> <input type="password"
                                                                           class="form-control modal-input-fix" id="password"
                                                                           placeholder="Senha" name="password">
                            </div>
                            <input type="submit" id="submit-login" hidden="true" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " id="login-button" onclick="login();">Entrar</button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <br>
        
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12 form-container">
                    <h2 style="margin-top: 0; font: inherit; font-size: 2.4em;">Registro</h2>
                    <form id="registerForm" action="../cadastro/usuario.php" method="POST" >
                        <div class="form-group">
                            <label for="primeiroNome">Primeiro nome: *</label>
                            <input id="primeiroNome" maxlength="30" class="form-control form-input-shadow" type="text" name="primeiroNome"  placeholder="Entre seu primeiro nome" value="">
                        </div>
                        <div class="form-group">
                            <label for="ultimoNome">Último nome: *</label>
                            <input id="ultimoNome" maxlength="30" type="text" class="form-control form-input-shadow" name="ultimoNome"  placeholder="Entre seu último nome" value="">
                        </div>
                        <div class="form-group">
                            <label for="username">Nome de usuário: *</label>
                            <input id="username" maxlength="30" minlength="4" type="text" class="form-control form-input-shadow" name="username" autocomplete="false" placeholder="Entre um nome de usuário" value="">
                            <smal id="usernameHelp"  class="form-text text-muted">Nome de usuário deve conter entre 4 e 30 caracteres</smal>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha: *</label>
                            <input id="password" maxlength="30" minlength="4" type="password" class="form-control form-input-shadow" aria-describedby="passwordHelp" autocomplete="false" name="password"  placeholder="Entre sua senha">
                            <smal id="passwordHelp"  class="form-text text-muted">Password must have at least 4 and less than 30 characters</smal>
                        </div>
                        <div class="form-group">
                            <label for="email">Email: *</label>
                            <input id="email" type="text" maxlength="60" class="form-control form-input-shadow" name="email" aria-describedby="emailHelp" placeholder="Entre seu email" value="">
                            <smal id="emailHelp" class="form-text text-muted">Entre um email válido</smal>
                        </div>
                        <div class="form-group" id="dtNascimento-container">
                            <label for="dtNascimento">Data de nascimento: *</label>
                            <input id="dtNascimento" class="form-control form-input-shadow" type="text" name="dtNascimento"  placeholder="Entre sua data de nascimento" value="">
                            <smal id="dtNascimentoHelp" class="form-text text-muted">Formato dd/mm/aaaa</smal>
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF: *</label>
                            <input id="cpf" class="form-control form-input-shadow" type="text" name="cpf"  placeholder="Entre seu cpf" value="">
                        </div>
                    </form>	
                    <button id="registerButton" onclick="submit()" class="btn btn-primary" aria-describedby="submitHelp">Registrar</button>		
                    <br>
                    <br>
                    <smal id="submitHelp">* Campo obrigatório</smal>
                </div>
            </div>	
        </div>
    </body>
    
     <script>    
    function login(){
        document.getElementById('login-form').submit();
    }     
        
    $(function() {
        $('#dtNascimento-container input').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR"
        });
    });
    
    function submit(){
        document.getElementById('registerForm').submit();
    }
    
    window.onload = function () {
        var url_string = window.location.href; //window.location.href
        var url = new URL(url_string);
        var errorMessage = url.searchParams.get("errorMessage");
        var warningMessage = url.searchParams.get("warningMessage");
        var successMessage = url.searchParams.get("successMessage");
        if (errorMessage) {
            new Noty({
                text: errorMessage,
                theme: 'bootstrap-v3',
                type: 'error',
                layout: 'topCenter',
                timeout: 4000
            }).show();
        }
        if (warningMessage) {
            new Noty({
                text: warningMessage,
                theme: 'bootstrap-v3',
                type: 'warning',
                layout: 'topCenter'
            }).show();
        }
        if (successMessage) {
            new Noty({
                text: successMessage,
                theme: 'bootstrap-v3',
                type: 'success',
                layout: 'topCenter'
            }).show();
        }
    }  
    </script>
    <script src="../js/global.js"/>
    
</html>