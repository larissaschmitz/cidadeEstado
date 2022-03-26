<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $cidId = isset($_GET['cidId']) ? $_GET['cidId'] : 0;
        excluir($cidId);
    }
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cidId = isset($_POST['cidId']) ? $_POST['cidId'] : "";
        if ($cidId == 0){
            require_once ("classes/Cidade.class.php");

            $cidade = new Cidade("", $_POST['cidNome'], $_POST['estado_estId']);
            
            $resultado = $cidade->inserir();
            
            
            //verificar resultado e apresentar para o usuario
            if ($resultado){

                header("location:indexCid.php");
            } else {
                echo "Não funcionou";
            }
        }
        else
            editar($cidId);
    }

//Editar dados
    function editar($cidId){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE cidade SET cidNome = :cidNome, estado_estId = :estado_estId WHERE cidId = :cidId');

        $stmt->bindParam(':cidId', $cidId, PDO::PARAM_INT);
        $cidId = $_POST['cidId'];

        $stmt->bindParam(':cidNome', $cidNome, PDO::PARAM_STR);
        $cidNome = $_POST['cidNome'];

        $stmt->bindParam(':estado_estId', $estado_estId, PDO::PARAM_STR);
        $estado_estId = $_POST['estado_estId'];

        $stmt->execute();
        header("location:indexCid.php");
    }



//Excluir dados
    function excluir($cidId){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM cidade WHERE cidId = :cidId');
        $stmt->bindParam(':cidId', $cidId);
        $stmt->execute();
        header('location:indexCid.php');
    }

//Consultar dados
    function buscarDados($cidId){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cidade WHERE cidId = $cidId");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cidId'] = $linha['cidId'];
            $dados['cidNome'] = $linha['cidNome'];
            $dados['estado_estId'] = $linha['estado_estId'];

        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no formulario
    function dadosForm(){
        $dados = array();
        $dados['cidId'] = $linha['cidId'];
        $dados['cidNome'] = $linha['cidNome'];
        $dados['estado_estId'] = $linha['estado_estId'];

            return $dados;
    }

?>