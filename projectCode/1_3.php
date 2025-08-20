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
                    IL VOLTO NASCOSTO DELLA PANDEMIA <br>
                    GLI SPAZI E I MODI DELLA SOCIALITÀ AI TEMPI DEL COVID-19
                </div>
                <img class="img-articles" src="img/ARTICLES/delFabbro.svg" alt="image_article">
                <div class="pref-article">ABSTRACT</div><br>

                Il 2020 è stato uno degli anni più difficili e scioccanti della storia recente del nostro paese. La diffusione del COVID-19 e le conseguenti imposizioni dei governi per far fronte alla sua rapida e inarrestabile diffusione hanno causato grandi cambiamenti in ogni area della nostra vita. La pandemia COVID-19 ha sollevato questioni su come le relazioni umane e le interazioni siano cambiate nel contesto delle misure adottate per contenere la diffusione del virus. 
                Nel mio articolo mi concentro sull'impatto che l'emergenza pandemica ha avuto sulla comunicazione interpersonale, analizzando come sono cambiati i modi, gli spazi e i tempi delle interazioni sociali. Dopo una prima parte introduttiva, in cui analizzo brevemente la comunicazione interpersonale e le sue componenti, nella parte centrale dell’elaborato mi soffermo sull’impatto che le misure adottate al fine di contenere i contagi da COVID-19 hanno avuto sulle interazioni sociali, evidenziando l’entità e la portata del cambiamento che esse hanno innestato nelle relazioni quotidiane, concentrandomi soprattutto su come è mutato il modo di porsi nello spazio durante uno scambio interpersonale.
                
                <?php if (isset($_SESSION['user_id'])) : ?>
    <?php
    
    $token = bin2hex(random_bytes(32));
    $_SESSION['download_token'] = $token;
    ?>
    <div class="link-box">
        <a href="download.php?file=camilla_del_fabbro_1.pdf&token=<?php echo $token; ?>" class="link-download">
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
                    Camilla&nbsp&nbspdel&nbsp&nbspFabbro&nbsp&nbsp
                </p>
                <p>
                    Camilla&nbsp&nbspdel&nbsp&nbspFabbro&nbsp&nbsp
                </p>
            </div>
        </div>
    </footer>
</body>

</html>