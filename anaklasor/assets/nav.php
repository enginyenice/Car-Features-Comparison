    <!-- Navbar START-->
 
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <a class="navbar-brand" href="index.php">Araç Karşılaştırma</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?=($dosya == 'index' || $dosya == '')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="index.php">Ana Sayfa</a>
                </li>
               
                <li class="nav-item <?=($dosya == 'marka-listesi' || $dosya == 'marka-duzenle' ||$dosya == 'marka-ekle')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="marka-listesi.php">Marka</a>
                </li>
                <li class="nav-item <?=($dosya == 'model-listesi' || $dosya == 'model-duzenle' ||$dosya == 'model-ekle')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="model-listesi.php">Model</a>
                </li>
                <li class="nav-item <?=($dosya == 'arac-listesi' || $dosya == 'arac-duzenle' ||$dosya == 'arac-ekle')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="arac-listesi.php">Araç</a>
                </li>
                <li class="nav-item <?=($dosya == 'karsilastir')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="karsilastir.php">Karşılaştır</a>
                </li>
                <li class="nav-item <?=($dosya == 'hesabim')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="hesabim.php">Hesabım</a>
                </li>

               
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a href="cikis-yap.php" class="btn btn-outline-danger my-2 my-sm-0">Çıkış Yap</a>
            </form>
        </div>
    </nav>
    <!-- Navbar END -->