<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Derslerimiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
    <link href="{{ asset('css/courseAdd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        #bar2 {
            width: 10rem;
            height: 4rem;
        }

        .dropdown-menu {
            max-height: 7rem;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div class="center">

        @include('sidemenu')

        <!-- ekranın ortasındaki dikdortgen -->
        <div class="Courses" id="fullHeightDiv">
            <div class="listitems">

                <!-- arama barı -->
                <div id="bar" style="width: 100%;" class="d-inline-flex p-2 bd-highlight">
                    <nav style="width: 100%; border-radius: 5px;" class="navbar navbar-light bg-light">
                        <form style="width: 100%;" class="form-inline">
                            <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                                placeholder="&#x1F50E; Ders Ara" aria-label="Ara">
                        </form>
                    </nav>
                </div>

                <!-- listeleneceği ve scroll bar oluşturacak olan div -->
                <div class="listitems2">
                    @php
                        $locale = 'tr'; // Set the locale to Turkish (change it based on your needs)
                        $sortedCourses = $data['courses']->sort(function ($a, $b) use ($locale) {
                            return strcmp(
                                utf8_encode(
                                    Str::of($a->course_name)
                                        ->lower()
                                        ->slug('-'),
                                ),
                                utf8_encode(
                                    Str::of($b->course_name)
                                        ->lower()
                                        ->slug('-'),
                                ),
                            );
                        });
                    @endphp
                    {{-- $data['courses'] --}}
                    @foreach ($sortedCourses as $item)
                        <a id="line" class="line courseline"
                            href="{{ route('get-update-course-page', ['courseId' => $item->course_id]) }}">
                            <div class="courselinetext">{{ $item->course_name }}</div>
                        </a>
                    @endforeach

                </div>
                <div class="buttondiv1">
                    <button class="btn btn-light" id="myBtn" style="background-color: #E8D5B9;">Ders
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

                            <form id="yourFormId" action="{{ route('get-add-new-course') }}" method="POST">
                                @csrf

                                <div class="container">
                                    {{-- so everything is centered correctly --}}
                                    <div class="centeritems">
                                        <div class="row">
                                            <div class="childbox col-sm">Ders Adı</div>
                                            <input type="text" id="course_name" name="course_name" required
                                                placeholder="giriniz" class="childbox col-sm" maxlength="50">
                                        </div>
                                    </div>

                                    <div class="buttondiv">
                                        <button type="reset" class="btn btn-light"
                                            style="background-color: #FF9595;">Temizle</button>


                                        <button type="submit" class="btn btn-light"
                                            style="background-color: #FF9595;">Tamamla</button>
                                    </div>
                                </div>
                            </form>


                        </div>

                    </div>

                </div>

            </div>

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
