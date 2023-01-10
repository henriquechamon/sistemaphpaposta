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

    
$decoded = JWT::decode($_COOKIE['UserTOKEN'], new Key($publicKey, 'RS256'));
$decoded_array = (array) $decoded;
$connection = new PDO("mysql:host=localhost;dbname=u634657636_moonbet", "u634657636_moon", "MoonBet@1");
$email = $decoded->InformationAccount->Email;
$tel = $decoded->InformationAccount->Telefone;
$query = $connection->query("SELECT * FROM account WHERE `email` = '$email'");
$query = $query->fetch(PDO::FETCH_OBJ);
$saldo = $query->saldo;
$apelido = $query->apelido;
if (isset($_POST['botao'])) {
   $metodo_POST = addslashes($_POST['metodo']);
   $valor = addslashes($_POST['valor']);
   $email = addslashes($_POST['email']);
   if($valor > $saldo) {
        echo ("Ops! Saldo insuficiente.");
    } else {
  $connection->query("INSERT INTO `saques`(`email`, `apelido`, `valor`, `metodo`) VALUES ('$email','$apelido','$valor','$metodo_POST')");
  $connection->query("UPDATE account SET `saldo` = `saldo` - $valor WHERE `email` = '$email'");
  echo ("O Seu saque foi solicitado a nossa equipe, podendo demorar até 72hrs para cair em sua conta.");
  
  

}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Saque | MoonBet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><i class="fas fa-moon"></i></span><span>MoonBet | Saque</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">R$ <?php echo $saldo ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log-out</a></li>
                </ul>
            </div>
            <div class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                <div class="dropdown-menu"><a class="dropdown-item" href="numbers.php">Numbers</a><a class="dropdown-item" href="termos.html">Termos</a><a class="dropdown-item" href="dep.php">Depósitos</a><a class="dropdown-item" href="cupom.php">Cupons</a><a class="dropdown-item" href="#">Saque</a></div>
            </div>
        </div>
    </nav>
    <section class="position-relative py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Saque</h2>
                    <p class="w-lg-50">Realiza o seu saque com segurança!</p>
                    <p>Lembrando, o saque é apenas acima de <strong>R$ 80,00!</strong></p>
                    <p>Você só poderá sacar da mesma forma que depositou.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-piggy-bank-fill">
                                    <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595zm7.173 3.876a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199zm-8.999-.65A6.613 6.613 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 1 0 .286-.958A7.601 7.601 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962zM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0z"></path>
                                </svg></div>
                               <form class="text-center" method="post" action="">
                                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                                <div class="mb-3"><input class="form-control" type="number" name="valor" placeholder="Valor do saque" min="80" max="950000"></div>
                                <div class="mb-3"><input class="form-control" type="text" name="metodo" placeholder="Método de pagamento"></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" name="botao">Realizar saque</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>