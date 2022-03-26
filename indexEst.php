<!DOCTYPE html>
<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Consulta de Estados";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;
?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img\favicon.ico">
    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>

    
</head>
<body>

    <div class="container-fluid">
    <navbar>
    <a class="navbar-brand" href="cadastroCid.php">CadastroCid</a>
    <a class="navbar-brand" href="indexCid.php">consulta cid</a>

    <a class="navbar-brand" href="indexEst.php">Consulta estado</a>
    <a class="navbar-brand" href="cadastroEst.php">Cadastro do estado</a>


    </navbar>

    <form method="post">

                    <div class="form-group col-lg-3">
                    <h3>Procurar Estado</h3>
                    <input type="text" name="procurar" id="procurar" size="50" class="form-control" placeholder="Insira o que deseja consultar"
                value="<?php echo $procurar;?>"> <br>
                <button name="acao" id="acao" type="submit"  class="btn btn-info">Procurar</button>

                <br><br>

        <p> Ordernar e pesquisar por:</p><br>
        <form method="post" action="">
                <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> Id<br>
                <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> Nome do estado<br>
                <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> Sigla<br>

    </div>

    <br><br>
    </form>

    <table class="table table-hover">
            <tr><td><b>ID</b></td>
                <td><b>Estado</b></td>
                <td><b>Sigla</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

            
    <?php
        $pdo = Conexao::getInstance(); 

        if($busca == 1){
            $consulta = $pdo->query("SELECT * FROM estado
                                WHERE estId LIKE '$procurar%' 
                                ORDER BY estId");}

        else if($busca == 2){
            $consulta = $pdo->query("SELECT * FROM estado
                                WHERE estNome LIKE '$procurar%' 
                                ORDER BY estNome");}

        else if($busca == 3){
            $consulta = $pdo->query("SELECT * FROM estado 
                                WHERE estSigla LIKE '$procurar%'
                                ORDER BY estSigla");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        
        ?>
        <tr><td><?php echo $linha['estId'];?></td>
            <td><?php echo $linha['estNome'];?></td>
            <td><?php echo $linha['estSigla'];?></td>
            <td><a href='cadastroEst.php?acao=editar&estId=<?php echo $linha['estId'];?>'> <img class="center" src="img/edit.png" alt=""></a></td>
            <td><?php echo " <a href=javascript:excluirRegistro('acaoEst.php?acao=excluir&estId={$linha['estId']}')>Excluir estado</a><br>"; ?></td>
        
        </tr>
    <?php } ?>       
    </table>
    </fieldset>
    </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>