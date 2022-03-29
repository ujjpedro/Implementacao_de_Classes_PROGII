<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $IdCidade = isset($_GET['IdCidade']) ? $_GET['IdCidade'] : 0;
        require_once ("classes/Cidade.class.php");
        $cidade = new Cidade("", "", "");
        $resultado = $cidade->excluir($IdCidade);
        header("location:indexCid.php");
    }

  
    
    
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $IdCidade = isset($_POST['IdCidade']) ? $_POST['IdCidade'] : "";
        if ($IdCidade == 0){
            require_once ("classes/Cidade.class.php");

            $cidade = new Cidade("", $_POST['NomeCidade'], $_POST['estado_IdEstado']);
            
            $resultado = $cidade->inserir();
            header("location:indexCid.php");
        }
        else
            editar($IdCidade);
    }

//Editar dados
    function editar($IdCidade){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE cidade SET NomeCidade = :NomeCidade, estado_IdEstado = :estado_IdEstado WHERE IdCidade = :IdCidade');

        $stmt->bindParam(':IdCidade', $IdCidade, PDO::PARAM_INT);
        $IdCidade = $_POST['IdCidade'];

        $stmt->bindParam(':NomeCidade', $NomeCidade, PDO::PARAM_STR);
        $NomeCidade = $_POST['NomeCidade'];

        $stmt->bindParam(':estado_IdEstado', $estado_IdEstado, PDO::PARAM_STR);
        $estado_IdEstado = $_POST['estado_IdEstado'];

        $stmt->execute();
        header("location:indexCid.php");
    }


//Consultar dados
    function buscarDados($IdCidade){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cidade WHERE IdCidade = $IdCidade");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['IdCidade'] = $linha['IdCidade'];
            $dados['NomeCidade'] = $linha['NomeCidade'];
            $dados['estado_IdEstado'] = $linha['estado_IdEstado'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['IdCidade'] = $linha['IdCidade'];
        $dados['NomeCidade'] = $linha['NomeCidade'];
        $dados['estado_IdEstado'] = $linha['estado_IdEstado'];

            return $dados;
    }

?>