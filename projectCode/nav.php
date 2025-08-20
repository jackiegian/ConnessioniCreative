<nav class="navbar">
    <div class="nav-box">
        <a href="index.php"><img class="logo" src="img/FAV/LOGO_EDITORIA.png" alt="logo_connessioni_creative"></a>
    </div>
    <div class="nav-box">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="about.php" class="nav-link">Storia</a>
                <div class="dropdown">
                    <div class="dropdown-content">
                        Rivista scientifica semestrale sul tema “PRODUZIONE E FRUIZIONE DELL'ARTE NEL PERIODO PRE E POST COVID-19”.
                        <br><br>
                        L’obiettivo è quel di rielaborare gli effetti della pandemia sugli individui e le comunità tramite un’interiorizzazione consapevole.
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Archivio</a>
                <div class="dropdown">
                    <div class="dropdown-content">
                        <?php
                        getMagazine();
                        ?>
                    </div>
                </div>
                <div id="new-dropdown">
                    <div class="dropdown-content">
                        <?php
                        getArticles();
                        ?>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">News</a>
                <div class="dropdown">
                    <div class="dropdown-content" id="content-news">
                        <div class="sub-content-news">
                            IN ARRIVO
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contatti</a>
                <div class="dropdown">
                    <div class="dropdown-content">
                        <div class="sub-content-contact">
                            <i>ente</i> <br>
                            UNIUD <br>
                            LABORATORIO DI EDITORIA DIGITALE
                        </div>
                        <br><br>
                        <div class="content-contact">
                            <div class="sub-content-contact">
                                Università <br>
                                degli Studi di Udine <br><br>
                                via Palladio 8 <br>
                                33100 Udine (UD)
                            </div>
                            <br>
                            <div class="sub-content-contact">
                                <u>tel +39 0432 556111 </u> <br>
                                <u>fax +39 0432 507715</u> <br><br>
                                p.iva 01071600306 <br>
                                c.f. 80014550307
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="nav-box" id="profile-box">
        <a href="ok.php"><i class="material-symbols-rounded" id="profile-img">person</i></a>
    </div>
</nav>