<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Sinif Duzenle Ekranı</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/classes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/classEdit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/classAdd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        body,
        html {
            background-color: #C4C4C4;
            height: 100vh;
            margin: 0;
        }

        .siniflar {
            display: flexbox;
            align-items: center justify-content: space-between;
            position: relative;
            top: 6%;
            left: 35%;
            width: 40%;
            min-width: 300px;
            height: 90%;
            border-radius: 5px;
            border: 1px solid #000;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            background-color: #3b6653;
            overflow: auto;
        }

        .listele {
            display: inline-block;
            overflow: auto;
            background: #3b6653;
            width: 92%;
            margin-left: 4%;
            height: 55%;
        }

        .ogrenci-satiri-gorseli {
            min-width: 30px;
            min-height: 30px;
            width: 10%;
            /* Increase the width */
            height: 10%;
            border-radius: 5px;
            margin-left: 2%;
            margin-right: calc(2% - 1.33%);
            /* Adjusted margin to maintain spacing */
            border: 1px solid #898080;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            float: left;
            /* Set the element to float */
        }

        .ogrenci-satiri {
            align-items: center;
            text-align: center;
            display: block;
            border-radius: 5px;
            margin-top: 2%;
            margin-left: 2%;
            width: 96%;
            min-width: 255px;
            height: auto;
            background-color: white;
        }


        .ogrenci-satiri-yazisi {
            display: inline-block;
            margin-left: 3%;
            padding: 2%;
            align-items: center;
            border: 1px solid black;
            border-radius: 5px;
            width: 80%;
            height: 10%;
        }

        .satir:link,
        .satir:visited {
            background-color: white;
            color: black;
            border: 2px solid #5a906f;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
        }

        .satir:hover,
        .satir:active {
            background-color: #5a906f;
            color: white;
        }

        ::-webkit-scrollbar {
            width: 8px;
            /* Width of the scrollbar */
            border-radius: 5px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
            /* Color of the scrollbar handle */
            border-radius: 5px;
            /* Rounded corners */
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Color when hovering over scrollbar */
            border-radius: 5px;
        }

        /* For horizontal scrollbar */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Color of the scrollbar track */
            border-radius: 5px;
        }

        /* Handle */
        ::-webkit-scrollbar-track-piece:end {
            background: #ddd;
            /* Color of the space after the scrollbar handle */
            border-radius: 5px;
        }

        .close {
            color: black;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            overflow: hidden;
        }

        .error {
            color: red;
            font: bold;
        }

        #bk {
            margin-top: 0;
            margin-bottom: 0px;
        }
        #yourFormId{
            padding: 0;
            margin:0;
            display: inline;
        }
        #del{
            margin: 0;
            padding: 0;
            display: inline;
        }
        #totheleft{
            margin-left: 10%;
        }
    </style>
</head>

<body>

    @include('sidemenu')

    <div class="siniflar">
        <p id="bk"><button style="display:inline-block; color: black;" class="btn back-btn"><i
                    class="fa-solid fa-arrow-left"></i></button></p>

        <!-- arama barı -->
        <div style="margin-left:3.5%;  width: 94%;" class="d-inline-flex p-2 bd-highlight">
            <nav style="width: 100%; border-radius: 3px;" class="navbar navbar-light bg-light">
                <form style="width: 100%;" class="form-inline">
                    <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                        placeholder="&#x1F50E; Ara" aria-label="Ara">
                </form>
            </nav>
        </div>

        <div class="listele">

            @foreach ($data['students'] as $item)
                <a id="satir" class="satir ogrenci-satiri"
                    href="{{ route('get-update-student-page', ['studentId' => $item->student_id]) }}">
                    <img class="ogrenci-satiri-gorseli" src="" alt="student">
                    <div class="ogrenci-satiri-yazisi" for="name"> {{ $item->name }} </div>
                </a>
            @endforeach

        </div>
        <form id="yourFormId" action="{{ route('get-update-classroom') }}" method="POST">
            @csrf
            <input type="hidden" name="classroom_id" id="classroom_id" value="{{ $data['classroom']->classroom_id }}">

            <div class="block">
                <label class="LABEL"><b>Sınıf Adı</b> </label>
                <input type="text" name="classroom_name" id="classroom_name"
                    value="{{ $data['classroom']->classroom_name }}" required
                    placeholder="{{ $data['classroom']->classroom_name }}" class="INPUT">
            </div>



            <div id="totheleft" class="kayıt">

                <button type="submit" class="btn btn-light kayıt_design" style="background-color: #FF9595;"><strong>
                        Sınıfı Kaydet</strong></button>

            </div>
        </form>

        <form id="del" action="{{ route('get-delete-classroom', ['classroomId' => $data['classroom']->classroom_id]) }}"
            method="GET">

            @csrf
            <div class="kayıt">
                <button type="submit" class="btn btn-light kayıt_design" style="background-color: #FF9595;"><strong>
                        Sınıfı Sil</strong> </button>
            </div>
        </form>


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
