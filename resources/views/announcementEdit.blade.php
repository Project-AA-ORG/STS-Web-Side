<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Duyuru Düzenle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/announcementEdit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
  
    </style>
</head>
<body>
    <div class="centerEdit">

        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        {{-- The sidemenu --}}
        <!-- sidebar tasarımı son -->

        <div id="mainbox" class="edit container">

            <p id="backbutton1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                        class="fa-solid fa-arrow-left"></i></button></p>
            <div class="row1 row">

                <div class="col-md-12">
                    <div id="secondbox" class="container">

                        <form id="yourFormId" action="{{ route('get-update-announcement') }}" method="POST">
                            @csrf

                            <input type="hidden" name="general_announcement_id" id="general_announcement_id"
                                value="{{ $data['announcement']->general_announcement_id }}">

                            <div class="row">
                                <input type="text" name="announcement_title" id="announcement_title"
                                    value="{{ $data['announcement']->announcement_title }}" required
                                    placeholder="{{ $data['announcement']->announcement_title }}" class="INPUT" maxlength="50">
                            </div>

                            <hr id="actualline">

                            <div class="row">
                                <textarea style="resize: none; padding:7px;" id="announcement_content" name="announcement_content" required
                                    placeholder="{{ $data['announcement']->announcement_content }}" class="INPUT2" maxlength="50000">{{ $data['announcement']->announcement_content }}</textarea>
                            </div>

                            <div id="regdiv" class="row">
                                <div class="col-md-1"></div>
                                @csrf
                                <div class="reg col-md-4">
                                    <button type="submit" class="btn btn-light regdesign2"><strong>
                                            Duyuruyu Kaydet</strong></button>
                                </div>
                                <div class="col-md-2"></div>

                                @csrf
                                <div class="reg col-md-4">
                                    <button id="del" type="submit" class="btn btn-light regdesign3"
                                        form="del">
                                        <strong>Duyuruyu Sil</strong> </button>
                                </div>
                                <div class="col-md-1"></div>

                            </div>
                        </form>
                    </div>
                </div>

                <form id="del"
                    action="{{ route('get-delete-announcement', ['announcementId' => $data['announcement']->general_announcement_id]) }}"
                    method="GET">

                    <div id="confirmationModal" class="modal_2">
                        <div class="modal-content_2">
                            <p>Duyuruyu silmek istediğine emin misin?</p>
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
            window.location.href = "{{ route('get-our-announcement-page') }}";
            event.preventDefault();
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
