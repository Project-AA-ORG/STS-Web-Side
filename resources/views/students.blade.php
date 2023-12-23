<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ogrencilerimiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/students.css') }}" rel="stylesheet">
    <link href="{{ asset('css/studentAdd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        #bar2 {
            width: 10rem;
            height: 4rem;
        }

        .rowlar {}

        .dropdown-menu {
            max-height: 7rem;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div class="center">

        @include('sidemenu')

        {{-- Outside div in body to contain everything --}}
        <div class="ogrenciler" id="fullHeightDiv">

            <div class="listele">

                <!-- arama barı -->
                <div id="bar" style="width: 100%;" class="d-inline-flex p-2 bd-highlight">
                    <nav style="width: 100%; border-radius: 5px;" class="navbar navbar-light bg-light">
                        <form style="width: 100%;" class="form-inline">
                            <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                                placeholder="&#x1F50E; Öğrenci Ara" aria-label="Ara">
                        </form>
                    </nav>
                </div>

                <!-- listeleneceği ve scroll bar oluşturacak olan div -->
                <div class="listele2">

                    @foreach ($data['students'] as $item)
                        <a id="satir" class="satir ogrenci-satiri"
                            href="{{ route('get-update-student-page', ['studentId' => $item->student_id]) }}">
                            <img class="ogrenci-satiri-gorseli" src="{{ $item->ogrenci }}">
                            <div class="ogrenci-satiri-yazisi" for="name"> {{ $item->name }} </div>
                        </a>
                    @endforeach

                </div>
                <!-- Trigger/Open The Modal -->
                <div class="buttondiv_1">
                    <button class="btn btn-light" id="myBtn" style="background-color: #E8D5B9;">Öğrenci
                        Ekle</button>
                </div>
            </div>


            <div id="myModal" class="modal">
                <div class="modal-content">

                    <div class="bigbox">

                        <div class="modal-header">
                            <span class="close">&times;</span>
                        </div>
                        <div class="modal-body">

                            <form id="yourFormId" action="{{ route('get-add-new-student') }}" method="POST">
                                @csrf

                                <div class="container">
                                    {{-- so everything is centered correctly --}}
                                    <div class="centeritems">

                                        {{-- grid structure to make it look better --}}
                                        {{-- first input name --}}
                                        <div class="row">
                                            <div class="childbox col-sm">Ad Soyad</div>
                                            <input type="text" id="name" name="name" required
                                                placeholder="giriniz" class="childbox col-sm">
                                        </div>




                                        {{-- SINIF DROPDOWN --}}
                                        <div class="row">

                                            <div class="childbox col-sm">Sınıf</div>
                                            <div class="dropdown">
                                                <button
                                                    style="overflow:auto; background-color: #F5F4F6; padding: 24px; color: black;"
                                                    class="col-sm DERSDROP btn btn-secondary dropdown-toggle btn-sm sinif-dropdown"
                                                    type="button" id="sinifDropdownButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Seçiniz
                                                </button>

                                                <input type="hidden" name="classroom_id" id="classroom_id"
                                                    value="Seçiniz">
                                                <div class="dropdown-menu" aria-labelledby="sinifDropdownButton">

                                                    @foreach ($data['classrooms'] as $item)
                                                        <a class="dropdown-item sinif-item" href="#"
                                                            data-classroom-id="{{ $item->classroom_id }}"
                                                            onclick="setSelectedClassroom('{{ $item->classroom_name }}', '{{ $item->classroom_id }}')">
                                                            {{ $item->classroom_name }}
                                                        </a>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                        {{-- username input --}}
                                        <div class="row">
                                            <div class="col-sm childbox">Kullanıcı Adı</div>
                                            <input type="text" id="username" name="username" required
                                                placeholder="giriniz" class="col-sm childbox ">
                                        </div>

                                    </div>
                                    {{-- buttons in overlay --}}
                                    <div class="buttondiv">
                                        <button type="reset" class="btn btn-light"
                                            style="background-color: #FF9595;"
                                            onclick="resetDropdowns()">Temizle</button>


                                        <button type="submit" class="btn btn-light"
                                            style="background-color: #FF9595;">Tamamla</button>
                                    </div>
                                </div>
                            </form>
                            <div id="overlayError_2"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
                                <div
                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                                    Lütfen bir sınıf seçiniz.
                                </div>
                            </div>
                            <div id="overlayError_3"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
                                <div
                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                                    Bu username daha önce kullanıldı.
                                </div>
                            </div>
    
                        </div>

                    </div>

                </div>

            </div>
            @if (isset($data['error']))
            <div id="overlayError"
                style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px; z-index: 1000;">
                Kullanıcı adı daha önceden de kullanıldığı için öğrenci kaydedilemedi.
            </div>
        @endif
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
</script>

<script>
    let searchInput = document.getElementById('searchInput');

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessage = document.getElementById('overlayError');

        // Check if the error message exists and has content
        if (errorMessage && errorMessage.innerText.trim().length > 0) {
            errorMessage.style.display = 'block';

            // Hide overlay error message after 3 seconds (adjust as needed)
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000);
        }
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

    function setSelectedClassroom(selected, id) {
        console.log('Selected classroom:', selected);
        console.log('Classroom ID:', id);
        document.getElementById('classroom_id').value = id;
    }

    function resetDropdowns() {
        document.querySelector('.sinif-dropdown').textContent = 'Seçiniz';
        document.getElementById('classroom_id').value = '';
    }
</script>

<script>
    document.getElementById('yourFormId').addEventListener('submit', function(event) {

        var selectedValue = document.getElementById('classroom_id').value;

        if (selectedValue == "Seçiniz") {
            event.preventDefault(); // Prevent form submission

            // Show overlay message for select element
            document.getElementById('overlayError_2').style.display = 'block';

            // Hide overlay message after 3 seconds (adjust as needed)
            setTimeout(function() {
                document.getElementById('overlayError_2').style.display = 'none';
            }, 2000);
        }
    });
</script>


<script>
    // Here you might have your error logic, for example:
    var errorMessage = document.querySelector('.error');
    if (errorMessage && errorMessage.innerText === "Bu username daha önce kullanıldı") {
        event.preventDefault(); // Prevent form submission
        document.getElementById('overlayError_3').style.display = 'block';
        // Overlay stays open because of the error
    } else {
        // Overlay closes as there's no error
        document.getElementById('myModal').style.display = 'none';
    }
</script>

</html>
