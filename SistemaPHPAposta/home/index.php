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
  $decoded = JWT::decode($_COOKIE['UserTOKEN'], new Key($publicKey, 'RS256'));
  $decoded_array = (array) $decoded;
 $connection = new PDO("mysql:host=localhost;dbname=u634657636_moonbet", "u634657636_moon", "MoonBet@1");
  $email = $decoded->InformationAccount->Email;
  $tel = $decoded->InformationAccount->Telefone;
  $query = $connection->query("SELECT * FROM account WHERE `email` = '$email'");
  $query = $query->fetch(PDO::FETCH_OBJ);
  $saldo = $query->saldo;
  $apelido = $query->apelido;
  $diaehora = date('m-d-Y h:i:s ', time());
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Início | MoonBet</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Banner-Heading-Image.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><i class="far fa-moon"></i></span><span>MoonBet | Casa de apostas</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="#">R$ <?php echo $saldo ?></a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Início</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Log-out</a></li>
                </ul>
            </div>
            <div class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" href="#"></a>
                <div class="dropdown-menu"><a class="dropdown-item" href="numbers.php">Numbers</a><a class="dropdown-item" href="termos.html">Termos</a><a class="dropdown-item" href="dep.php">Depósitos</a><a class="dropdown-item" href="cupom.php">Cupons</a><a class="dropdown-item" href="saque.php">Saque</a></div>
            </div>
        </div>
    </nav>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="text-white p-4 p-md-5">
                            <h2 class="fw-bold text-white mb-3">Seja-muito bem vindo, <?php echo $apelido ?>!</h2>
                            <p class="mb-4">Aproveite nossos jogos! Faça uma renda extra conosco! Em breve, um novo modo de jogo. Color Up!</p>
                            <div class="my-3"><a class="btn btn-primary btn-lg me-2" role="button" href="https://t.me/+U4BJQt8MVek1ZWQx">Telegram</a></div>
                        </div>
                    </div>
                    <div class="col-md-6 order-first order-md-last" style="min-height: 250px;"><img class="w-100 h-100 fit-cover" src="https://cdn.discordapp.com/attachments/1013910920247910541/1014226518437789696/145235B3-76F7-4633-A789-677D90EF3E39.png"></div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr></tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div></div>
    </section>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="text-white bg-dark border rounded border-0 p-4 p-md-5">
                <h2 class="fw-bold text-white mb-3">Conheça como trabalhamos.</h2>
                <p class="mb-4">&nbsp;Na MoonBet, possuímos jogos próprios e 100% originais. Clique no botão abaixo para ficar ligado em quais são esses jogos, e fazer seu test-drive!</p>
                <div class="my-3">
                    <div class="dropdown"><button class="btn btn-primary dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button">Jogos Populares</button>
                        <div class="dropdown-menu"><a class="dropdown-item" href="numbers.php">Numbers</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
        <div class="card"></div>
        <footer class="text-white bg-dark"></footer>
        <section class="py-4 py-xl-5">
            <div class="container">
                <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="text-white p-4 p-md-5">
                                <h2 class="fw-bold text-white mb-3">Suporte</h2>
                                <p class="mb-4">Atendemos o suporte via e-mail. Clique no botão abaixo e diga a nós sua duvída!</p>
                                <div class="my-3"><a class="btn btn-primary btn-lg me-2" role="button" href="mailto:contatoapostas@moonbet.site">Converse Conosco</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="text-white bg-dark">
            <div class="container py-4 py-lg-5">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                        <h3 class="fs-6 text-white"></h3>
                        <ul class="list-unstyled">
                        <a href="termos.html">  <li>Termos</li> </a>
                        <a href="mailto:">   <li>Contate-nos</li> </a>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                        <ul class="list-unstyled"></ul>
                    </div>
                    <div class="col-lg-3 text-center text-lg-start d-flex flex-column align-items-center order-first align-items-lg-start order-lg-last item social">
                        <div class="fw-bold d-flex align-items-center mb-2"></div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center pt-3">
                    <p class="mb-0">Copyright © 2022 Moon Bet</p>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                            </svg></li>
                    </ul>
                </div>
            </div>
        </footer>
        <div class="ratio ratio-16x10"><iframe></iframe></div>
    </section>
    <section></section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>