<?php

declare(strict_types=1);
require 'vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

session_start();

include "functions/functions.php";

$g = new GoogleAuthenticator();


if (!isset($_SESSION['user_id']) || !isset($_SESSION['2fa_verified']) || $_SESSION['2fa_verified'] !== true) {
    
    header("Location: login.php");
    exit();
}


function generate_csrf_token() {
    return bin2hex(random_bytes(32));
}


if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generate_csrf_token();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Token CSRF non valido.");
    }

    
    if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
        session_destroy(); 
        header("Location: login.php");
        exit();
    }

    
    if (isset($_POST['generate_qr']) && $_POST['generate_qr'] === 'true') {
        generate_qr_code();
        exit();
    }
}

function generate_qr_code() {
    global $g;

    try {
        $conn = connectToDatabase();
        $userId = $_SESSION['user_id'];

   
        $stmt_select = $conn->prepare("SELECT secret FROM utenti WHERE id = :user_id");
        $stmt_select->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if ($row && isset($row['secret']) && !empty($row['secret'])) {
            $secret = $row['secret'];
        } else {
            
            $secret = $g->generateSecret();
            $stmt_update = $conn->prepare("UPDATE utenti SET secret = :secret WHERE id = :user_id");
            $stmt_update->bindParam(':secret', $secret);
            $stmt_update->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt_update->execute();
        }

        
        $qrUrl = GoogleQrUrl::generate('Connessioni', $secret, 'my-profile');
        echo json_encode(['qr_url' => $qrUrl]);

    } catch (PDOException $e) {
        echo json_encode(['error' => "Connessione al database fallita: " . htmlspecialchars($e->getMessage())]);
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connessioni Creative</title>
    <link rel="icon" type="image/x-icon" href="img/FAV/LOGO_EDITORIA.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="functions/functions.js"></script>
</head>

<body class="login-home">
    <?php include 'nav.php'; ?>
    <article class="form-box">
        <h1>Ciao!</h1>
        
        <p>Recupera credenziali di autenticazione a due fattori</p> <br>
        <button id="generate-qr-btn">Genera QR Code</button> <br>
        <div id="qr-code-container"></div>

        <form action="" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="logout" value="true">
            <input type="submit" value="Esci">
        </form>
        <br>
    </div>

    <script>
        $(document).ready(function() {
            $('#generate-qr-btn').on('click', function() {
                $.ajax({
                    url: '',
                    method: 'POST',
                    data: {
                        csrf_token: '<?php echo $_SESSION['csrf_token']; ?>',
                        generate_qr: 'true'
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.qr_url) {
                            $('#qr-code-container').html('<img id="QR" src="' + result.qr_url + '" alt="QR Code">');
                        } else if (result.error) {
                            alert(result.error);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
