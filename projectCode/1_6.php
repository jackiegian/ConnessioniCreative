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
                    VOCI RIBELLI <br>
                    L'Evoluzione delle Controculture nell'Italia Post-Pandemica
                </div>
                <img class="img-articles" src="img/ARTICLES/palmisano.svg" alt="image_article">
                <div class="pref-article">ABSTRACT</div><br>

                L’impatto che la pandemia di COVID-19 ha avuto negli ultimi anni sulla quotidianità di ogni individuo è stato a lungo studiato sotto ogni suo aspetto. Fulcro costante di conversazioni e dibattiti, in poco tempo si è trasformato in semplice argomento di margine, fino a essere puro amarcord di un momento storico alquanto singolare. Eppure, i segni del suo passaggio sono ancora evidenti, nel vivere quotidiano dei singoli e della collettività. L’articolo fornisce una retrospettiva più ampia possibile sull’evoluzione che le maggiori controculture hanno avuto dal COVID-19 sino al giorno d’oggi. L’obiettivo è quello di stabilire un continuum con i vari studi sociologici avviati in piena pandemia, al fine di fornire una visione più completa del peso che hanno avuto anni di restrizioni, quarantene e coprifuochi sulle comunità, piccole o grandi che siano. I risultati degli studi qui riportati mostrano come abbiamo imparato, in seguito alla pandemia, a valorizzare lo spazio sociale senza sottovalutare il benessere ritrovato nello spazio personale.

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php
                    
                    $token = bin2hex(random_bytes(32));
                    $_SESSION['download_token'] = $token;
                    ?>
                    <div class="link-box">
                        <a href="download.php?file=virginia_palmisano_1.pdf&token=<?php echo $token; ?>" class="link-download">
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
                    Virginia&nbsp&nbspPalmisano&nbsp&nbsp
                </p>
                <p>
                    Virginia&nbsp&nbspPalmisano&nbsp&nbsp
                </p>
            </div>
        </div>
    </footer>
</body>

</html>