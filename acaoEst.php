<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $estId = isset($_GET['estId']) ? $_GET['estId'] : 0;
        excluir($estId);
    }
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $estId = isset($_POST['estId']) ? $_POST['estId'] : "";
        if ($estId == 0){
            require_once ("classes/Estado.class.php");

            $estado = new Estado("", $_POST['estNome'], $_POST['estSigla']);
            
            $resultado = $estado->inserir();
            
            
            //verificar resultado e apresentar para o usuario
            if ($resultado){

                header("location:indexEst.php");
            } else {
                echo "Não funcionou";
            }
        }
        else
            editar($estId);
    }

//Editar dados
    function editar($estId){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE estado SET estNome = :estNome, estSigla = :estSigla WHERE estId = :estId');

        $stmt->bindParam(':estId', $estId, PDO::PARAM_INT);
        $estId = $_POST['estId'];

        $stmt->bindParam(':estNome', $estNome, PDO::PARAM_STR);
        $estNome = $_POST['estNome'];

        $stmt->bindParam(':estSigla', $estSigla, PDO::PARAM_STR);
        $estSigla = $_POST['estSigla'];

        $stmt->execute();
        header("location:indexEst.php");
    }



//Excluir dados
    function excluir($estId){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM estado WHERE estId = :estId');
        $stmt->bindParam(':estId', $estId);
        $stmt->execute();
        header('location:indexEst.php');
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