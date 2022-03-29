<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Cidade e Estado";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;
?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\casa.png">
    <link rel="stylesheet" href="css/estilo.css">

    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>

    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" ><img src="img/casaLogo.png" style="width: 4vw; margin-left: 50px;"></a>
        <a class="navbar-brand"  style="margin-left: 20px; font-size: 35px"><b>Cidade e Estado</b></a>
        <a class="navbar-brand" href="#" style="padding-left: 150px; font-size: 25px"><b>| Cidades |</b></a>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="indexEst.php" style="padding-left: 90px; font-size: 25px"><b>| Estados |</b></a>
            </li>    
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding-left: 90px; font-size: 25px"><b>Cadastros</b></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="cadastroCid.php">Cadastro de Cidade</a></li>
            <li><a class="dropdown-item" href="cadastroEst.php">Cadastro de Estado</a></li>
            </ul>
            </li>
            <ul>
        </div>
        </div>
    </nav>

    <div class="container-fluid">
<br><br><br>
    <form method="post">

                    <div class="form-group col-lg-3"><br><br><br>
                    <h3><b>Procurar Cidade:</b></h3><br>
                    <input type="text" name="procurar" id="procurar" size="50" class="form-control" style="background-color: #81c788; border-color: #00CA14;"  placeholder="Insira o que deseja consultar" value="<?php echo $procurar;?>"> <br>
                <button name="acao" id="acao" type="submit"  class="btn btn-outline-warning">Procurar</button>

                <br><br>

        <p><b>Ordernar e pesquisar por:</b></p><br>
        <form method="post" action="">
                <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>><b> Id</b><br>
                <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>><b> Cidade</b><br>
                <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>><b> Estado</b><br>

    </div>

    <br><br>
    </form>

    <table class="table table-hover table-success table-striped">
            <tr><td><b>Id</b></td>
                <td><b>Cidade</b></td>
                <td><b>Estado</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir Cidade</b></td>
            </tr> 

            
    <?php
        $pdo = Conexao::getInstance(); 

        if($busca == 1){
            $consulta = $pdo->query("SELECT * FROM estado, cidade 
                                WHERE cidade.IdCidade LIKE '$procurar%' 
                                AND estado.IdEstado = cidade.estado_IdEstado
                                ORDER BY cidade.IdCidade");}

        else if($busca == 2){
            $consulta = $pdo->query("SELECT * FROM estado, cidade 
                                WHERE cidade.NomeCidade LIKE '$procurar%' 
                                AND estado.IdEstado = cidade.estado_IdEstado
                                ORDER BY cidade.NomeCidade");}

        else if($busca == 3){
            $consulta = $pdo->query("SELECT * FROM estado, cidade 
                                WHERE estado.NomeEstado LIKE '$procurar%'
                                AND estado.IdEstado = cidade.estado_IdEstado
                                ORDER BY estado.IdEstado");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        
        ?>
        <tr><td><?php echo $linha['IdCidade'];?></td>
            <td><?php echo $linha['NomeCidade'];?></td>
            <td><?php echo $linha['NomeEstado'];?></td>
            <td><a href='cadastroCid.php?acao=editar&IdCidade=<?php echo $linha['IdCidade'];?>'> <img class="center" height="30" style="padding-left: 7px; margin-top: 10px" src="img/editar.png" alt=""></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoCid.php?acao=excluir&IdCidade={$linha['IdCidade']}')><br>"; ?> <img class="center" height="30" style="padding-left: 35px; margin-top: -25px" src="img/excluir.png" alt=""></a></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
    
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>