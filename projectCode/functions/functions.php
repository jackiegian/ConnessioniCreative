<?php

function connectToDatabase()
{
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "1*rQ2.RNbcIFC[xt";
    $dbname = "connessioni_creative";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        error_log("Connessione fallita: " . $e->getMessage());
        die("Connessione fallita.");
    }
}

function getMagazine()
{
    $conn = connectToDatabase();
    $sql = "SELECT numero, titolo FROM magazine";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result_magazine = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result_magazine) > 0) {
            foreach ($result_magazine as $row_magazine) {
                echo '<div class="dropdown-title">numero0' . htmlspecialchars($row_magazine["numero"]) . '</div>';
                echo '<div class="dropdown-list" id="list-' . htmlspecialchars($row_magazine["numero"]) . '">' . htmlspecialchars($row_magazine["titolo"]) . '</div>';
            }
        } else {
            echo "Nessun risultato";
        }
    } catch (PDOException $e) {
        error_log("Errore durante il recupero dei magazine: " . $e->getMessage());
        echo "Errore durante il recupero dei dati.";
    } finally {
        $conn = null;
    }
}

function getArticles()
{
    $conn = connectToDatabase();
    $sql = "SELECT articoli.titolo AS titolo_articolo, autori.nome AS nome_autore, autori.cognome AS cognome_autore, magazine.numero AS numero_magazine, autori.codice_autore AS codice_autore
            FROM articoli 
            JOIN autori ON articoli.autore = autori.codice_autore 
            JOIN magazine ON articoli.numero_magazine = magazine.numero 
            WHERE magazine.numero = 1
            ORDER BY autori.codice_autore ASC";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result_article = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result_article) > 0) {
            foreach ($result_article as $row_article) {
                $background_image = 'img/AUTHOR/' . htmlspecialchars($row_article["codice_autore"]) . '.svg';
                echo '<div class="dropdown-title">' . htmlspecialchars($row_article["nome_autore"]) . ' ' . htmlspecialchars($row_article["cognome_autore"]) . '</div>';
                echo '<div class="dropdown-list" data-background-image="' . $background_image . '"> <a class="link-article" href="' . htmlspecialchars($row_article["numero_magazine"]) . '_' . htmlspecialchars($row_article["codice_autore"]) . '.php">' .  htmlspecialchars($row_article["titolo_articolo"]) . '</a> </div>';
            }
        } else {
            echo "Nessun risultato";
        }
    } catch (PDOException $e) {
        error_log("Errore durante il recupero degli articoli: " . $e->getMessage());
        echo "Errore durante il recupero dei dati.";
    } finally {
        $conn = null;
    }
}

function registration()
{
    session_start();

    $error_message = '';
    $mail = '';
    $password = '';
    $name = '';
    $s_name = '';

    try {
        $conn = connectToDatabase();
    } catch (PDOException $e) {
        error_log("Connessione fallita durante la registrazione: " . $e->getMessage());
        $error_message = "Connessione fallita.";
        return [$error_message, $mail, $password, $name, $s_name, ''];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $name = htmlspecialchars($_POST["name"]);
        $s_name = htmlspecialchars($_POST["s_name"]);
        $two_factor_enabled = isset($_POST['two_factor']) ? 1 : 0;

        if (empty($_POST['g-recaptcha-response'])) {
            $error_message = 'Per favore, clicca il CAPTCHA.';
            return [$error_message, $mail, $password, $name, $s_name, ''];
        }

        $captcha = $_POST['g-recaptcha-response'];
        $secretKey = '6LcSEP4pAAAAAHE1kRyu-LRl1DP68qF2ULmsW0V0';
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");

        if ($response === false) {
            $error_message = 'Impossibile verificare il CAPTCHA. Controlla la connessione al server di verifica.';
            return [$error_message, $mail, $password, $name, $s_name, ''];
        }

        $responseKeys = json_decode($response, true);

        if (intval($responseKeys["success"]) !== 1) {
            $error_message = 'Verifica CAPTCHA fallita, riprova.';
            return [$error_message, $mail, $password, $name, $s_name, ''];
        }

        try {
            $stmt = $conn->prepare("SELECT id FROM utenti WHERE mail = :mail");
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $error_message = 'Questa email è già registrata. Prova con un\'altra email.';
                return [$error_message, $mail, $password, $name, $s_name, ''];
            }
        } catch (PDOException $e) {
            $error_message = "Errore nella verifica dell'email: " . htmlspecialchars($e->getMessage());
            return [$error_message, $mail, $password, $name, $s_name, ''];
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt_insert = $conn->prepare("INSERT INTO utenti (mail, password, name, s_name, two_factor_enabled) VALUES (:mail, :password, :name, :s_name, :two_factor_enabled)");
            $stmt_insert->bindParam(':mail', $mail);
            $stmt_insert->bindParam(':password', $hashed_password);
            $stmt_insert->bindParam(':name', $name);
            $stmt_insert->bindParam(':s_name', $s_name);
            $stmt_insert->bindParam(':two_factor_enabled', $two_factor_enabled, PDO::PARAM_BOOL);
            $stmt_insert->execute();
            $user_id = $conn->lastInsertId();

            $_SESSION['user_id'] = $user_id;

            if ($two_factor_enabled) {
                header("Location: authenticator.php");
            } else {
                header("Location: ok.php");
            }
            exit();
        } catch (PDOException $e) {
            $error_message = "Errore nell'inserimento dei dati: " . htmlspecialchars($e->getMessage());
            return [$error_message, $mail, $password, $name, $s_name, ''];
        } finally {
            $conn = null;
        }
    }

    return [$error_message, $mail, $password, $name, $s_name, ''];
}

function login()
{
    try {
        $conn = connectToDatabase();
    } catch (PDOException $e) {
        error_log("Connessione fallita durante il login: " . $e->getMessage());
        return "Connessione fallita.";
    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        try {
            $stmt = $conn->prepare("SELECT id, password, two_factor_enabled, secret FROM utenti WHERE mail = :mail");
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];

                if ($user['two_factor_enabled']) {
                    header("Location: authenticator.php");
                } else {
                    header("Location: ok.php");
                }
                exit();
            } else {
                return 'Credenziali non valide.';
            }
        } catch (PDOException $e) {
            return "Errore nella verifica delle credenziali: " . htmlspecialchars($e->getMessage());
        } finally {
            $conn = null;
        }
    }

    return '';
}
?>
