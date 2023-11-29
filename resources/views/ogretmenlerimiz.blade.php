<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogretmenlerimiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/ogretmen_duzenle_tasarım.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar_tasarım.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">
    <link href="{{ asset('css/ogretmenlerimiz.css') }}" rel="stylesheet">

<body>


    <div class="bg_ogretmen_duzenle">

        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

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

                
             <?php
                // bu php kodu databasedeki tüm öğretmenler için bir'er bar oluşturacak
                foreach ($data["teachers"] as $item) {
                    $imageSrc = $item->teacher_image; 
                    $itemName = $item->name; 
                ?>
                <a id="satir" class="ogretmen-satiri" href="#">
                    <img class="ogretmen-satiri-gorseli" src="<?php echo $imageSrc; ?>" alt="teacher">
                    <div class="ogretmen-satiri-yazisi" for="name">
                        <?php echo $itemName; ?>
                    </div>
                </a>

                <?php } ?>

            </div>

            <button id="openOverlayButton" type="button" class="btn btn-light"
                style="margin-left: 37%; margin-top: 1%; background-color: #E8D5B9;">Öğretmen Ekle</button>


        </div>

        <div id="overlay" class="overlay">
            <div class="overlay-content">
                <!-- Content loaded from the Blade.php file will appear here -->
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin='anonymous'></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

<script>
    $(document).ready(function() {
        $('#openOverlayButton').on('click', function() {
            // Make an AJAX request to fetch the Blade.php content
            $.ajax({
                url: '/ogretmen_ekle_overlay.blade.php', // Replace this with the actual path
                method: 'GET',
                success: function(response) {
                    // Insert the response content into the overlay
                    $('#overlay .overlay-content').html(response);

                    // Display the overlay
                    $('#overlay').fadeIn();
                },
                error: function() {
                    console.log('Error fetching content.');
                }
            });
        });

        // Close the overlay when clicking outside of it
        $('#overlay').on('click', function(event) {
            if (event.target === this) {
                $(this).fadeOut();
            }
        });
    });
</script>

<script>
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    btn.onclick = function () {
        sidebar.classList.toggle('active');
    };


    $('.back-btn').on('click', function () {
        window.hist
    });
</script>

<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();
        const elements = document.querySelectorAll('.listele a');

        elements.forEach(function (element) {
            const text = element.textContent.toLowerCase();
            if (text.includes(searchQuery)) {
                element.style.display = 'block'; // Show matching elements
            } else {
                element.style.display = 'none'; // Hide non-matching elements
            }
        });
    });

</script>

</html>