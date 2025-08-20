<?php
ob_start(); 
session_start();

include "functions/functions.php";


$error_message = '';
$mail = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_message = login();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connessioni Creative - LOGIN</title>
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
        <h2>Login</h2>

        <?php
        // Mostra messaggio di errore se presente
        if (!empty($error_message)) {
            echo '<div class="error">' . htmlspecialchars($error_message) . '</div>';
        }
        ?>

        <form id="login" action="" method="post" novalidate>
            <input type="email" id="mail" placeholder="Email" name="mail" value="<?php echo htmlspecialchars($mail); ?>" required><br>
            <div class="error-message" id="mail-error"></div>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="material-symbols-rounded" id="toggle-password">visibility</i>
            </div><br>
            <div class="error-message" id="password-error"></div>

            <input type="submit" value="Login">

            <div class="link-login">
                Già registrato? &nbsp <a href="registration.php">Accedi</a>
            </div>
            
        </form>
    </article>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login');
            const emailInput = document.getElementById('mail');
            const passwordInput = document.getElementById('password');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (validateForm()) {
                    form.submit();
                }
            });

            function validateForm() {
                let isValid = true;

                
                if (emailInput.value.trim() === '') {
                    isValid = false;
                    showError('mail-error', 'Inserisci un\'email valida.');
                } else if (!isValidEmail(emailInput.value.trim())) {
                    isValid = false;
                    showError('mail-error', 'Inserisci un\'email valida.');
                } else {
                    clearError('mail-error');
                }

              
                if (passwordInput.value.trim() === '') {
                    isValid = false;
                    showError('password-error', 'La password è obbligatoria.');
                } else {
                    clearError('password-error');
                }

                return isValid;
            }

            function showError(id, message) {
                const errorElement = document.getElementById(id);
                errorElement.textContent = message;
                errorElement.style.display = 'block';
            }

            function clearError(id) {
                const errorElement = document.getElementById(id);
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            }

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }
        });
    </script>
</body>

</html>
