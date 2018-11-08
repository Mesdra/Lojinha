
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
<div id="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>
    </form>
</div>
<?php
session_start();

include_once '/opt/lampp/htdocs/Lojinha/Models/Carrinho.php';
include_once '/opt/lampp/htdocs/Lojinha/Dao/ProdutoDAO.php';
include_once '/opt/lampp/htdocs/Lojinha/Models/Usuario.php';
include_once '/opt/lampp/htdocs/Lojinha/conecBanco/ConnectionPool.php';
include_once '/opt/lampp/htdocs/Lojinha/Dao/VendaDAO.php';


$s_Car = $_SESSION['carrinhoUsuario'];
$carrinho = new Carrinho();
$carrinho = unserialize($s_Car);
$produtoDao = new ProdutoDAO();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $vendaDao = new VendaDAO();

    $sObj = $_SESSION['usuarioLogado'];
    $usuario = unserialize($sObj);

    echo $id_venda = $vendaDao->cadastrar($usuario->getId());


    for($i =0; $i <= 50; $i++ ){

        if(!empty($carrinho->produtos[$i])) {

            $vendaDao->addvendaProduto($id_venda,$carrinho->produtos[$i],$carrinho->quant[$i]);
echo 'chegou';
        }

    }
    unset($_SESSION['carrinhoUsuario']);
    $carrinhoNovo = new Carrinho();
    $s_Car = serialize($carrinhoNovo);
    $_SESSION['carrinhoUsuario'] = $s_Car;
    header('Location: /Lojinha//index.php');
}


echo 'lista de produtos cadastrados';

for($i =0; $i <= 50; $i++ ){


    if(!empty($carrinho->produtos[$i])) {

        $id=  $carrinho->produtos[$i];
        $resultadoPesquisa = $produtoDao->executarQuery("SELECT * FROM produto WHERE id_produtos = ".$id.";");
        $row = $resultadoPesquisa->fetch_assoc();
        echo $row['nome'];

        echo '<form>';
        echo '<td align="center" valing="top" bgcolor="#FFFFFF">'
            .'<img src= "'.$row['caminho_img'].'" width ="200" height="150" alt=""/><br/>'
            .'Nome: <strong>'.$row['nome'].'</strong> </a> <br/> '
            .'Valor: <strong> R$ '. number_format($row['valor'],2,",",".").'</strong> </td>'
            .'Quantidade:<strong>'. number_format($carrinho->quant[$i]).'</strong> </td>';
        echo '<br>';
    }

}

?>


</form>
<form method="post">
    <fieldset>
        <div>
            <input type="submit" name="compra" value="Finalizar Compra"/>

        </div>
    </fieldset>

</form>