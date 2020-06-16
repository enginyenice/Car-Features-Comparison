<?php include("./assets/session.php"); ?>
<!doctype html>
<html lang="tr">
<title>Arac Ekle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");




?>

<body class="">


<?php include("./assets/alert.php"); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Arac Ekle
            </div>
            <div class="card-body">
                <form action="./controller/Arac.php" class="mt-2" method="POST" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col col-md-4 form-group">
                            <label>Resim:</label>
                            <div class="custom-file">
                                <input type="file" name="resim" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Resim Seç</label>
                            </div>
                        </div>
                        <div class="col col-md-4 form-group">
                            <label>Marka:</label>
                            <div class="form-group">
                                <?php
                                $markaSor = $db->prepare("SELECT * FROM  marka");
                                $markaSor->execute();
                                ?>
                                <select onchange="modelGetir()" id="marka" name="marka_id" class="form-control">

                                    <?php while ($markaCek = $markaSor->fetch(PDO::FETCH_ASSOC)) { ?> ?>
                                        <option value="<?= $markaCek['id'] ?>"><?= $markaCek['marka'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-4 form-group">
                            <label>Model :</label>
                            <select id="model" name="model_id" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3 form-group">
                            <label>Yıl:</label>
                            <div class="form-group">
                                <input class="form-control" value="2020" type="number" name="yil" min=1990 max=2020 id="">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Ağırlık (Ton):</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="1.0" name="agirlik" step=0.1 min=0 max=100 id="">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Motor Hacmi (HP):</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="1" name="motorHacmi" min=0 max=100 id="">
                            </div>
                        </div>

                        <div class="col col-md-3 form-group">
                            <label>Teker Sayısı:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="1" name="tekerSayisi" min=0 max=20 id="">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col col-md-3 form-group">
                            <label>Max Hız:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="1" name="maxHiz" min=0 max=500 id="">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Vites:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="1" name="vites" min=0 max=10 id="">
                            </div>
                        </div>

                        <div class="col col-md-3 form-group">
                            <label>Renk:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="renk"value="Mavi" placeholder="Beyaz">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Yakıt Türü:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="yakitTuru" value="Dizel" placeholder="Benzin">
                            </div>
                        </div>
                    </div>


                    <div class="text-right buttons">
                        <input type="hidden" name="AracEkle">
                        <button class="btn btn-sm btn-primary">Ekle</button>
                        <a href="arac-listesi.php" class="btn btn-sm btn-danger">Geri</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>

    <script>
        modelGetir();

        function modelGetir() {
            var x = document.getElementById("marka").value;
            $('#model').empty();
            PostData = {
                "id": x,
                "modelGetirPost": true
            }

            $.ajax({
                type: "POST",
                url: "./controller/Arac.php",
                data: PostData,
                success: function(data) {
                    var veri = JSON.parse(data);
                    veri.forEach(element => {
                        var option = document.createElement("option");
                        $('#model')
                            .append(`<option value="${element['id']}">${element['model']}</option>`);

                    });
                }



            });
        }
    </script>

</body>

</html>