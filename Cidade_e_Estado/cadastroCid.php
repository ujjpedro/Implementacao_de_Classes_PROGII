<!DOCTYPE html>

<?php
    include_once "acaoCid.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $IdCidade = isset($_GET['IdCidade']) ? $_GET['IdCidade'] : "";
    if ($IdCidade > 0)
        $dados = buscarDados($IdCidade);
}
    $title = "Cadastro de cidades";
    $NomeCidade = isset($_POST['NomeCidade']) ? $_POST['NomeCidade'] : "";
    
//var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/estilo.css">

</head>


<body>

    <div class="container-fluid">
<br>

<h3>Insira a cidade</h3><hr>

        <form method="post" action="acaoCid.php">
        <div class="form-group col-lg-3">
        <label><b>ID</b></label>
                    <input readonly  type="text" name="IdCidade" id="IdCidade" class="form-control" style="background-color: #81c788; border-color: #00CA14;" value="<?php if ($acao == "editar") echo $dados['IdCidade']; else echo 0; ?>"><br>

        <label><b>Nome da cidade</b></label>
                    <input name="NomeCidade" id="NomeCidade" type="text" required="true" class="form-control" style="background-color: #81c788; border-color: #00CA14;" value="<?php if ($acao == "editar") echo $dados['NomeCidade']; ?>" placeholder="Digite a cidade"><br>
                

        <label><b>Insira o Estado</b></label><br>
                    <select name="estado_IdEstado" id="estado_IdEstado" class="form-select" style="background-color: #81c788; border-color: #00CA14;"> 
                        <?php
                            $pdo = Conexao::getInstance(); 
                
                            $consulta = $pdo->query("SELECT * FROM estado");

                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   

                                if ($acao == "editar") echo $dados['estado_IdEstado']; 
                                                                    
                                ?>

                
              <option value="<?php echo $linha['IdEstado'];?>"> <?php if ($acao == "editar") $dados['estado_IdEstado']; ?>  <?php echo $linha['NomeEstado'];?></option> 
               <?php }
               ?>
    </select>

<br><br>


    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-outline-warning">
                     Adicionar 
                </button>

                            </div>
                </div>
           
    </form>
    

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>