<!DOCTYPE html>
<html>

<?php
include "functions/functions.php";
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="icon" type="image/x-icon" href="img/FAV/LOGO_EDITORIA.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="functions/functions.js"></script>
</head>

<body class="home">
    <?php include 'nav.php'; ?>
    <article>
        <div class="container-article">
            <div class="preview-article">
                <div class="date-article">maggio 2024</div>
                <div class="title-article">
                    Twin Peaks <br>
                    il riflesso del mondo in una serie tv
                </div>
                <img class="img-articles" src="img/ARTICLES/hernando.svg" alt="image_article">
                <div class="pref-article">ABSTRACT</div><br>

                L’avvento della pandemia Covid-19 ha inciso in maniera importante sulle abitudini di vita delle persone di tutto il mondo, comprese quelle legate alle modalità di fruizione dell’arte. Così come per i film, è cambiato anche il modo di guardare le serie televisive, passando da un consumo saltuario o giornaliero ad un consumo sempre più frequente, talvolta incontrollato, fomentato anche dalle produzioni delle serie tv, impegnate per far uscire episodi e stagioni sempre nuovi.
                In questo articolo si evidenzia come, pochi anni prima dello scoppio della pandemia SARS-CoV-2, una mente geniale avesse anticipato i cambiamenti e le complicazioni del mondo contemporaneo, in particolare legati alla diffusione delle nuove tecnologie e dei nuovi media, e li abbia esposti in una serie tv: David Lynch – a braccetto con il collaboratore Mark Frost – diede vita alla loro terza stagione di Twin Peaks, show televisivo che offrì una prima panoramica del mondo all’inizio degli anni novanta con le prime due stagioni, e ne propose un nuovo scorcio nell’anno 2017 con la stagione Il Ritorno.

                <?php if (isset($_SESSION['user_id'])) : ?>
    <?php
    
    $token = bin2hex(random_bytes(32));
    $_SESSION['download_token'] = $token;
    ?>
    <div class="link-box">
        <a href="download.php?file=sara_hernando_1.pdf&token=<?php echo $token; ?>" class="link-download">
            <span class="download-text">
                SCARICA QUI
                <div class="download-img">
                    <img class="arrow-img" src="img/DOWNLOAD/arrow_up.svg" alt="download-here">
                    <img src="img/DOWNLOAD/line.svg" alt="line">
                </div>
            </span>
            l'articolo completo
        </a>
    </div>
<?php else : ?>
    <div class="link-box">
                        <a href="login.php" class="link-download">
                            <span class="download-text">
                                SCARICA QUI
                                <div class="download-img">
                                    <img class="arrow-img" src="img/DOWNLOAD/arrow_up.svg" alt="download-here">
                                    <img src="img/DOWNLOAD/line.svg" alt="line">
                                </div>
                            </span>
                            l'articolo completo
                        </a>
                    </div>
<?php endif; ?>


            </div>
        </div>
    </article>
    <footer>
        <div class="gradient-box"></div>
        <div class="container">
            <div class="stage_animation">
                <p>
                    Sara&nbsp&nbspHernando&nbsp&nbsp
                </p>
                <p>
                    Sara&nbsp&nbspHernandoi&nbsp&nbsp
                </p>
            </div>
        </div>
    </footer>
</body>

</html>