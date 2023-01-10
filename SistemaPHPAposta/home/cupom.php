<?php
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

define("CUPOM","moon15");
$type = 'saldo';
if (isset($_POST['submit_POST'])) {
 $cupom_POST = addslashes($_POST['cupom_POST']);
    $query = $connection->query("SELECT * FROM `used_cupom` WHERE `email` = '$email' AND `cupom` = 'moon15'");
    if ($query->rowCount() == 0) {
        if ($cupom_POST == CUPOM) {
            $query = $connection->query("UPDATE account SET `saldo` = `saldo` + 15 WHERE `email` = '$email'" );
            $query = $connection->query("INSERT INTO `used_cupom`(`email`, `cupom`) VALUES ('$email','moon15')" ); 
            echo "Sucesso! Você resgatou o cupom do tipo $type e ele já foi acrescentado na sua conta.";
        } else {
            echo "O Cupom inserido é inválido!";    
        }
    } else {
        echo "Ops! Parece que esse código já foi usado.";
    }



}









?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Resgatar um código | MoonBet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><i class="far fa-moon"></i></span><span>MoonBet | Cupons</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="#">Log-out</a></li>
                </ul>
            </div>
            <div class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                <div class="dropdown-menu"><a class="dropdown-item" href="numbers.php">Numbers</a><a class="dropdown-item" href="termos.html">Termos</a><a class="dropdown-item" href="dep.php">Depósitos</a><a class="dropdown-item" href="">Cupons</a><a class="dropdown-item" href="saque.php">Saque</a></div>
            </div>
        </div>
    </nav>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="text-center p-4 p-lg-5"></div>
        </div>
        <section class="position-relative py-4 py-xl-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2>Cupons</h2>
                        <p class="w-lg-50">Se você tem um código para resgate, coloque ele aqui!</p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-5">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><i class="fas fa-ticket-alt"></i></div>
                                <form class="text-center" method="post" action="">
                                    <div class="mb-3"><input class="form-control" type="text" name="cupom_POST" placeholder="Código"></div>
                                    <div class="mb-3"></div>
                                    <div class="mb-3"><button class="btn btn-primary d-block w-100" name= "submit_POST" type="submit">Resgatar</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>