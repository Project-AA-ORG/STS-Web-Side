<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ogrenci Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/ogrenci_duzenle_tasarım.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar_tasarım.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        body {
            overflow: hidden;
        }

        select[multiple] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            padding-right: 30px;
        }

        /* Style the selected options */
        select[multiple] option:checked {
            background-color: green;
            font-weight: bold;
            position: relative;
        }

        /* Add tick icon using CSS pseudo-element */
        select[multiple] option:checked::after {
            content: '\2713';
            /* Unicode for checkmark symbol */
            position: absolute;
            bottom: 7px;
            /* Adjust the position of the tick icon */
            color: black;
            /* Change color of the tick */
            font-weight: bold;
            /* Make the tick icon bold */
        }

        select.form-control {

            &[size],
            &[multiple] {
                height: 75px;
            }
        }

        .minibox_2 {
            -webkit-tap-highlight-color: transparent;
            /* For iOS */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .custom-select-1 {
            /* Add styles specific to the first select element */
            /* Example styles: */
            width: 100px;
            height: 120px;
            /* Add other styles */
        }
    </style>

</head>

<body>

    <div class="bg_ogrenci_duzenle">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div class="duzenle">

            <p><button style="color: black;" class="btn back-btn"><i class="fa-solid fa-arrow-left"></i></button></p>

            <div class="photo">
                <img src="{{ $data['student'] }}" alt="student">
            </div>

   

            <form id="yourFormId" action="{{ route('get-update-student') }}" method="POST">
                @csrf
                <div class="kayıt">

                    <button type="submit" class="btn btn-light kayıt_design"
                        style="background-color: #FF9595;"><strong>
                            Öğrenciyi Kaydet</strong></button>

                </div>

                <div class="Entrance">
                    <input type="hidden" name="student_id" id="student_id" value="{{ $data['student']->student_id }}">

                    <div class="block">
                        <label class="LABEL"><b>Ad Soyad</b> </label>
                        <input type="text" name="name" id="name" value="{{ $data['student']->name }}"
                            required placeholder="{{ $data['student']->name }}" class="INPUT">
                    </div>

                    <div class="block">
                        <label class="LABEL"><b>Sınıf</b></label>

                        <button style="margin-top:8px; border-radius: 6px; background-color: #F5F4F6; color: black;"
                            class="INPUT btn btn-secondary dropdown-toggle btn-sm sinif-dropdown" type="button"
                            id="sinifDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ isset($data['student']->classroom->classroom_name) ? $data['student']->classroom->classroom_name : 'Seçiniz' }}

                        </button>

                        <input type="hidden" name="classroom_id" id="classroom_id"            
                        value="{{ $data['student']->classroom_id }}">
                        <div class="dropdown-menu" aria-labelledby="dersDropdownButton">

                            @foreach ($data['classrooms'] as $item)
                                <a class="dropdown-item sinif-item" href="#"
                                    data-course-id="{{ $item->classroom_id }}"
                                    onclick="setSelectedClassroom('{{ $item->classroom_name }}', '{{ $item->classroom_id }}')">
                                    {{ $item->classroom_name }}
                                </a>
                            @endforeach

                        </div>

                    </div>

                    <div class="block">
                        <label class="LABEL"><b>Kullanıcı Adı</b></label>
                        <input type="text" name="username" id="username"
                            value="{{ $data['student']->username }}" required
                            placeholder="{{ $data['student']->username }}" class="INPUT">
                        
                    </div>

                </div>

            </form>

            <form id="del" action="{{ route('get-delete-student', ['studentId' => $data['student']->student_id]) }}"
                method="GET">

                @csrf
                <div class="kayıt">
                    <button type="submit" class="btn btn-light kayıt_design"
                        style="background-color: #FF9595;"><strong>
                            Öğrenciyi Sil</strong> </button>
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

    document.querySelector('.back-btn').addEventListener('click', function() {
        window.history.back();
    });
</script>

<script>

    document.querySelectorAll('.sinif-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let sinifDropdown = document.querySelector('.sinif-dropdown');
            sinifDropdown.textContent = selectedText;
        });
    });

</script>

</html>