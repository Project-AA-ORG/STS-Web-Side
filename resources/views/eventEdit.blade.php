<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Etkinlik Düzenle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/eventEdit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>
<style>
    /* Add styles for the overlay */
    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        /* Adjust the opacity as needed */
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    #overlay img {
        max-width: 95%;
        max-height: 95%;
    }
</style>

<body>

    <div class="centerEdit">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->
        <div id="overlay">
            <img style="cursor: pointer;" id="overlayImage" src="" alt="Overlay Image">
        </div>
        <div id="mainbox" class="edit container">

            <p id="backbutton1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                        class="fa-solid fa-arrow-left"></i></button></p>
            <div class="row1 row">
                <div class="col-md-12">
                    <div id="secondbox" class="container">

                        <form id="yourFormId" action="{{ route('get-update-event') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="event_id" id="event_id" value="{{ $data['event']->event_id }}">

                            <div class="row">
                                <input type="text" name="event_title" id="event_title"
                                    value="{{ $data['event']->event_title }}" required placeholder="event_title"
                                    class="INPUT" maxlength="50">
                            </div>

                            <hr id="actualline">

                            <div class="row">

                                <div class="col-sm">

                                    <div class="photodiv">

                                        {{-- <img id="myImage" src="{{ asset('storage/' . $data['event']->event_image) }}"
                                            alt="Event Image" class="photoimg">  --}}

                                        <div class="photoimg">
                                            <img id="myImage"
                                                src="data:image/jpeg;base64,{{ $data['event']->event_image }}"
                                                alt="Event Image" style="cursor: pointer;">
                                        </div>
                                        <div class="buttons">
                                            <button type="button" class="btn btn-light my_button"
                                                onclick="changeImage()">Görseli Değiştir</button>

                                            <button type="button" class="btn btn-light my_button"
                                                onclick="delImage()">Görseli Sil</button>
                                        </div>

                                        <input style="display: none;" type="file" id="event_image" name="event_image"
                                            accept="image/*">

                                    </div>

                                </div>

                                <div class="col-sm">
                                    <textarea style="resize: none; padding:5px;" id="event_content" name="event_content" required
                                        placeholder="{{ $data['event']->event_content }}" class="INPUT2" maxlength="50000" >{{ $data['event']->event_content }}</textarea>
                                </div>
                            </div>

                            <div id="regdiv" class="row">
                                <div class="col-md-1"></div>
                                @csrf
                                <div class="reg col-md-4">
                                    <button type="submit" class="btn btn-light regdesign2"><strong>
                                            Etkinliği Kaydet</strong></button>
                                </div>
                                <div class="col-md-2"></div>

                                @csrf
                                <div class="reg col-md-4">
                                    <button id="del" type="submit" class="btn btn-light regdesign3"
                                        form="del">
                                        <strong>Etkinliği Sil</strong> </button>
                                </div>
                                <div class="col-md-1"></div>

                            </div>


                        </form>

                    </div>

                    <form id="del"
                        action="{{ route('get-delete-event', ['eventId' => $data['event']->event_id]) }}"
                        method="GET">

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
            window.location.href = "{{ route('get-our-event-page') }}";
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

    // function delImage() {
    //     const image = document.getElementById('myImage');
    //     image.src = '/images/image.jpg';

    //     const fileInput = document.getElementById('event_image');
    //     fileInput.value = image.src;
    // }
</script>
<script>
    function dataURLtoFile(dataURL, filename) {
        const arr = dataURL.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, {
            type: mime
        });
    }

    function delImage() {
        const imageSrc = '/images/image.jpg'; // Your image source
        const image = document.getElementById('myImage');
        image.src = '/images/image.jpg';
        // Create a new Blob object from the image source
        fetch(imageSrc)
            .then((res) => res.blob())
            .then((blob) => {
                // Convert Blob to data URL
                const reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    const base64data = reader.result;

                    // Convert data URL to File
                    const file = dataURLtoFile(base64data, 'image.jpg');

                    // Assign the File object to the file input
                    const fileInput = document.getElementById('event_image');
                    const fileList = new DataTransfer();
                    fileList.items.add(file);
                    fileInput.files = fileList.files;
                };
            })
            .catch((err) => {
                console.error('Error fetching or processing the image:', err);
            });
    }
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
<script>
    // Add a click event listener to the image for overlay
    document.getElementById('myImage').addEventListener('click', function() {
        const overlay = document.getElementById('overlay');
        const overlayImage = document.getElementById('overlayImage');
        const clickedImageSrc = this.src;

        overlayImage.src = clickedImageSrc; // Set the clicked image to the overlay

        // Show the overlay
        overlay.style.display = 'flex';
    });

    // Close the overlay when clicking on it
    document.getElementById('overlay').addEventListener('click', function() {
        this.style.display = 'none'; // Hide the overlay
    });
</script>

</html>
