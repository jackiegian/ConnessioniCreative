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
                <div class="title-magazine">IL MONDO CULTURALE POST PANDEMIA</div>
                <div class="sub-title-article"> magazine 01</div>
                <div class="pref-article">PREFAZIONE</div><br>

                L'editoria digitale negli ultimi due anni ha subito una trasformazione significativa, adattandosi alle nuove esigenze e alle preferenze dei lettori, ma anche e soprattutto al progresso delle nuove tecnologie digitali. Strumenti quali gli ebook, i podcast e la più recente intelligenza artificiale hanno contribuito alla crescita del settore, aprendo nuove frontiere per la creazione e la fruizione di contenuti.
                <br><br>
                Connessioni Creative nasce per raccontare la collisione della pandemia di COVID-19 e le relative conseguenze con diverse discipline dell’Arte, nonché nei contesti sociali umani. Verranno fornite diverse chiavi di lettura sulla fruizione dell’Arte, come strumento di riflessione, espressione e percezione della realtà di ognuno di noi, in seguito all’avvento della pandemia. Nei contesti sociali il COVID-19 ha creato sì delle distanze, ma con il tempo l’essere umano, che non può rinunciare a esprimere e ad esprimersi, ha trovato delle soluzioni tuttora valide, senza prescindere dall’aiuto fondamentale delle nuove tecnologie.
                <br><br>
                Questo numero invita a riflettere, appunto, sulle "Connessioni Creative" che si sono sviluppate in risposta a una crisi globale come quella pandemica. Le trasformazioni culturali che abbiamo vissuto non sono solo risposte temporanee a una situazione di emergenza, ma rappresentano l'inizio di un nuovo modo di concepire l'Arte e la nostra relazione con essa. L'esperienza della pandemia ha messo in luce la capacità dell’Arte di evolversi e di trovare nuove strade per mantenere viva la nostra umanità condivisa.
                <br><br>
                Grazie alle analisi offerte dagli autori degli articoli, si evince che la creatività ha saputo adattarsi attraverso infinite possibilità. L'Arte, come sempre, rimane una testimonianza vibrante della nostra resilienza e della nostra capacità di trasformare le difficoltà in nuove opportunità di crescita e connessione.
                <br>
                Buona lettura.

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php
                    
                    $token = bin2hex(random_bytes(32));
                    $_SESSION['download_token'] = $token;
                    ?>
                    <div class="link-box">
                        <a href="download.php?file=andrea_cioci_1.pdf&token=<?php echo $token; ?>" class="link-download">
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
                    Andrea&nbsp&nbspCioci&nbsp&nbsp
                </p>
                <p>
                    Andrea&nbsp&nbspCioci&nbsp&nbsp
                </p>
            </div>
        </div>
    </footer>
</body>

</html>