<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $IdEstado = isset($_GET['IdEstado']) ? $_GET['IdEstado'] : 0;
        require_once ("classes/Estado.class.php");
        $estado = new Estado("", "", "");
        $resultado = $estado->excluir($IdEstado);
            header("location:indexEst.php");
    }
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $IdEstado = isset($_POST['IdEstado']) ? $_POST['IdEstado'] : "";
        if ($IdEstado == 0){
            require_once ("classes/Estado.class.php");

            $estado = new Estado("", $_POST['NomeEstado'], $_POST['SiglaEstado']);
            
            $resultado = $estado->inserir();
            header("location:indexEst.php");
        }
        else
            editar($IdEstado);
    }

//Editar dados
    function editar($IdEstado){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE estado SET NomeEstado = :NomeEstado, SiglaEstado = :SiglaEstado WHERE IdEstado = :IdEstado');

        $stmt->bindParam(':IdEstado', $IdEstado, PDO::PARAM_INT);
        $IdEstado = $_POST['IdEstado'];

        $stmt->bindParam(':NomeEstado', $NomeEstado, PDO::PARAM_STR);
        $NomeEstado = $_POST['NomeEstado'];

        $stmt->bindParam(':SiglaEstado', $SiglaEstado, PDO::PARAM_STR);
        $SiglaEstado = $_POST['SiglaEstado'];

        $stmt->execute();
        header("location:indexEst.php");
    }
    

//Consultar dados
    function buscarDados($IdEstado){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM estado WHERE IdEstado = $IdEstado");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['IdEstado'] = $linha['IdEstado'];
            $dados['NomeEstado'] = $linha['NomeEstado'];
            $dados['SiglaEstado'] = $linha['SiglaEstado'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['IdEstado'] = $linha['IdEstado'];
        $dados['NomeEstado'] = $linha['NomeEstado'];
        $dados['SiglaEstado'] = $linha['SiglaEstado'];

            return $dados;
    }

?>