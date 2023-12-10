<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ogretmenlerimiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/teacherEdit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/teachers.css') }}" rel="stylesheet">
    <link href="{{ asset('css/teacherAdd.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
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

        .error {
            color: red;
            font: bold;
        }
    </style>
</head>

<body>

    @include('sidemenu')

    <!-- ekranın ortasındaki dikdortgen -->
    <div class="ogretmenler">

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

            @foreach ($data['teachers'] as $item)
                <a id="{{ $item->teacher_id }}" class="satir ogretmen-satiri"
                    href="{{ route('get-update-teacher-page', ['teacherId' => $item->teacher_id]) }}">
                    <img class="ogretmen-satiri-gorseli" src="{{ $item->teacher_image }}" alt="teacher">
                    <div class="ogretmen-satiri-yazisi" for="name"> {{ $item->name }} </div>
                </a>
            @endforeach

        </div>
        <!-- Trigger/Open The Modal -->
        <button class="btn btn-light"
            style="display:inline; margin-left: 37%; margin-top: 2px; background-color: #E8D5B9;"
            id="myBtn">Öğretmen
            Ekle</button>

        <div id="myModal" class="modal">
            <div class="modal-content">

                <div class="bigbox">

                    <div class="modal-header">
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body">

                        <form id="yourFormId" action="{{ route('get-add-new-teacher') }}" method="POST">
                            @csrf
                            <div style="display: inline-block; margin-left: 4.5%;">
                                <label for="isim" class="childbox">Ad Soyad</label>
                                <input type="text" id="name" name="name" required placeholder="giriniz"
                                    class="childbox">
                            </div>


                            <div style="display: inline-block; margin-left: 4.5%;">

                                <label for="Sınıf" class="childbox">Sınıf</label>

                                <select multiple name="classroom_id[]" id="classroom_id"
                                    class="childbox_2 form-control custom-select">
                                    @foreach ($data['classroom'] as $item)
                                        <option value="{{ $item->classroom_id }}">{{ $item->classroom_name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <!-- For 'Ders' dropdown -->
                            <div style="display: inline-block; margin-left: 4.5%;">
                                <label for="Ders" class="childbox">Ders</label>
                                <div style="display: inline;" class="dropdown">
                                    <button
                                        style="border: solid white 1px; display: inline-block; text-align: center; border-radius: 4px; 
                                        background-color: #F5F4F6; padding: 24px; color: black; width: fit-content; height: 70px; width: 175px;"
                                        class="btn btn-secondary dropdown-toggle btn-sm ders-dropdown" type="button"
                                        id="dersDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Seçiniz
                                    </button>

                                    <input type="hidden" name="course_id" id="course_id" value="Seçiniz">
                                    <div class="dropdown-menu" aria-labelledby="dersDropdownButton">

                                        @foreach ($data['course'] as $item)
                                            <a class="dropdown-item ders-item" href="#"
                                                data-course-id="{{ $item->course_id }}"
                                                onclick="setSelectedcourse('{{ $item->course_name }}', '{{ $item->course_id }}')">
                                                {{ $item->course_name }}
                                            </a>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div id="overlayError_1"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
                                <div
                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                                    Lütfen bir ders seçiniz.
                                </div>
                            </div>
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
                            <div style="display: inline-block; margin-left: 4.5%;">
                                <label for="kadı" class="childbox">Kullanıcı Adı</label>
                                <input type="text" id="username" name="username" required placeholder="giriniz"
                                    class="childbox">
                            </div>

                            <div style="display: inline-block; margin-left: 4.5%;">
                                <label for="tno" class="childbox">Telefon No</label>
                                <input type="tel" id="phone" name="phone" required placeholder="giriniz"
                                    class="childbox">
                            </div>

                            <button type="reset" class="btn btn-light"
                                style="background-color: #FF9595; margin-left: 70px;"
                                onclick="resetDropdowns()">Temizle</button>


                            <button type="submit" class="btn btn-light"
                                style="background-color: #FF9595; margin-left: 80px;">Tamamla</button>

                            @if (isset($data['error']))
                                <p class="error">{{ $data['error'] }}</p>
                            @endif

                        </form>
                    </div>

                </div>
            </div>

        </div>
        @if (isset($data['error']))
            <p class="error">Kullanıcı adı daha önceden de kullanıldığı için öğretmen kaydedilemedi.</p>
        @endif
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

<script>
    document.querySelectorAll('.ders-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let dersDropdown = document.querySelector('.ders-dropdown');
            dersDropdown.textContent = selectedText;
        });
    });

    function printSelectedClassroom(selected, id) {
        console.log('Selected classroom:', selected);
        console.log('Classroom ID:', id);
    }

    function setSelectedcourse(selected, id) {
        console.log('Selected course:', selected);
        console.log('Course ID:', id);
        document.getElementById('course_id').value = id;
    }

    function resetDropdowns() {
        // document.querySelector('.sinif-dropdown').textContent = 'Seçiniz';
        // document.getElementById('classroom_id').value = '';
        document.querySelector('.ders-dropdown').textContent = 'Seçiniz';
        document.getElementById('course_id').value = '';
    }
</script>

<script>
    $(document).ready(function() {
        $('#classroom_id').change(function() {
            $(this).find('option:selected').toggleClass('selected');
        });
    });
</script>

<script>
    document.getElementById('yourFormId').addEventListener('submit', function(event) {
        var selectedValue = document.getElementById('course_id').value;

        if (selectedValue === 'Seçiniz') {
            event.preventDefault(); // Prevent form submission

            // Show overlay error message
            document.getElementById('overlayError_1').style.display = 'block';

            // Hide overlay error message after 3 seconds (adjust as needed)
            setTimeout(function() {
                document.getElementById('overlayError_1').style.display = 'none';
            }, 3000);
        }
        var selectedOptions = document.getElementById('classroom_id').selectedOptions;

        if (selectedOptions.length === 0) {
            event.preventDefault(); // Prevent form submission

            // Show overlay message for select element
            document.getElementById('overlayError_2').style.display = 'block';

            // Hide overlay message after 3 seconds (adjust as needed)
            setTimeout(function() {
                document.getElementById('overlayError_2').style.display = 'none';
            }, 3000);
        }
    });
</script>

<script>
    document.getElementById('phone').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
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
