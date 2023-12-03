<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ogretmen Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/ogretmen_duzenle_tasarım.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar_tasarım.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        body {
            overflow: hidden;
        }
    </style>

</head>

<body>

    <div class="bg_ogretmen_duzenle">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div class="duzenle">

            <p><button style="color: black;" class="btn back-btn"><i class="fa-solid fa-arrow-left"></i></button></p>

            <div class="photo">
                <img src="/images/image.jpg" alt="">
            </div>

            <form action="" method="POST">
                @csrf
                <div class="kayıt col-4">

                    <button type="submit" class="btn btn-light kayıt_design"
                        style="background-color: #FF9595;"><strong>
                            Profili Kaydet</strong></button>
                    <button type="reset" class="btn btn-light kayıt_design"
                        style="background-color: #FF9595;"><strong>
                            Profili Sil</strong> </button>

                </div>

                {{-- Where input will be entered --}}
                <div class="Entrance container-sm">

                    <div class="block">
                        <label class="LABEL"><b>Ad Soyad</b> </label>
                        <input type="text" name="name" id="name" required placeholder="Giriniz"
                            class="INPUT">
                    </div>

                    <div class="block">
                        <label class="LABEL"><b>Sınıflar</b></label>
                        <input type="hidden" name="classroom_id" id="classroom_id">
                        <div class="INPUT_2">

                            @foreach ($data['classroom'] as $item)
                                <a class="minibox sinif-item" href="#"
                                    data-classroom-id="{{ $item->classroom_id }}">
                                    {{ $item->classroom_name }}
                                </a>
                            @endforeach 
    
                        </div>
                    </div>

                    <div class="block">
                        <label class="LABEL"><b>Ders</b></label>
                        <div style="display: inline-block;" class="dropdown" class="INPUT">
                            <button
                                style="display: inline-block; text-align: center; border-radius: 8px; 
                                background-color: #F5F4F6; color: black; height: 75px; width: 329px; padding-right: 110px;"
                                class="btn btn-secondary dropdown-toggle btn-sm ders-dropdown" type="button"
                                id="dersDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Seçiniz
                            </button>

                            <input type="hidden" name="course_id" id="course_id">
                            <div class="dropdown-menu" aria-labelledby="dersDropdownButton">

                                <a class="dropdown-item ders-item" href="#">Mat</a>
                                <a class="dropdown-item ders-item" href="#">Fen</a>
                                <a class="dropdown-item ders-item" href="#">din</a>

                            </div>
                        </div>
                    </div>

                    <div class="block">
                        <label class="LABEL"><b>Kullanıcı Adı</b></label>
                        <input type="text" name="username" id="username" required placeholder="Giriniz"
                            class="INPUT">
                    </div>
                    <div class="block">
                        <label class="LABEL"><b>Telefon No</b></label>
                        <input type="number" name="phone" id="phone" required placeholder="Giriniz"
                            class="INPUT">
                    </div>

                </div>
            </form>

        </div>

    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin='anonymous'></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

<script>
    let sidebar = document.querySelector('.sidebar');
    let searchInput = document.getElementById('searchInput');

    document.getElementById('btn').addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // document.querySelector('.back-btn').addEventListener('click', function() {
    //     // Add functionality for the back button if it's missing
    // });
</script>


<script>
    document.querySelectorAll('.ders-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let selectedId = this.dataset.course_id; // Add dataset attribute to hold ID
            let dersDropdown = document.querySelector('.ders-dropdown');
            dersDropdown.textContent = selectedText;
            document.getElementById('course_id').value = selectedId; // Set the selected ID
        });
    });

    function setSelectedcourse(selected, id) {
        document.getElementById('course_id').value = id;
    }
</script>


</html>
