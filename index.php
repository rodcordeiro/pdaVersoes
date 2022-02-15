<?php
include_once './db/db.class.php';
include_once './controllers/controller.php';
$db = new Database();
$conn = $db->getConnection();
$controller = new Controller($conn);
$versions = $controller->read();

if(isset($_POST["save"])){
    $controller->id_sistema = $_POST["idSistema"];
    $controller->sistema = $_POST["nomeSistema"];
    $controller->cliente = $_POST["clienteSistema"];
    $controller->versao = $_POST["versaoSistema"];
    if(isset($_GET['update'])){
        $controller->id = $_POST["id"];
        $controller->update();
    } else {
        $controller->create();
    }
    header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDA | Controle de versões</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>
<body>
    <div class="form_container">
        <form action="index.php" method="post" id='form'>
            <input type="hidden" name="id" id="id">
            <br/>
            <input type="text" name="nomeSistema" id="nomeSistema" placeholder="Insira o nome do sistema">
            <br/>
            <input type="text" name="versaoSistema" id="versaoSistema" placeholder="Insira a versão atual no cliente">
            <br/>
            <input type="text" name="clienteSistema" id="clienteSistema" placeholder="Insira o nome do cliente">
            <br/>
            <input type="text" name="idSistema" id="idSistema" placeholder="Insira o id cadastrado do sistema">
            <br/>
            <input type="submit" name='save' value="Adicionar">
        </form>
    </div>
    <div class="data_container">
        <?php 
            foreach($versions as $sistema){
                
        ?> 
        <div class="card" onClick='replaceFormData("<?php echo $sistema['sistema'];?>","<?php echo $sistema['versao'];?>","<?php echo $sistema['cliente'];?>",<?php echo $sistema['id_sistema'];?>,<?php echo $sistema['id'];?>)'>
            <h3>
            <?php echo $sistema['sistema'];?> 
            </h3>
            <p><span class='version'>v<?php echo $sistema['versao'];?></span> <i>#<?php echo $sistema['id_sistema']?></i> <span class="cliente"><?php echo $sistema['cliente'];?></span></p>
        </div>
        <?php } ?>
<!-- 
        <div class="card" onClick='replaceFormData("sistema","1.0.10","overcome",30)'>
            <h3>
            Nome do sistema<i>#32</i>
            </h3>
            <p><i>v1.0.0</i> <span class="cliente">Overcome</span></p>
        </div> -->
    </div>
    <script>
        function replaceFormData(name, version, client, code,sysId){
            const form = document.getElementById('form');
            const nome = document.getElementById('nomeSistema');
            const versao = document.getElementById('versaoSistema');
            const cliente = document.getElementById('clienteSistema');
            const id = document.getElementById('idSistema');
            const idDb = document.getElementById('id');
            nome.value = name;
            versao.value=version;
            cliente.value = client;
            id.value = code;
            idDb.value = sysId;
            form.action = "index.php?update"
        }
    </script>
</body>
</html>