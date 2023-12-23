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
    <link href="{{ asset('css/classEdit.css') }}" rel="stylesheet">
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
            <p id="backbutton_1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                        class="fa-solid fa-arrow-left"></i></button></p>
            <div class="row_1 row">

                <div class="listele col-sm">
                    <!-- arama barı -->
                    <div id="bar" style="margin-left:-0.5rem; width: 103%;" class="d-inline-flex p-2 bd-highlight">
                        <nav style="width: 100%; border-radius: 5px;" class="navbar navbar-light bg-light">
                            <form style="width: 100%;" class="form-inline">
                                <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                                    placeholder="&#x1F50E; Sınıfta Öğrenci Ara" aria-label="Ara">
                            </form>
                        </nav>
                    </div>

                    <div class="listele2">

                        @foreach ($data['students'] as $item)
                            <a id="satir" class="satir ogrenci-satiri"
                                href="{{ route('get-update-student-page', ['studentId' => $item->student_id]) }}">
                                <img class="ogrenci-satiri-gorseli" src="">
                                <div class="ogrenci-satiri-yazisi" for="name"> {{ $item->name }} </div>
                            </a>
                        @endforeach

                    </div>

                </div>

                <div class="col-sm">

                    <div id="secondbox" class="container">

                        <form id="yourFormId" action="{{ route('get-update-classroom') }}" method="POST">
                            @csrf
                            <input type="hidden" name="classroom_id" id="classroom_id"
                                value="{{ $data['classroom']->classroom_id }}">

                            <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-7"></div>
                            </div>
                                
                            <div id="sınıfrowu" class="row">
                                <div class="LABEL col-sm-4"><b>Sınıf Adı</b> </div>
                                <input type="text" name="classroom_name" id="classroom_name"
                                    value="{{ $data['classroom']->classroom_name }}" required
                                    placeholder="{{ $data['classroom']->classroom_name }}" class="INPUT col-sm-7">
                            </div>


                            <div id="kayıtdivi" class="row">
                                {{-- <div class="col-sm-1"></div> --}}
                                @csrf
                                <div class="col-sm-1"></div>

                                <div class="kayıt col-sm-4">
                                    <button type="submit" class="btn btn-light kayıt_design_2"><strong>
                                            Sınıfı Kaydet</strong></button>
                                </div>
                                <div class="col-sm-1"></div>

                                @csrf
                                <div class="kayıt col-sm-4">
                                    <button id="del" type="submit" class="btn btn-light kayıt_design_3"
                                        form="del">
                                        <strong>Sınıfı Sil</strong> </button>
                                </div>
                                <div class="col-sm-1"></div>

                            </div>
                        </form>
                    </div>
                </div>

                <form id="del"
                    action="{{ route('get-delete-classroom', ['classroomId' => $data['classroom']->classroom_id]) }}"
                    method="GET">
                    <div id="confirmationModal" class="modal_2">
                        <div class="modal-content_2">
                            <p>Sınıfı silmek istediğine emin misin?</p>
                            <button type="submit" id="confirmYes">Evet</button>
                            <button type="button" id="confirmNo"> Hayır</button>
                        </div>
                    </div>

                </form>


            </div>
        </div>
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
