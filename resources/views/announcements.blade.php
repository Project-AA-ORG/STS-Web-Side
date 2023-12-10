<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Duyurularımız</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/announcements.css') }}" rel="stylesheet">
    <link href="{{ asset('css/announcementAdd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            overflow: hidden;
        }

        .error {
            color: red;
            font: bold;
        }

        select[multiple] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            padding-right: 30px;
        }

        select.form-control {

            &[size],
            &[multiple] {
                height: 70px;
            }
        }

        /* Style the selected options */
        select[multiple] option:checked {
            background-color: #c0e5fa;
            font-weight: bold;
            position: relative;
        }

        /* Add tick icon using CSS pseudo-element */
        select[multiple] option:checked::after {
            content: '\2713';
            /* Unicode for checkmark symbol */
            position: absolute;
            right: 5px;
            /* Adjust the position of the tick icon */
            color: black;
            /* Change color of the tick */
            font-weight: bold;
            /* Make the tick icon bold */
        }
        p{
            margin: 0;
        }
    </style>
</head>

<body>

    @include('sidemenu')

    <!-- ekranın ortasındaki dikdortgen -->
    <div class="duyurular">

        <!-- arama barı -->
        <div style="margin-left:3.5%;  width: 94%;" class="d-inline-flex p-2 bd-highlight">
            <nav style="width: 100%; border-radius: 3px;" class="navbar navbar-light bg-light">
                <form style="width: 100%;" class="form-inline">
                    <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                        placeholder="&#x1F50E; Ara" aria-label="Ara">
                </form>
            </nav>
        </div>

        <!-- listeleneceği ve scroll bar oluşturacak olan div -->
        <div class="listele">

            {{-- @foreach ($data['duyurular'] as $item)
                <a id="satir" class="satir duyuru-satiri"
                    href="{{ route('get-update-announcements-page', ['announcementId' => $item->general_announcement_id]) }}">
                    <div class="duyuru-satiri-yazisi" for="name"> {{ $item->announcement_title }}</div>
                </a>
            @endforeach --}}

            <a id="satir" class="satir duyuru-satiri" href="#">
                <div class="duyuru-satiri-yazisi" for="name"><p>Okulumuza Yeni Matematik Öğretmeni atandı</p></div>
            </a>
            <a id="satir" class="satir duyuru-satiri" href="#">
                <div class="duyuru-satiri-yazisi" for="name">Okulumuza Yeni Türkçe Öğretmeni atandı</div>
            </a>
            <a id="satir" class="satir duyuru-satiri" href="#">
                <div class="duyuru-satiri-yazisi" for="name">09.12.2023 tarihinde deprem tatbikatı</div>
            </a>
            <a id="satir" class="satir duyuru-satiri" href="#">
                <div class="duyuru-satiri-yazisi" for="name">İlber Ortaylı ziyareti</div>
            </a>
            <a id="satir" class="satir duyuru-satiri" href="#">
                <div class="duyuru-satiri-yazisi" for="name"><p style="">CARTRUCRQWSMQWEMLQWMELQMWELQMWELMQWLMQWLMELQMWLEMQWMELQWMLEQMLWEMLQWMELQWE</p></div>
            </a>

        </div>

        <!-- Trigger/Open The Modal -->
        <button class="btn btn-light"
            style="display:inline; margin-left: 42%; margin-top: 1%; background-color: #E8D5B9;" id="myBtn">
            Duyuru Ekle</button>

        <div id="myModal" class="modal">
            <div class="modal-content">

                <div class="bigbox">

                    <div class="modal-header">
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        {{-- {{ route('get-add-new-announcement') }} --}}
                        <form id="yourFormId" action="" method="POST">
                            @csrf

                            <div style="display: inline-block; margin-left: 4.5%;">
                                <label for="isim"class="childbox" style="border-radius: 8px;">Duyuru Başlığı</label>
                                <input type="text" id="announcement_title" name="announcement_title" required placeholder="giriniz"
                                    class="childbox">
                            </div>


                            <div style="display: inline-block; margin-left: 4.5%;">
                                <textarea style="resize: none;" id="announcement_content" name="announcement_content" 
                                required placeholder="Duyuru içeriğini giriniz" class="icerikbox" ></textarea>
                            </div>
                            




                            <button type="reset" class="btn btn-light"
                                style="background-color: #FF9595; margin-left: 70px;"
                                onclick="resetDropdowns()">Temizle</button>


                            <button type="submit" class="btn btn-light"
                                style="background-color: #FF9595; margin-left: 80px;">Tamamla</button>
                        </form>
         

                    </div>

                </div>

            </div>

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
    // First Script for Modal
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Second Script for Sidebar
    let sidebar = document.querySelector('.sidebar');
    let searchInput = document.getElementById('searchInput');

    document.getElementById('btn').addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    document.querySelector('.back-btn').addEventListener('click', function() {
        // Add functionality for the back button if it's missing
    });
</script>

<script>
    searchInput.addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const elements = document.querySelectorAll('.listele a');

        elements.forEach(function(element) {
            const text = element.textContent.toLowerCase();
            if (text.includes(searchQuery)) {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        });
    });
</script>


</html>
