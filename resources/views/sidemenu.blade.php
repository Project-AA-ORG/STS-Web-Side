{{-- The sidemenu --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div>
        <div class="topmenu">
            <div class="top">
                <i class="fa-solid fa-bars" id="topmenuBtn" style="color: black;"> </i>
                <p id="backbutton2"><button style="color: black;" class="btn back-btn"><i
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
                <img style="cursor: pointer;" src="/images/download.jpg" class="user-img"
                    onclick="navigateToRoute('{{ addslashes(route('home-page')) }}')" alt="School Logo">

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
    </div>

    <script>
        function navigateToRoute(route) {
            window.location.href = route;
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topmenuBtn = document.getElementById('backbutton2');

            topmenuBtn.addEventListener('click', function() {
                window.history.back();
            });
        });
    </script>

</body>

</html>
