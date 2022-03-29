<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $estId = isset($_GET['estId']) ? $_GET['estId'] : 0;
        require_once ("classes/Estado.class.php");
        $estado = new Estado("", "", "");
        $resultado = $estado->excluir($estId);
            header("location:indexEst.php");
    }
    

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $estId = isset($_POST['estId']) ? $_POST['estId'] : "";
        if ($estId == 0){
            require_once ("classes/Estado.class.php");

            $estado = new Estado("", $_POST['estNome'], $_POST['estSigla']);
            
            $resultado = $estado->inserir();
            header("location:indexEst.php");
        }
        else
            require_once ("classes/Estado.class.php");
            
            $estado = new Estado($_POST['estId'], $_POST['estNome'], $_POST['estSigla']);
            $resultado = $estado->editar($estId);
            header("location:indexEst.php");        
    }

    

//Consultar dados
    function buscarDados($estId){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM estado WHERE estId = $estId");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['estId'] = $linha['estId'];
            $dados['estNome'] = $linha['estNome'];
            $dados['estSigla'] = $linha['estSigla'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['estId'] = $linha['estId'];
        $dados['estNome'] = $linha['estNome'];
        $dados['estSigla'] = $linha['estSigla'];

            return $dados;
    }

?>