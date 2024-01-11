<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Sinif Duzenle Ekranı</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/classEdit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
 
    </style>

</head>

<body>
    <div class="centerEdit">

        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div id="mainbox" class="edit container">
            <p id="backbutton1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                        class="fa-solid fa-arrow-left"></i></button></p>




            <div class="row1 row">

                <div class="col-md-12">
                    <div id="secondbox" class="container">

                        <form id="yourFormId" action="{{ route('get-update-classroom') }}" method="POST">
                            @csrf

                            <input type="hidden" name="classroom_id" id="classroom_id"
                                value="{{ $data['classroom']->classroom_id }}">

                            <div id="row2" class="row">
                                <div id="before" class="col-sm-2">

                                    <div class="reg">
                                        <button type="submit" class="btn btn-light regdesign2"><strong>
                                                Sınıfı Kaydet</strong></button>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="classroom_name" id="classroom_name"
                                        value="{{ $data['classroom']->classroom_name }}" required
                                        placeholder="{{ $data['classroom']->classroom_name }}" class="INPUT" maxlength="50">
                                </div>
                                <div id="after" class="col-sm-2">

                                    <div class="reg">
                                        <button type="submit" class="btn btn-light regdesign2"><strong>
                                                Sınıfı Kaydet</strong></button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="reg">
                                        <button id="del" type="submit" class="btn btn-light regdesign3"
                                            form="del">
                                            <strong>Sınıfı Sil</strong> </button>
                                    </div>
                                </div>
                            </div>

                            <hr id="actualline">

                            <div class="row INPUT2">

                                @php
                                    $locale = 'tr'; // Set the locale to Turkish (change it based on your needs)
                                    $sortedStudents = $data['students']->sort(function ($a, $b) use ($locale) {
                                        return strcmp(
                                            utf8_encode(
                                                Str::of($a->name)
                                                    ->lower()
                                                    ->slug('-'),
                                            ),
                                            utf8_encode(
                                                Str::of($b->name)
                                                    ->lower()
                                                    ->slug('-'),
                                            ),
                                        );
                                    });
                                @endphp
                                @foreach ($sortedStudents as $item)
                                    <a href="{{ route('get-update-student-page', ['studentId' => $item->student_id]) }}"
                                        class="card">
                                        <img class="card-img-top student-img" src="data:image/jpeg;base64,{{ $item->student_image }}" alt="">
                                        <div class="card-body">
                                            {{ $item->name }}
                                        </div>
                                    </a>
                                @endforeach

                            </div>

                            {{-- <div id="regdiv" class="row">
                                <div class="col-md-1"></div>
                                @csrf
                                <div class="reg col-md-4">
                                    <button type="submit" class="btn btn-light regdesign2"><strong>
                                            Sınıfı Kaydet</strong></button>
                                </div>
                                <div class="col-md-2"></div>

                                @csrf
                                <div class="reg col-md-4">
                                    <button id="del" type="submit" class="btn btn-light regdesign3"
                                        form="del">
                                        <strong>Sınıfı Sil</strong> </button>
                                </div>
                                <div class="col-md-1"></div>

                            </div> --}}
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

            document.querySelector('.regdesign3').addEventListener('click', function(event) {
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
            window.location.href = "{{ route('get-our-classroom-page') }}";
            event.preventDefault();
        });
    });
</script>

<script>
    searchInput.addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const elements = document.querySelectorAll('.listitems a');

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
    function navigateToRoute(route) {
        window.location.href = route;
    }

    let sidebar = document.querySelector('.sidebar');
    let topmenuBtn = document.getElementById('topmenuBtn');

    // Toggle the sidebar when topmenuBtn is clicked
    topmenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Toggle the sidebar when the initial sidebar toggle button is clicked
    document.getElementById('btn').addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
</script>

</html>
