<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">


</head>

<body>
    {{-- The sidemenu --}}

    <div class="topmenu">
        <div class="top">
            <i class="fa-solid fa-bars" id="topmenuBtn" style="color: black"> </i>
            <p id="backbutton_2"><button style="color: black;" class="btn back-btn"><i
                class="fa-solid fa-arrow-left"></i></button></p>
        </div>
    </div>


    <div class="sidebar">
        {{-- has an empty logo section to make it look better also includes hamburgermenu --}}
        <div class="top">
            <div class="logo">
                <i></i>
            </div>
            <i class="fa-solid fa-bars" id="btn" style="color: black;"> </i>
        </div>

        {{-- user section, has an image and a text --}}
        <div class="user">
            <img style="cursor: pointer;" src="/images/download.jpg" alt="senay" class="user-img"
                onclick="navigateToRoute('{{ route('home-page') }}')">
            <div>
                <p style="font-size: 20px;" class="bold">Şenay Duran Okulları</p>
            </div>

        </div>
        <hr>
        {{-- ul li a section, all links have links to different pages, all include an icon and a span --}}
        <ul>
            <li>
                <a href="{{ route('get-our-teacher-page') }}">
                    <i class='fas fa-chalkboard-teacher'></i>
                    <span class="nav-item">Öğretmenlerimiz</span>
                </a>
            </li>
            <li>
                <a href="{{ route('get-our-student-page') }}">
                    <i class='fas fa-book-reader'></i>
                    <span class="nav-item">Öğrencilerimiz</span>
                </a>
            </li>
            <li>
                <a href="{{ route('get-our-parent-page') }}">
                    <i class='bx bx-male-female'></i>
                    <span class="nav-item">Velilerimiz</span>
                </a>
            </li>
            <li>
                <a href="{{ route('get-our-course-page') }}">
                    <i class='fas fa-book-open'></i>
                    <span class="nav-item">Derslerimiz</span>
                </a>
            </li>
            <li>
                <a href="{{ route('get-our-classroom-page') }}">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-item">Sınıflarımız</span>
                </a>
            </li>
            <li>
                <a href=" {{ route('get-our-announcement-page') }}">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="nav-item">Duyurularımız</span>
                </a>
            </li>
            <li>
                <a href="{{ route('get-our-event-page') }}">
                    <i class='bx bx-calendar-event'></i>
                    <span class="nav-item">Etkinliklerimiz</span>
                </a>
            </li>

        </ul>
    </div>

</body>
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
  document.querySelector('.back-btn').addEventListener('click', function() {
        window.history.back();
    });
</script>

</html>