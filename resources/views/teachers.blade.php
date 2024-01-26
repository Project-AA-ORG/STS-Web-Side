<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ögretmenlerimiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/teachers.css') }}" rel="stylesheet">
    <link href="{{ asset('css/teacherAdd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

</head>

<style>
    #bar2 {
        width: 15rem;
        height: 4rem;
    }

    .dropdown-menu {
        max-height: 7rem;
        overflow: auto;
    }

    #dersDropdown {
        max-width: 14rem;
        max-height: 12rem;
    }
</style>

<body>

    <div class="center">

        @include('sidemenu')

        {{-- Outside div in body to contain everything --}}
        <div class="Teachers" id="fullHeightDiv">

            <!-- All teachers from database will be listed here -->
            <div class="listitems">
                {{-- search bar --}}
                <div id="bar" style="width: 100%;" class="d-inline-flex p-2 bd-highlight">
                    <nav style="width: 100%; border-radius: 5px;" class="navbar navbar-light bg-light">
                        <form style="width: 100%;" class="form-inline">
                            <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                                placeholder="&#x1F50E; Öğretmen Ara" aria-label="Ara">
                        </form>
                    </nav>
                </div>
                {{-- Teachers will be listed here --}}
                <div class="listitems2">

                    @php
                        $locale = 'tr'; // Set the locale to Turkish (change it based on your needs)
                        $sortedTeachers = $data['teachers']->sort(function ($a, $b) use ($locale) {
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

                    {{-- $data['teachers'] --}}
                    @foreach ($sortedTeachers as $item)
                        <a id="{{ $item->teacher_id }}" class="line teacherline"
                            href="{{ route('get-update-teacher-page', ['teacherId' => $item->teacher_id]) }}">
                            <img class="lineimg" src="data:image/jpeg;base64,{{ $item->teacher_image }}" alt="">
                            <div class="linetext"> {{ $item->name }} </div>
                        </a>
                    @endforeach
                </div>

                {{-- add teacher button to open overlay  --}}
                <div class="buttondiv1">
                    <button class="btn btn-light" id="myBtn" style="background-color: #E8D5B9;">Öğretmen
                        Ekle</button>
                </div>
            </div>


            <div id="myModal" class="modal">
                <div class="modal-content">
                    {{-- model content --}}
                    <div class="bigbox">
                        {{-- close button --}}
                        <div class="modal-header">
                            <span style="cursor: pointer;" class="close">&times;</span>
                        </div>

                        <div class="modal-body">

                            <form id="yourFormId" action="{{ route('get-add-new-teacher') }}" method="POST">
                                @csrf
                                <div class="container">
                                    {{-- so everything is centered correctly --}}
                                    <div class="centeritems">

                                        {{-- grid structure to make it look better --}}
                                        {{-- first input name --}}
                                        <div class="row">
                                            <div class="childbox col-sm">Ad Soyad</div>
                                            <input type="text" id="name" name="name" required
                                                placeholder="giriniz" class="childbox col-sm" maxlength="50">
                                        </div>
                                        {{-- second input classroom array --}}
                                        <div class="row">

                                            <div class="col-sm childbox3">Sınıfları</div>

                                            <div class="col-sm childbox2 form-check custom-control custom-checkbox">
                                                <div>
                                                    <nav id="searchNav"
                                                        style="margin: 0; padding: 0; margin-left: -1.5rem; width:120%; border-radius: 5px;">
                                                        <form class="form-inline">
                                                            <input style="height:1.7rem; font-size: 15px;"
                                                                id="searchClass" class="form-control mr-sm-2"
                                                                type="search" placeholder="&#x1F50E; Ara"
                                                                aria-label="Ara">
                                                        </form>
                                                    </nav>
                                                </div>
                                                @php
                                                    $sortedClasses = $data['classroom']->sort(function ($a, $b) {
                                                        return strnatcmp($a->classroom_name, $b->classroom_name);
                                                    });
                                                @endphp
                                                <div class="classroom-list">
                                                    @foreach ($sortedClasses as $item)
                                                        <div class="rows">
                                                            <input type="checkbox"
                                                                id="classroom_{{ $item->classroom_id }}"
                                                                name="classroom_id[]" value="{{ $item->classroom_id }}"
                                                                class="form-check-input custom-control-input col-sm">
                                                            <label for="classroom_{{ $item->classroom_id }}"
                                                                class="form-check-label custom-control-label col-sm"
                                                                style="cursor: pointer;">
                                                                {{ $item->classroom_name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>

                                        <!-- course dropdown-->
                                        <div class="row">
                                            <div class="childbox col-sm">Ders</div>
                                            <div class="dropdown">
                                                <button
                                                    style="font-size:15px; overflow:auto; background-color: #F5F4F6; color:black;"
                                                    class="col-sm  btn btn-secondary dropdown-toggle btn-sm course-dropdown COURSEDROP"
                                                    type="button" id="dersDropdownButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Seçiniz
                                                </button>

                                                <input type="hidden" name="course_id" id="course_id"
                                                    value="Seçiniz">
                                                <div class="dropdown-menu" id="dersDropdown">
                                                    <div>
                                                        <nav id="searchNav2" style="width:90%; border-radius: 5px;">
                                                            <form class="form-inline">
                                                                <input style="height:1.7rem; font-size: 15px;"
                                                                    id="searchClass2" class="form-control mr-sm-2"
                                                                    type="search" placeholder="&#x1F50E; Ara"
                                                                    aria-label="Ara">
                                                            </form>
                                                        </nav>
                                                    </div>

                                                    @php
                                                        $locale = 'tr'; // Set the locale to Turkish (change it based on your needs)
                                                        $sortedCourses = $data['course']->sort(function ($a, $b) use ($locale) {
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

                                                    @foreach ($sortedCourses as $item)
                                                        <a class="dropdown-item course-item" href="#"
                                                            data-course-id="{{ $item->course_id }}"
                                                            onclick="setSelectedcourse('{{ $item->course_name }}', '{{ $item->course_id }}')">
                                                            {{ $item->course_name }}
                                                        </a>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>

                                        {{-- username input --}}
                                        <div class="row">
                                            <div class="col-sm childbox">Kullanıcı Adı</div>
                                            <input type="text" id="username" name="username" required
                                                placeholder="giriniz" class="col-sm childbox " maxlength="50">
                                        </div>

                                        {{-- phone number input --}}
                                        <div class="row">
                                            <div class="childbox col-sm">Telefon No</div>
                                            <input type="tel" id="phone" name="phone" required
                                                placeholder="giriniz" class="childbox col-sm" maxlength="14" placeholder="8888 888 88 88" pattern="[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}" required >
                                        </div>

                                    </div>
                                    {{-- buttons in overlay --}}
                                    <div class="buttondiv">
                                        <button type="reset" class="btn btn-light"
                                            style="background-color: #FF9595;"
                                            onclick="resetDropdowns()">Temizle</button>


                                        <button type="submit" class="btn btn-light"
                                            style="background-color: #FF9595;">Tamamla</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

                {{-- error messages  will be shown as overlays --}}
                <div id="overlayError1"
                    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                        Lütfen bir ders seçiniz.
                    </div>
                </div>
                <div id="overlayError2"
                    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                        Lütfen en az bir sınıf seçiniz.
                    </div>
                </div>

            </div>
            @if (isset($data['error']))
                <div id="overlayError"
                    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px; z-index: 1000;">
                    Kullanıcı adı daha önceden de kullanıldığı için öğretmen kaydedilemedi.
                </div>
            @endif

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
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessage = document.getElementById('overlayError');

        // Check if the error message exists and has content
        if (errorMessage && errorMessage.innerText.trim().length > 0) {
            errorMessage.style.display = 'block';

            // Hide overlay error message after 3 seconds (adjust as needed)
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    });
</script>

<script>
    // searchbar logic
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
    // dropdown
    document.querySelectorAll('.course-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let dersDropdown = document.querySelector('.course-dropdown');
            dersDropdown.textContent = selectedText;
        });
    });

    function printSelectedClassroom(selected, id) {
        console.log('Selected classroom:', selected);
        console.log('Classroom ID:', id);
    }

    function setSelectedcourse(selected, id) {
        console.log('Selected course:', selected);
        console.log('Course ID:', id);
        document.getElementById('course_id').value = id;
    }
    // clears dropdown
    function resetDropdowns() {
        document.querySelector('.course-dropdown').textContent = 'Seçiniz';
        document.getElementById('course_id').value = '';
    }
</script>

<script>
    $(document).ready(function() {
        $('#classroom_id').change(function() {
            $(this).find('option:selected').toggleClass('selected');
        });
    });
</script>

<script>
    document.getElementById('yourFormId').addEventListener('submit', function(event) {
        var selectedValue = document.getElementById('course_id').value;

        if (selectedValue === 'Seçiniz') {
            event.preventDefault(); // Prevent form submission

            // Show overlay error message
            document.getElementById('overlayError1').style.display = 'block';

            // Hide overlay error message after 3 seconds (adjust as needed)
            setTimeout(function() {
                document.getElementById('overlayError1').style.display = 'none';
            }, 2000);
        }
        var selectedCheckboxes = document.querySelectorAll('input[name="classroom_id[]"]:checked');

        if (selectedCheckboxes.length === 0) {
            event.preventDefault(); // Prevent form submission

            // Show overlay message for classroom selection
            document.getElementById('overlayError2').style.display = 'block';

            // Hide overlay message after a certain time (adjust as needed)
            setTimeout(function() {
                document.getElementById('overlayError2').style.display = 'none';
            }, 2000);
        }
    });
</script>

<script>
    document.getElementById('phone').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
    });
