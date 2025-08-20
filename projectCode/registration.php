<?php
ob_start();

session_start();


?>

<!DOCTYPE html>
<html>
<?php include "functions/functions.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connessioni Creative - CREATE ACCOUNT</title>
    <link rel="icon" type="image/x-icon" href="img/FAV/LOGO_EDITORIA.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="functions/functions.js"></script>
</head>

<body class="login-home">
    <?php include 'nav.php'; ?>

    <?php
    
    $error_message = '';
    $mail = '';
    $password = '';
    $name = '';
    $s_name = '';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        list($error_message, $mail, $password, $name, $s_name) = registration();
    }
    ?>

    <article class="form-box">
        <h2>Crea un account</h2>

        <?php
      
        if (!empty($error_message)) {
            echo '<div class="error">' . htmlspecialchars($error_message) . '</div>';
        }
        ?>

        <form id="registrazione" action="" method="post" novalidate>
            <input type="text" id="name" placeholder="Nome" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <div class="error-message" id="name-error"></div> <br>

            <input type="text" id="s_name" placeholder="Cognome" name="s_name" value="<?php echo htmlspecialchars($s_name); ?>" required>
            <div class="error-message" id="s_name-error"></div> <br>

            <input type="email" id="mail" placeholder="Email" name="mail" value="<?php echo htmlspecialchars($mail); ?>" required>
            <div class="error-message" id="mail-error"></div> <br>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="material-symbols-rounded" id="toggle-password">visibility</i>
            </div>
            <div class="error-message" id="password-error"></div>
            <br>

            <div class="checkbox-container">
                <input type="checkbox" id="two_factor" name="two_factor">
                <label for="two_factor">Abilita autenticazione a due fattori</label>
            </div><br>

            <div class="g-recaptcha" data-sitekey="6LcSEP4pAAAAAMhbHJQu9yKRg-Z5eidapgRjgtKH"></div><br>

            <input type="submit" value="Crea">

            <div class="link-login">
                Già registrato? &nbsp <a href="login.php">Accedi</a>
            </div>
        </form>
    </article>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrazione');
            const nameInput = document.getElementById('name');
            const surnameInput = document.getElementById('s_name');
            const emailInput = document.getElementById('mail');
            const passwordInput = document.getElementById('password');

            
            if (<?php echo json_encode($_SERVER["REQUEST_METHOD"] == "POST" && !empty($error_message)); ?>) {
                nameInput.value = "<?php echo htmlspecialchars($name); ?>";
                surnameInput.value = "<?php echo htmlspecialchars($s_name); ?>";
                emailInput.value = "<?php echo htmlspecialchars($mail); ?>";
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (validateForm()) {
                    form.submit();
                }
            });

            function validateForm() {
                let isValid = true;

              
                if (nameInput.value.trim() === '') {
                    isValid = false;
                    showError('name-error', 'Il nome è obbligatorio.');
                } else {
                    clearError('name-error');
                }

                
                if (surnameInput.value.trim() === '') {
                    isValid = false;
                    showError('s_name-error', 'Il cognome è obbligatorio.');
                } else {
                    clearError('s_name-error');
                }

                
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
                } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(passwordInput.value.trim())) {
                    isValid = false;
                    showError('password-error', 'La password deve contenere almeno 8 caratteri, una lettera maiuscola, una minuscola e un numero.');
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