<!DOCTYPE html>

<?php
    include_once "acaoEst.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $IdEstado = isset($_GET['IdEstado']) ? $_GET['IdEstado'] : "";
    if ($IdEstado > 0)
        $dados = buscarDados($IdEstado);
}
    $title = "Cadastro de cidades";
    $NomeEstado = isset($_POST['NomeEstado']) ? $_POST['NomeEstado'] : "";
    $SiglaEstado = isset($_POST['SiglaEstado']) ? $_POST['SiglaEstado'] : "";


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
<h3>Insira o estado</h3><hr>
        <form method="post" action="acaoEst.php">
        <div class="form-group col-lg-3">

        <label><b>ID</b></label>
                    <input readonly  type="text" name="IdEstado" id="IdEstado" class="form-control" style="background-color: #81c788; border-color: #00CA14;" value="<?php if ($acao == "editar") echo $dados['IdEstado']; else echo 0; ?>"><br>

        <label><b>Nome do Estado</b></label>
                    <input name="NomeEstado" id="NomeEstado" type="text" required="true" class="form-control" style="background-color: #81c788; border-color: #00CA14;" value="<?php if ($acao == "editar") echo $dados['NomeEstado']; ?>" placeholder="Digite o estado"><br>
                
        <label><b>Sigla do Estado</b></label>
                    <input name="SiglaEstado" id="SiglaEstado" type="text" required="true" class="form-control" style="background-color: #81c788; border-color: #00CA14;" value="<?php if ($acao == "editar") echo $dados['SiglaEstado']; ?>" placeholder="Digite o estado"
                    maxlength="2" minlength="2"><br>
          
        


    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-outline-warning">
                     Adicionar 
                </button>


                </div>
           
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>