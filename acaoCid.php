<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $cidId = isset($_GET['cidId']) ? $_GET['cidId'] : 0;
        require_once ("classes/Cidade.class.php");
        $cidade = new Cidade("", "", "");
        $resultado = $cidade->excluir($cidId);
        header("location:indexCid.php");
    }

  
    
    
    

   
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cidId = isset($_POST['cidId']) ? $_POST['cidId'] : "";
        if ($cidId == 0){
            require_once ("classes/Cidade.class.php");

            $cidade = new Cidade("", $_POST['cidNome'], $_POST['estado_estId']);
            
            $resultado = $cidade->inserir();
            header("location:indexCid.php");
        }
        else
        require_once ("classes/Cidade.class.php");
        
        $cidade = new Cidade($_POST['cidId'], $_POST['cidNome'], $_POST['estado_estId']);
        $resultado = $cidade->editar($cidId);
        header("location:indexCid.php");        
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