</script>

<script>
    // Here you might have your error logic, for example:
    var errorMessage = document.querySelector('.error');
    if (errorMessage && errorMessage.innerText === "Bu username daha önce kullanıldı") {
        event.preventDefault(); // Prevent form submission
        document.getElementById('overlayError_3').style.display = 'block';
        // Overlay stays open because of the error
    } else {
        // Overlay closes as there's no error
        document.getElementById('myModal').style.display = 'none';
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
    document.querySelector('.back-btn').addEventListener('click', function() {
        window.history.back();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput2 = document.getElementById('searchClass');
        const labels2 = document.querySelectorAll('.classroom-list .form-check-label');

        searchInput2.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            labels2.forEach(label => {
                const text = label.textContent.toLowerCase();
                const row = label.parentElement;
                if (text.includes(searchTerm)) {
                    row.style.display = 'block';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput3 = document.getElementById('searchClass2');
        const labels3 = document.querySelectorAll('#dersDropdown .dropdown-item');

        searchInput3.addEventListener('input', function() {
            const searchTerm2 = this.value.toLowerCase();

            labels3.forEach(label => {
                const text = label.textContent.toLowerCase();
                if (text.includes(searchTerm2)) {
                    label.style.display = 'block';
                } else {
                    label.style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    function generateUsernameFromName(name) {
        // Convert the name to lowercase and remove spaces
        const formattedName = name.toLowerCase().replace(/\s/g, '');

        const randomString = Math.floor(Math.random() * 1000).toString().padStart(3, '0');


        const uniqueUsername = formattedName + randomString; // Combine name and random string
        return uniqueUsername; // Return the generated username
    }
</script>

<script>
    document.getElementById('name').addEventListener('input', function() {
        const enteredName = this.value;
        const generatedUsername = generateUsernameFromName(enteredName);

        // You can then populate your username input field with the generated username
        document.getElementById('username').value = generatedUsername;
    });
</script>
<script>
    const phoneInput = document.getElementById('phone');

    phoneInput.addEventListener('input', function(event) {
        const input = event.target.value.replace(/\D/g, '').substring(0, 14); // Remove non-numeric characters

        // Define the format using regex patterns
        const formattedInput = input.replace(/(\d{4})(\d{1,3})?(\d{1,2})?(\d{0,2})?/, function(match, p1, p2,
            p3, p4) {
            let formatted = `${p1}`;
            if (p2) formatted += `-${p2}`;
            if (p3) formatted += `-${p3}`;
            if (p4) formatted += `-${p4}`;
            return formatted;
        });

        event.target.value = formattedInput;
    });
</script>
</html>
