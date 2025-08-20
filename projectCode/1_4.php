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
                    APPLAUSI SILENZIOSI <br>
                    Il teatro nell'era del distacco
                </div>
                <img class="img-articles" src="img/ARTICLES/volpi.svg" alt="image_article">
                <div class="pref-article">ABSTRACT</div><br>

                L'articolo si propone di esplorare le difficoltà che il settore artistico, con un focus particolare sul teatro, ha affrontato durante la pandemia di Covid-19. Verranno analizzati diversi casi studio, per prendere consapevolezza del momento drammatico1 che i teatranti e gli operatori tecnici hanno vissuto, ma anche per discutere delle soluzioni tecnologiche e creative adottate da alcuni per poter sopravvivere in questo periodo critico e di incertezza.
                Offriremo una panoramica sulla situazione di affluenza nei teatri prima della pandemia, confrontandola poi con il durante e dopo l’emergenza.
                Particolare attenzione sarà dedicata alle compagnie teatrali che non sono riuscite a superare la crisi, chiudendo definitivamente, ma anche a quelle che, integrando tradizione e innovazione, sono riuscite ad affermarsi in questo nuovo contesto dominato dal distanziamento sociale.
                Concluderemo con una breve riflessione sulle trasformazioni nel modo di fare e vivere il teatro, valutando l'impatto potenziale di queste innovazioni sul futuro del settore.

                <?php if (isset($_SESSION['user_id'])) : ?>
    <?php
    
    $token = bin2hex(random_bytes(32));
    $_SESSION['download_token'] = $token;
    ?>
    <div class="link-box">
        <a href="download.php?file=elena_volpi_1.pdf&token=<?php echo $token; ?>" class="link-download">
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
                    Elena&nbsp&nbspVolpi&nbsp&nbsp
                </p>
                <p>
                    Elena&nbsp&nbspVolpi&nbsp&nbsp
                </p>
            </div>
        </div>
    </footer>
</body>

</html>