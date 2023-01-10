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


//CONEXAO DB
   
    $connection = new PDO("mysql:host=localhost;dbname=u634657636_moonbet", "u634657636_moon", "MoonBet@1");
     
    $decoded = JWT::decode($_COOKIE['UserTOKEN'], new Key($publicKey, 'RS256'));
    $decoded_array = (array) $decoded;
    $email = $decoded->InformationAccount->Email;
    $tel = $decoded->InformationAccount->Telefone;
    $query = $connection->query("SELECT * FROM account WHERE `email` = '$email'");
    $query = $query->fetch(PDO::FETCH_OBJ);
    $saldo = $query->saldo;
    $apelido = $query->apelido;
    $number = rand(1,10);
    $aposta_POST = "Esperando...";
    $valor_POST = "Esperando...";
    $centavos = "";

  if (isset($_POST['submit_POST'])) {
    $valor_POST = addslashes($_POST['valor']);
    $aposta_POST = addslashes($_POST['aposta']);
    $centavos = "00";
    if($valor_POST > $saldo) {
        echo ("Ops! Seu saldo é insuficiente para concluir a aposta.");
        $aposta_POST = "Saldo Ins";
        $valor_POST = "Saldo Ins";
    } else {
        $query = $connection->query("SELECT * FROM account WHERE `email` = '$email'");
            if($query->rowCount() == 1) {
             
                $query = $connection->query("SELECT * FROM account WHERE `email` = '$email'");
            $query = $query->fetch(PDO::FETCH_OBJ);
            $connection->query("UPDATE account SET `saldo` = `saldo` - $valor_POST WHERE `email` = '$email'");
            if($aposta_POST == $number){
            $acertou = $valor_POST * $number;
            $connection->query("UPDATE account SET `saldo` = `saldo` + $acertou WHERE `email` = '$email'");
            echo ("Parabéns! Você conseguiu um $number x!");
                
            }
            }
        }
    }

           
                
  
  
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Numbers | MoonBet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Banner-Heading-Image.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><i class="far fa-moon"></i></span><span>MoonBet | Numbers</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Log-out</a></li>
                </ul>
            </div>
            <div class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                <div class="dropdown-menu"><a class="dropdown-item" href="#">Numbers</a><a class="dropdown-item" href="termos.html">Termos</a><a class="dropdown-item" href="dep    .php">Depósitos</a><a class="dropdown-item" href="cupom.php">Cupons</a><a class="dropdown-item" href="saque.php">Saque</a></div>
            </div>
        </div>
    </nav>
    <section class="position-relative py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Apostar em Numbers</h2>
                    <p class="w-lg-50">Coloque sua aposta em um número. De 1 até 10!</p>
                    <p>O Seu valor irá <strong>Multiplicar</strong> de acordo com a sua aposta. </p>
                </div>
            </div>
            <p>O <strong> Number </strong> da vez foi: <strong><?php echo $number ?></strong> </p>
            <p> Você apostou no número:<?php echo $aposta_POST ?></p>
            <p> Seu saldo é: R$ <?php echo $saldo ?> </p>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                        <form class="text-center" action="" method="post">
                                <div class="mb-3"><input class="form-control" type="number" name="aposta" value="" min = "1" max = "10" placeholder="Aposta "></div>
                                <div class="mb-3"><input class="form-control" type="number" name="valor" value="" placeholder="Valor"></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="submit_POST">Começar o Jogo</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Apostas</th>
                    <th>Valores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $apelido ?></td>
                    <td>R$ <?php echo $valor_POST?></td>
                </tr>
                <tr></tr>
            </tbody>
        </table>
    </div>
    <h1></h1>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>