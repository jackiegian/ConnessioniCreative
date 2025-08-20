<?php
declare(strict_types=1);
require 'vendor/autoload.php';

include "functions/functions.php";

use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

session_start();

$g = new GoogleAuthenticator();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$verificationMessage = '';
$qrUrl = '';
$secretGenerated = false;

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

        
        $qrUrl = GoogleQrUrl::generate('Connessioni', $secret, 'my-profile');
        $secretGenerated = true;
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userCode = $_POST['code'];

        $isValid = $g->checkCode($secret, $userCode);

        if ($isValid) {
            $_SESSION['2fa_verified'] = true; 
            header("Location: ok.php");
            exit();
        } else {
            $verificationMessage = 'Codice non valido. Riprova.';
        }
    }
} catch (PDOException $e) {
    echo "Connessione al database fallita: " . htmlspecialchars($e->getMessage());
} finally {
    if (isset($conn)) {
        $conn = null; 
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
    <article class="form-box">
        <h1>Verifica codice QR per Google Authenticator</h1>

        <?php if (!empty($verificationMessage)) : ?>
            <div class="message">
                <?php echo htmlspecialchars($verificationMessage); ?>
            </div>
        <?php endif; ?>

        <?php if ($secretGenerated) : ?>
            <p>Scansiona il seguente codice QR con Google Authenticator per configurare l'autenticazione a due fattori:</p>
            <img id="QR" src="<?php echo htmlspecialchars($qrUrl); ?>" alt="QR Code">
            <p><strong>Nota:</strong> Assicurati di avere installato un'applicazione compatibile con Google Authenticator sul tuo dispositivo mobile.</p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="code">Inserisci il codice:</label><br>
            <input type="text" id="code" name="code" required><br><br>
            <input type="submit" value="Verifica">
        </form>
    </article>
</body>
</html>
