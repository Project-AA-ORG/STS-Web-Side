<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogretmen Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/ogretmen_duzenle_tasarım.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar_tasarım.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>

<body>


    <div class="bg_ogretmen_duzenle">
        <div class="sidebar">
            <div class="top">
                <div class="logo">
                    <i class="bx bxl-codepen"></i>
                    <span></span>
                </div>
                <i class="fa-solid fa-bars" id="btn" style="color: black;"> </i>
            </div>

            <div class="user">
                <img src="/images/download.jpg" alt="senay" class="user-img" s>

                <div>
                    <p class="bold">Şenay Duran Okulları</p>
                </div>

            </div>
            <hr>

            <ul>
                <li>
                    <a href="#">
                        <i class='fas fa-chalkboard-teacher'></i>
                        <span class="nav-item">Öğretmenlerimiz</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='fas fa-book-reader'></i>
                        <span class="nav-item">Öğrencilerimiz</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-male-female'></i>
                        <span class="nav-item">Velilerimiz</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='fas fa-book-open'></i>
                        <span class="nav-item">Derslerimiz</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-item">Sınıflarımız</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span class="nav-item">Duyurularımız</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-calendar-event'></i>
                        <span class="nav-item">Etkinliklerimiz</span>
                    </a>
                </li>


            </ul>
        </div>



        <div class="duzenle">

            <p><button style="color: black;" class="btn back-btn"><i class="fa-solid fa-arrow-left"></i></button></p>

            <div class="photo">
                <img src="/images/image.jpg" alt="">
            </div>

            <div class="kayıt col-4">

                <button type="button" class="btn btn-light kayıt_design" style="background-color: #FF9595;"><strong>
                        Profili Kaydet</strong></button>
                <button type="button" class="btn btn-light kayıt_design" style="background-color: #FF9595;"><strong>
                        Profili Sil</strong> </button>

            </div>

            <div class="Entrance">
                <div>
                    <label class="LABEL"><b>Ad Soyad</b> </label>
                    <input type="text" placeholder="Giriniz" class="INPUT">
                </div>
                <div>
                    <label class="LABEL"><b>Ders</b></label>
                    <input type="text" placeholder="Giriniz" class="INPUT">
                </div>
                
                <div>
                <label class="LABEL"><b>Sınıflar</b></label>

                    <div style="display: inline-block;" class="dropdown">
                        <button
                            style="display: inline-block; text-align: center; border-radius: 8px; background-color: #F5F4F6; color: black; height: 75px; width: 329px; padding-right: 110px;"
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
                    <label class="LABEL"><b>Kullanıcı Adı</b></label>
                    <input type="text" placeholder="Giriniz" class="INPUT">
                </div>
                <div>
                    <label class="LABEL"><b>Telefon No</b></label>
                    <input type="text" placeholder="Giriniz" class="INPUT">
                </div>
            </div>

        </div>


    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin='anonymous'></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    btn.onclick = function () {
        sidebar.classList.toggle('active');
    };


    $('.back-btn').on('click', function () {
        window.history.back();
    });
</script>


</html>