<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Velilerimiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parents.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parentAdd.css') }}" rel="stylesheet">
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
        <div class="Parents" id="fullHeightDiv">
            <div class="listitems">

                <!-- arama barı -->
                <div id="bar" style="width: 100%;" class="d-inline-flex p-2 bd-highlight">
                    <nav style="width: 100%; border-radius: 5px;" class="navbar navbar-light bg-light">
                        <form style="width: 100%;" class="form-inline">
                            <input id="searchInput" style="width: 100%;" class="form-control mr-sm-2" type="search"
                                placeholder="&#x1F50E; Veli Ara" aria-label="Ara">
                        </form>
                    </nav>
                </div>

                <!-- listeleneceği ve scroll bar oluşturacak olan div -->
                <div class="listitems2">
                    @php
                        $locale = 'tr'; // Set the locale to Turkish (change it based on your needs)
                        $sortedParents = $data['parents']->sort(function ($a, $b) use ($locale) {
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
                    {{-- $data['parents']  --}}
                    @foreach ($sortedParents as $item)
                        <a id="line" class="line parentline"
                            href="{{ route('get-update-parent-page', ['parentId' => $item->parent_id]) }}">
                            <div class="parentlinetext"> {{ $item->name }} </div>
                        </a>
                    @endforeach

                </div>
                <div class="buttondiv1">
                    <button class="btn btn-light" id="myBtn" style="background-color: #E8D5B9;">Veli
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

                            <form id="yourFormId" action="{{ route('get-add-new-parent') }}" method="POST">
                                @csrf
                                <div class="container">
                                    {{-- so everything is centered correctly --}}
                                    <div class="centeritems">

                                        <div class="row">
                                            <div class="childbox col-sm">Ad Soyad</div>
                                            <input type="text" id="name" name="name" required
                                                placeholder="giriniz" class="childbox col-sm" maxlength="50">
                                        </div>

                                        <div class="row">

                                            <div class="col-sm childbox3 ">Öğrencileri</div>

                                            <div class="col-sm childbox2 form-check custom-control custom-checkbox ">
                                                <div>
                                                    <nav id = "searchNav"
                                                        style="margin: 0; padding: 0; margin-left: -1.5rem; width:120%; border-radius: 5px;">
                                                        <form class="form-inline">
                                                            <input style="height:1.7rem; font-size: 15px;"
                                                                id="searchClass" class="form-control mr-sm-2"
                                                                type="search" placeholder="&#x1F50E; Ara"
                                                                aria-label="Ara">
                                                        </form>
                                                    </nav>
                                                </div>
                                                @foreach ($data['students'] as $item)
                                                    <div class="rows">
                                                        <input type="checkbox" id="students_{{ $item->student_id }}"
                                                            name="student_id[]" value="{{ $item->student_id }}"
                                                            class="form-check-input custom-control-input col-sm">
                                                        <label for="students_{{ $item->student_id }}"
                                                            class="student-names form-check-label custom-control-label col-sm"
                                                            style="cursor: pointer;">
                                                            {{ $item->name }}
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>


                                        {{-- username input --}}
                                        <div class="row">
                                            <div class="col-sm childbox">Kullanıcı Adı</div>
                                            <input type="text" id="username" name="username" required
                                                placeholder="giriniz" class="col-sm childbox" maxlength="50">
                                        </div>

                                        {{-- phone number input --}}
                                        <div class="row">
                                            <div class="childbox col-sm">Telefon No</div>
                                            <input class="childbox col-sm" maxlength="14" type="tel"
                                                id="phone" name="phone" placeholder="8888 888 88 88"
                                                pattern="[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}" required />
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

            </div>
            @if (isset($data['error']))
                <div id="overlayError"
                    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px; z-index: 1000;">
                    Kullanıcı adı daha önceden de kullanıldığı için veli kaydedilemedi.
                </div>
            @endif
        </div>
        <div id="overlayError2"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
            <div
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                Lütfen en az bir öğrenci seçiniz.
            </div>
        </div>

        <div id="overlayError3"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 999;">
            <div
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffcccc; padding: 20px; border-radius: 5px;">
                Bu username daha önce kullanıldı.
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
    function setSelectedStudent(selected, id) {
        console.log('Selected Student:', selected);
        console.log('Student ID:', id);
        document.getElementById('student_id').value = id;
    }

    function resetDropdowns() {
        document.getElementById('classroom_id').value = '';
    }
</script>

<script>
    document.getElementById('yourFormId').addEventListener('submit', function(event) {

        var selectedCheckboxes = document.querySelectorAll('input[name="student_id[]"]:checked');

        if (selectedCheckboxes.length === 0) {
            event.preventDefault(); // Prevent form submission

            // Show overlay message for no student selected
            document.getElementById('overlayError2').style.display = 'block';

            // Hide overlay message after a certain time (adjust as needed)
            setTimeout(function() {
                document.getElementById('overlayError2').style.display = 'none';
            }, 2000);
        }
    });
</script>


<script>
    // Here you might have your error logic, for example:
    var errorMessage = document.querySelector('.error');
    if (errorMessage && errorMessage.innerText === "Bu username daha önce kullanıldı") {
        event.preventDefault(); // Prevent form submission
        document.getElementById('overlayError3').style.display = 'block';
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
    let searchClassInput = document.getElementById('searchClass');

    searchClassInput.addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const studentLabels = document.querySelectorAll('.student-names');

        studentLabels.forEach(function(label) {
            const text = label.textContent.toLowerCase();
            const parentDiv = label.parentElement;
            if (text.includes(searchQuery)) {
                parentDiv.style.display = 'block';
            } else {
                parentDiv.style.display = 'none';
            }
        });
    });
</script>
<script>
    function generateUsernameFromName(name) {
        // Convert the name to lowercase and remove spaces
        const formattedName = name.toLowerCase().replace(/\s/g, '');

        // Generate a random string of characters (e.g., using Math.random())
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
