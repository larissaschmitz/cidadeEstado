<!DOCTYPE html>

<?php
    include_once "acaoEst.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $estId = isset($_GET['estId']) ? $_GET['estId'] : "";
    if ($estId > 0)
        $dados = buscarDados($estId);
}
    $title = "Cadastro de cidades";
    $estNome = isset($_POST['estNome']) ? $_POST['estNome'] : "";
    $estSigla = isset($_POST['estSigla']) ? $_POST['estSigla'] : "";


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

        <label>ID</label>
                    <input readonly  type="text" name="estId" id="estId" class="form-control" value="<?php if ($acao == "editar") echo $dados['estId']; else echo 0; ?>"><br>

        <label>Nome do Estado </label>
                    <input name="estNome" id="estNome" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['estNome']; ?>" placeholder="Digite o estado"><br>
                
        <label>Sigla do Estado </label>
                    <input name="estSigla" id="estSigla" type="text" required="true" class="form-control" value="<?php if ($acao == "editar") echo $dados['estSigla']; ?>" placeholder="Digite o estado"
                    maxlength="2" minlength="2"><br>
          
        


    <button name="acao" value="salvar" id="acao" type="submit" class="btn btn-outline-secondary">
                     Adicionar 
                </button>


                </div>
           
    </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>