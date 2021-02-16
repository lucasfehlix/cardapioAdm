<?php
    ob_start();
    $path = "pdf/";
    $diretorio = dir($path);
    require_once 'menu.php';
    $connect = new Menu();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio Online ADM</title>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2 class="titulo mt-3">Cardápio Online ADM</h2>
        <hr>
        <div class="row">
            <div class="col-md-12" id="column-list">
                <div class="row">
                    <div class="col text-left">
                        <button class="btn btn-outline-primary mt-3 mb-3" id="btn-add">Adicionar Cardápio</button>
                    </div>
                    <div class="col text-center">
                        <div class="alert fade" role="alert" id="alert"></div>
                    </div>
                </div>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Cardápio</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="menu-list">
                        <?php
                            while($arquivo = $diretorio -> read()){
                                $reveste = strrev($arquivo);
                                if (substr($reveste,0,4) == "fdp.") {
                                    ?>
                                        <tr>
                                            <td><?php echo "<a class='link' href='".$path.$arquivo."'>".$arquivo."</a><br />"; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?php echo $arquivo; ?>" onclick="modal('<?php echo $arquivo; ?>')">Excluir</button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                            $diretorio -> close();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 d-none" id="column-form">
                <h3>Formulário</h3>
                <form id="form-menu" action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="menu" class="form-label">Selecione o Cardápio:</label>
                        <input class="form-control" type="file" id="menu" name='menu' required>
                    </div>
                    <br>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <button class="btn btn-link mt-1" id="btn-cancel">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <!-- Modal executa quando botão Excluir é clicado-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir Cardápio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body"></div>
                <div class="modal-footer" id="modal-footer"></div>
            </div>
        </div>
    </div>
    <!-- Modal fim-->
</body>
</html>
<?php
    if(isset($_FILES['menu'])){
        if(!($_FILES['menu']['name'] == "")) {
            if($_FILES['menu']['type'] == "application/pdf"){
                $endereco = $_FILES['menu']['tmp_name'];
                $menu = $_FILES['menu']['name'];
                if($connect->addMenu($endereco,$menu)){
                    header("location: index.php");
                }else{
                    ?>
                        <script>alertFailure('ERRO: Cardápio não cadastrado!')</script>
                    <?php
                }
            } else {
                ?>
                    <script>alertCaution('ATENÇÃO: Só é possivel enviar arquivos do tipo PDF!')</script>
                <?php
            }
        }
    }
    if (isset($_GET['menudelete'])) {
        $menu = $_GET['menudelete'];
        if($connect->deleteMenu($menu)){
            header("location: index.php");
        }else{
            ?>
                <script>alertFailure('ERRO: Cardápio não deletado!')</script>
            <?php
        }
    }
?>