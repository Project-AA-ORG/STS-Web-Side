<div class="bigbox">

    <form action="#">
        <a href="#" style="color: black;"><i class="fa-regular fa-circle-xmark" style="margin-left: 320px"></i></a>
        <br>
        <div>
            <label for="isim" style="border-radius: 8px;" class="childbox">Ad Soyad</label>
            <input type="text" id="isim" placeholder="Giriniz" class="childbox"">
        </div>
        <div>

        <label for=" Ders" class="childbox">Ders</label>
            <div style="display: inline;" class="dropdown">

                <button
                    style="display: inline-block; text-align: center; border-radius: 4px; background-color: #F5F4F6; padding: 24px; color: black; width: fit-content; height: 70px; width: 175px;"
                    class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seçiniz
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Türkçe</a>
                    <a class="dropdown-item" href="#">Matematik</a>
                    <a class="dropdown-item" href="#">Fen Bilgisi</a>
                </div>
            </div>
        </div>

        <div>
            <label for="Sınıf" class="childbox">Sınıf</label>
            <div style="display: inline;" class="dropdown">

                <button
                    style="display: inline-block; text-align: center; border-radius: 4px; background-color: #F5F4F6; padding: 24px; color: black; width: fit-content; height: 70px; width: 175px;"
                    class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Seçiniz
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    <a class="dropdown-item" href="#">4/A</a>
                    <a class="dropdown-item" href="#">5/A</a>
                    <a class="dropdown-item" href="#">6/A</a>
                </div>
            </div>
        </div>

        <div>
            <label for="kadı" class="childbox">Kullanıcı Adı</label>
            <input type="text" id="kadı" placeholder="Giriniz" class="childbox">
        </div>

        <div>
            <label for="tno" class="childbox">Telefon No</label>
            <input type="text" id="tno" placeholder="Giriniz" class="childbox">
        </div>
        <button type="button" class="btn btn-light" style="background-color: #FF9595; margin-left: 120px;">Öğretmeni
            Ekle</button>
    </form>
</div>