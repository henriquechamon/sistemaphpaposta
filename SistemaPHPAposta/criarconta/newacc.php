<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
    $privateKey = <<<EOD
    -----BEGIN RSA PRIVATE KEY-----
    MIICXAIBAAKBgQC8kGa1pSjbSYZVebtTRBLxBz5H4i2p/llLCrEeQhta5kaQu/Rn
    vuER4W8oDH3+3iuIYW4VQAzyqFpwuzjkDI+17t5t0tyazyZ8JXw+KgXTxldMPEL9
    5+qVhgXvwtihXC1c5oGbRlEDvDF6Sa53rcFVsYJ4ehde/zUxo6UvS7UrBQIDAQAB
    AoGAb/MXV46XxCFRxNuB8LyAtmLDgi/xRnTAlMHjSACddwkyKem8//8eZtw9fzxz
    bWZ/1/doQOuHBGYZU8aDzzj59FZ78dyzNFoF91hbvZKkg+6wGyd/LrGVEB+Xre0J
    Nil0GReM2AHDNZUYRv+HYJPIOrB0CRczLQsgFJ8K6aAD6F0CQQDzbpjYdx10qgK1
    cP59UHiHjPZYC0loEsk7s+hUmT3QHerAQJMZWC11Qrn2N+ybwwNblDKv+s5qgMQ5
    5tNoQ9IfAkEAxkyffU6ythpg/H0Ixe1I2rd0GbF05biIzO/i77Det3n4YsJVlDck
    ZkcvY3SK2iRIL4c9yY6hlIhs+K9wXTtGWwJBAO9Dskl48mO7woPR9uD22jDpNSwe
    k90OMepTjzSvlhjbfuPN1IdhqvSJTDychRwn1kIJ7LQZgQ8fVz9OCFZ/6qMCQGOb
    qaGwHmUK6xzpUbbacnYrIM6nLSkXgOAwv7XXCojvY614ILTK3iXiLBOxPu5Eu13k
    eUz9sHyD6vkgZzjtxXECQAkp4Xerf5TGfQXGXhxIX52yH+N2LtujCdkQZjXAsGdm
    B2zNzvrlgRmgBrklMTrMYgm1NPcW+bRLGcwgW2PTvNM=
    -----END RSA PRIVATE KEY-----
    EOD;

    
    
    require __DIR__ . '/../vendor/autoload.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $connection = new PDO("mysql:host=localhost;dbname=u634657636_moonbet", "u634657636_moon", "MoonBet@1");
    $query = $connection->query("SELECT * FROM `account`");
    
     if(isset($_POST['submit_POST'])) {
        if(!empty($_POST['email']) && !empty($_POST['password'])) {
            $Email = addslashes($_POST['email']);
            $Password = addslashes($_POST['password']);
            $Apelido = addslashes($_POST['apelido']);

            $connection->query("INSERT INTO `account`(`email`, `senha`, `saldo`, `apelido`) VALUES  ('$Email','$Password',0,'$Apelido')");
            
            $payload = [
                "InformationAccount" => [
                    "Email" => $Email,
                    "Apelido" => $Apelido
                ],
                "jwtinformation" => [
                    "open" => date("d-m-Y h:i:s"),
                    "expire" => date("d-m-Y h:i:s",strtotime("+1 days"))
                ]
            ];
            
    
            header("Location: ../home/index.php");

        } else {
            echo "Por favor, preencha todos os campos!";
        }
    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>MoonBet | Sign-up page</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="position-relative py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h1 style="color:rgb(255, 255, 255);">Criar conta</h1>
                    <p class="w-lg-50"><p style="color:rgb(255, 255, 255);">Seja muito bem-vindo(a) a moonbet! A Mais nova casa de apostas aqui no Brasil. Crie sua nova conta.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                        <form class="text-center" action="" method="post">
                                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Senha"></div>
                                <div class="mb-3"><input class="form-control" type="text" name="apelido" placeholder="Apelido"></div>
                                <div class="mb-3"><input class="btn btn-primary d-block w-100" type="submit" value="Criar Conta" name="submit_POST"></div>
                              <a href="../index.php">  <p class="text-muted">Faça Log-in</p> </a>
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