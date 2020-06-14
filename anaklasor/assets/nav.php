    <!-- Navbar START-->
 
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <a class="navbar-brand" href="#">Araç Karşılaştırma</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?=($dosya == 'index' || $dosya == '')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="index.php">Ana Sayfa</a>
                </li>
                <li class="nav-item <?=($dosya == 'arac-listesi')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="arac-listesi.php">Araç Listesi</a>
                </li>
                <li class="nav-item <?=($dosya == 'marka-listesi')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="marka-listesi.php">Marka Listesi</a>
                </li>
                <li class="nav-item <?=($dosya == 'model-listesi')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="model-listesi.php">Model Listesi</a>
                </li>
                <li class="nav-item <?=($dosya == 'hesabim')? "active font-weight-bold" : "" ?>">
                    <a class="nav-link" href="hesabim.php">Hesabım</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a href="cikis-yap.php" class="btn btn-outline-danger my-2 my-sm-0">Çıkış Yap</a>
            </form>
        </div>
    </nav>
    <!-- Navbar END -->