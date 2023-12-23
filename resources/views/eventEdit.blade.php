<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Etkinlik Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/eventEdit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
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

        <div id="mainbox" class="duzenle container">

            <p id="backbutton_1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                        class="fa-solid fa-arrow-left"></i></button></p>
            <div class="row_1 row">
                <div class="col-md-12">
                    <div id="secondbox" class="container">

                        <form id="yourFormId" action="{{ route('get-update-event') }}" method="POST">
                            @csrf

                            <input type="hidden" name="event_id" id="event_id" value="{{ $data['event']->event_id }}">

                            <div class="row">
                                <input type="text" name="event_title" id="event_title" value="{{ $data['event']->event_title }}" required
                                    placeholder="event_title" class="INPUT">
                            </div>

                            <hr id="cizgi">

                            <div class="row">

                                {{-- <div style="col-sm">

                                    <div class="photodiv">
                                        <img id="myImage" src="{{ $data['event']->event_image }}"
                                            class="photoimg">

                                        <div class="buttons">
                                            <button class="btn btn-light my_button" onclick="changeImage()">Görseli Değiştir</button>

                                            <button class="btn btn-light my_button" onclick="delImage()">Görseli Sil</button>
                                        </div>
                                    </div>


                                    <input style="display: none;" type="file" id="event_image" name="event_image"
                                        value="{{ $data['event']->event_image }}">
                                </div> --}}
                                <div style="col-sm">
                                    <div class="photodiv">
                                        <!-- Use Blade syntax to dynamically set the image source -->
                                        {{-- <img id="myImage" src="{{ asset($data['event']->event_image) }}" class="photoimg"> --}}
                                        <img src="data:image/jpeg;base64,{{ base64_encode($data['event']->event_image) }}" alt="Event Image"/>

                                        <div class="buttons">
                                            <button class="btn btn-light my_button" onclick="changeImage()">Görseli Değiştir</button>
                                            <button class="btn btn-light my_button" onclick="delImage()">Görseli Sil</button>
                                        </div>
                                    </div>
                                
                                    <input style="display: none;" type="file" id="event_image" name="event_image" value="{{ $data['event']->event_image }}">
                                </div>
                                

                                <div class="col-sm">
                                    <textarea style="resize: none;" id="event_content" name="event_content" required placeholder="{{ $data['event']->event_content }}"
                                        class="INPUT_2"></textarea>
                                </div>
                            </div>

                            <div id="kayıtdivi" class="row">
                                <div class="col-md-1"></div>
                                @csrf
                                <div class="kayıt col-md-4">
                                    <button type="submit" class="btn btn-light kayıt_design_2"><strong>
                                            Etkinliği Kaydet</strong></button>
                                </div>
                                <div class="col-md-2"></div>

                                @csrf
                                <div class="kayıt col-md-4">
                                    <button id="del" type="submit" class="btn btn-light kayıt_design_3"
                                        form="del">
                                        <strong>Etkinliği Sil</strong> </button>
                                </div>
                                <div class="col-md-1"></div>

                            </div>


                        </form>

                    </div>

                    <form id="del" action="{{ route('get-delete-event', ['eventId' => $data['event']->event_id]) }}" method="GET">

                        <div id="confirmationModal" class="modal_2">
                            <div class="modal-content_2">
                                <p>Etkinliği silmek istediğine emin misin?</p>
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
    function changeImage() {
        const fileInput = document.getElementById('event_image');
        const image = document.getElementById('myImage');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                image.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        fileInput.click(); // Open file dialog
    }
</script>

<script>
    function delImage() {
        const image = document.getElementById('myImage');
        image.src = '/images/image.jpg';

        const fileInput = document.getElementById('event_image');
        fileInput.value = image.src;

    }
</script>

</html>
