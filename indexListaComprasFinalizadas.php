
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


<?php session_start();
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 09/11/18
 * Time: 16:28
 */

include_once '/opt/lampp/htdocs/Lojinha/Dao/ProdutoDAO.php';
include_once '/opt/lampp/htdocs/Lojinha/Models/Usuario.php';
include_once '/opt/lampp/htdocs/Lojinha/conecBanco/ConnectionPool.php';


if(isset($_SESSION['usuarioLogado']) && !empty($_SESSION['usuarioLogado'])){
    $sObj = $_SESSION['usuarioLogado'];
    $usuario = unserialize($sObj);

    $id = $usuario->getId();

    $produtoDao = new ProdutoDao();

    $result = $produtoDao->executarQuery("SELECT * FROM venda  where id_usuario = '$id';");



    while ($row = $result->fetch_assoc()) {

        echo 'venda Numero = '.$row["id_venda"].'';
        echo '<br>';
        $id_venda = $row["id_venda"];
        $result2 = $produtoDao->executarQuery("SELECT * FROM venda_produto ven inner join produto pro where ven.id_venda = '$id_venda' and pro.id_produtos = ven.id_produto");

        while ($row2 = $result2->fetch_assoc()) {
            $quantidade = $row2["quantidade"];
            $nomeProduto = $row2["nome"];
            $valorUnit = $row2["valor"];
            echo '<img src= "'.$row2['caminho_img'].'" width ="200" height="150" alt=""/><br/>';
            echo 'Compra do equipamento = '.$nomeProduto.', comprou '.$quantidade.', este equipamento contem um valor unitário de '.$valorUnit.' reais.';
            echo'<br>';

        }
        echo'<br><br>';
    }


}
