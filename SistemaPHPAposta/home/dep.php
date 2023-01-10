<?php
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
 $publicKey = <<<EOD
 -----BEGIN PUBLIC KEY-----
 MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8kGa1pSjbSYZVebtTRBLxBz5H
 4i2p/llLCrEeQhta5kaQu/RnvuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t
 0tyazyZ8JXw+KgXTxldMPEL95+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4
 ehde/zUxo6UvS7UrBQIDAQAB
 -----END PUBLIC KEY-----
 EOD;

 require __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

 $connection = new PDO("mysql:host=localhost;dbname=u634657636_moonbet", "u634657636_moon", "MoonBet@1");
     
 $decoded = JWT::decode($_COOKIE['UserTOKEN'], new Key($publicKey, 'RS256'));
 $decoded_array = (array) $decoded;
 $email = $decoded->InformationAccount->Email;
 $tel = $decoded->InformationAccount->Telefone;
 $query = $connection->query("SELECT * FROM account WHERE `email` = '$email'");
 $query = $query->fetch(PDO::FETCH_OBJ);
 $saldo = $query->saldo;
 $apelido = $query->apelido;
 $skybank = "skybank";
 if (isset($_POST['botao'])) {
    $metodo_POST = addslashes($_POST['metodo']);
    $valor = addslashes($_POST['valor']);
    $email = addslashes($_POST['email']);
    if($metodo_POST == $skybank){ 
    header("Location: https://paymentonlineskybank.skyb.com.br");
    }
   $connection->query("INSERT INTO `pagamentos`(`metodo`, `email`, `valor`) VALUES ('$metodo_POST','$email','$valor')");
   echo ("Request de Depósito enviada com sucesso. Verificaremos e retornaremos ao seu email $email!");

 
 
 

 
    

       






 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Depósito | MoonBet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><i class="far fa-moon"></i></span><span>MoonBet | Depósitos</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log-out</a></li>
                </ul>
            </div>
            <div class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                <div class="dropdown-menu"><a class="dropdown-item" href="numbers.php">Numbers</a><a class="dropdown-item" href="termos.html">Termos</a><a class="dropdown-item" href="#">Depósitos</a><a class="dropdown-item" href="cupom.php">Cupons</a><a class="dropdown-item" href="saque.php">Saque</a></div></div>
            </div>
        </div>
    </nav>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="text-center p-4 p-lg-5">
                <p class="fw-bold text-primary mb-2">Deposite na Moon Bet</p>
                <h1 class="fw-bold mb-4">Faça seu depósito!&nbsp;</h1>
                <p> Mande o valor nas chaves abaixo, e preencha o formulário! </p>
                <section class="position-relative py-4 py-xl-5">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <form class="text-center" method="post" action="">
                        </div><input  value = "" type="tex" name="metodo" placeholder="Metodo de pagamento: SkyBank ou PIX"><input type="number" name="valor" placeholder="Valor"><input type="email" name="email" value="<?php echo $email ?>" placeholde="E-mail">
                        <div class="mb-3"><input class="btn btn-primary d-block w-100" type="submit" value="Enviar depósito" name="botao"></div>
                       </form>
                        <h1>PIX</h1>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-5">
                                    <h3>kike.soutoamorim2308@gmail.com</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="text-center" action="" method="post">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6 col-xl-4">
                                    <div class="card mb-5"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>