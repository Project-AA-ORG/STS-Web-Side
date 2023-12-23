<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ogrenci Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/studentEdit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">


</head>

<body>

    <div class="centerEdit">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div id="mainbox" class="duzenle container">
            <form id="yourFormId" action="{{ route('get-update-student') }}" method="POST">

                <p id="backbutton_1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                            class="fa-solid fa-arrow-left"></i></button></p>
                <div class="row row_1">
                    <div class="col-md-4">

                        <div class="photo">
                            <img src="{{ $data['student'] }}">
                        </div>


                        <div class="kayıt_divi">
                            @csrf
                            <div class="kayıt">

                                <button type="submit" class="btn btn-light kayıt_design_1"><strong>
                                        Öğrenciyi Kaydet</strong></button>

                            </div>

                            @csrf
                            <div class="kayıt">
                                <button id="del" type="submit" class="btn btn-light kayıt_design_2"
                                    form="del"><strong>
                                        Öğrenciyi Sil</strong></button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">

                        <div id="secondbox" class="container Entrance">
                            <input type="hidden" name="student_id" id="student_id"
                                value="{{ $data['student']->student_id }}">

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Ad Soyad</b> </div>
                                <input type="text" name="name" id="name" value="{{ $data['student']->name }}"
                                    required placeholder="{{ $data['student']->name }}" class="INPUT col-sm-7">
                            </div>


                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Sınıf</b></div>

                                <button style="font-size:16px; background-color: #F5F4F6; color: black;"
                                    class="btn btn-secondary dropdown-toggle btn-sm sinif-dropdown INPUT col-sm-7"
                                    type="button" id="sinifDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
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


                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Kullanıcı Adı</b></div>
                                <input type="text" name="username" id="username"
                                    value="{{ $data['student']->username }}" required
                                    placeholder="{{ $data['student']->username }}" class="INPUT col-sm-7">

                            </div>

                            <div id="kayıtdivi2" class="kayıt_divi_2 row">
                                @csrf
                                <div class="kayıt">

                                    <button type="submit" class="btn btn-light kayıt_design_1"><strong>
                                            Öğrenciyi Kaydet</strong></button>

                                </div>

                                @csrf
                                <div class="kayıt">
                                    <button id="del" type="submit" class="btn btn-light kayıt_design_3"
                                        form="del"><strong>
                                            Öğrenciyi Sil</strong></button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </form>
        </div>

        <form id="del" action="{{ route('get-delete-student', ['studentId' => $data['student']->student_id]) }}"
            method="GET">
            <div id="confirmationModal" class="modal_2">
                <div class="modal-content_2">
                    <p>Öğrenciyi silmek istediğine emin misin?</p>
                    <button type="submit" id="confirmYes">Evet</button>
                    <button type="button" id="confirmNo"> Hayır</button>
                </div>
            </div>
        </form>



    </div>


    <script>
        // Function to display the modal
        function displayModalForDeletion() {
            const modal = document.getElementById('confirmationModal');
            modal.style.display = 'block';

            // Handle 'Yes' button click
            document.getElementById('confirmYes').addEventListener('click', function() {
                document.getElementById('del').submit();
                modal.style.display = 'none'; // Hide the modal after submission
            });

            // Handle 'No' button click
            document.getElementById('confirmNo').addEventListener('click', function() {
                modal.style.display = 'none'; // Hide the modal on 'No' click
            });
        }

        // Listen for click on kayıt_design_2 button
        document.querySelector('.kayıt_design_2').addEventListener('click', function(event) {
            event.preventDefault();

            // Show the confirmation modal for deletion
            displayModalForDeletion();
        });
        document.querySelector('.kayıt_design_3').addEventListener('click', function(event) {
            event.preventDefault();

            // Show the confirmation modal for deletion
            displayModalForDeletion();
        });
    </script>
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
  document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('btn');
        const toClick = document.getElementById('toclick');
        const sidebar = document.getElementById('sidebar');

        btn.addEventListener('click', function(event) {
            if (sidebar) {
                sidebar.classList.toggle('active');
            } else {
                console.error("Sidebar element not found");
            }
            event.preventDefault();
        });

        toClick.addEventListener('click', function(event) {
            window.history.back();
            event.preventDefault();
        });
    });
</script>

<script>
    function setSelectedClassroom(selected, id) {
        console.log('Selected classroom:', selected);
        console.log('Classroom ID:', id);
        document.getElementById('classroom_id').value = id;
    }
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
