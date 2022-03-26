<!DOCTYPE html>

<?php
    include_once "acaoCid.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $cidId = isset($_GET['cidId']) ? $_GET['cidId'] : "";
    if ($cidId > 0)
        $dados = buscarDados($cidId);
}
    $title = "Cadastro de cidades";
    $cidNome = isset($_POST['cidNome']) ? $_POST['cidNome'] : "";
    
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
</head>


<body>

    <div class="container-fluid">

        <form method="post" action="acaoCid.php">
        <label>ID</label>
                    <input readonly  type="text" name="cidId" id="cidId" class="form-control" value="<?php if ($acao == "editar") echo $dados['cidId']; else echo 0; ?>"><br>

        <label>Nome da cidade </label>
                    <input name="cidNome" id="cidNome" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['cidNome']; ?>" placeholder="Digite a cidade"><br>
                

        <label> Insira o imóvel </label><br>
                    <select name="estado_estId" id="estado_estId">
                        <?php
                            $pdo = Conexao::getInstance(); 
                
                            $consulta = $pdo->query("SELECT * FROM estado");

                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   ?>

               <option value="<?php echo $linha['estId'];?>"> <?php if ($acao == "editar") $dados['estado_estId']; ?>  <?php echo $linha['estNome'];?></option> 
            <?php } ?>
    </select>

<br><br>

    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-info">
                     Adicionar 
                </button>


                </div>
           
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>