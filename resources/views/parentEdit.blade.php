<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Veli Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parentEdit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">


</head>

<body>

    <div class="centerEdit">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div id="mainbox" class="edit container">
            <form id="yourFormId" action="{{ route('get-update-parent') }}" method="POST">

                <p id="backbutton1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                            class="fa-solid fa-arrow-left"></i></button></p>

                <div class="row row1">

                    <div class="col-md-12">
                        <div id="secondbox" class="container Entrance">

                            <input type="hidden" name="parent_id" id="parent_id"
                                value="{{ $data['parent']->parent_id }}">

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Ad Soyad</b> </div>
                                <input type="text" name="name" id="name" value="{{ $data['parent']->name }}"
                                    required placeholder="{{ $data['parent']->name }}" class="INPUT col-sm-7"
                                    maxlength="50">
                            </div>


                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Öğrencileri</b>

                                    <button
                                        style="border:#F5F4F6; position: absolute; right:5px; justify-content:center; border-radius: 6px; background-color: #F5F4F6; color: black;"
                                        class="btn btn-secondary dropdown-toggle btn-sm student-dropdown" type="button"
                                        id="studentDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>

                                    <div id="studentDropdownButton" class="dropdown-menu">

                                        <div>
                                            <nav id="searchNav" style="max-width: 14rem; border-radius: 5px;">
                                                <form class="form-inline">
                                                    <input style="height:1.7rem; font-size: 15px;" id="searchClass"
                                                        class="form-control mr-sm-2" type="search"
                                                        placeholder="&#x1F50E; Ara" aria-label="Ara">
                                                </form>
                                            </nav>
                                        </div>
                                        @php
                                            $locale = 'tr'; // Set the locale to Turkish (change it based on your needs)
                                            $sortedstudents = $data['students']->sort(function ($a, $b) use ($locale) {
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

                                        @foreach ($sortedstudents as $item)
                                            <div class="student-item">
                                                <input style="cursor: pointer;" type="checkbox"
                                                    id="student_{{ $item->student_id }}" name="student_id[]"
                                                    value="{{ $item->student_id }}">
                                                <label style="cursor: pointer;"
                                                    for="student_{{ $item->student_id }}">{{ $item->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                                {{-- TEMP ORIGINAL LARAVEL CODE --}}
                                <div id="createminibox" class="INPUT2 col-sm-7">
                                    @foreach ($data['parent']->students as $item)
                                        <div class="minibox2">

                                            <input style="display:none; cursor: pointer;" type="checkbox"
                                                id="student_{{ $item->student_id }}" name="student_id[]"
                                                value="{{ $item->student_id }}">
                                            <label style="cursor: pointer;"
                                                for="student_{{ $item->student_id }}">{{ $item->name }}</label>

                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <div id="usernamerowu" class="row">
                                <div class="LABEL col-sm-4"><b>Kullanıcı Adı</b></div>
                                <input type="text" name="username" id="username"
                                    value="{{ $data['parent']->username }}" required
                                    placeholder="{{ $data['parent']->username }}" class="INPUT col-sm-7"
                                    maxlength="50">

                            </div>

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Telefon No</b></div>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ $data['parent']->phone }}" required
                                    placeholder="{{ $data['parent']->phone }}" class="INPUT col-sm-7" maxlength="14"
                                    attern="[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}" required>
                            </div>

                            <div id="regdiv" class="row">
                                <div class="col-md-1"></div>
                                @csrf
                                <div class="reg col-md-4">
                                    <button type="submit" class="btn btn-light regdesign2"><strong>
                                            Veliyi Kaydet</strong></button>
                                </div>
                                <div class="col-md-1"></div>

                                @csrf
                                <div class="reg col-md-4">
                                    <button id="del" type="submit" class="btn btn-light regdesign3"
                                        form="del">
                                        <strong>Veliyi Sil</strong> </button>
                                </div>
                                <div class="col-md-1"></div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        <form id="del" action="{{ route('get-delete-parent', ['parentId' => $data['parent']->parent_id]) }}"
            method="GET">

            <div id="confirmationModal" class="modal_2">
                <div class="modal-content_2">
                    <p>Veliyi silmek istediğine emin misin?</p>
                    <button type="submit" id="confirmYes">Evet</button>
                    <button type="button" id="confirmNo"> Hayır</button>
                </div>
            </div>

        </form>
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
            window.location.href = "{{ route('get-our-parent-page') }}";
            event.preventDefault();
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Prevent dropdown from closing on item selection
        $('.dropdown-menu').on('click', function(e) {
            if ($(this).hasClass('dropdown-menu')) {
                e.stopPropagation();
            }
        });
    });
</script>
<script>
    document.querySelectorAll('.student-item input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const studentId = this.value; // Get the value of the selected checkbox

            if (this.checked) {
                // If checkbox is checked, create a corresponding minibox2 element
                const minibox = document.createElement('div');
                minibox.className = 'minibox2 checked'; // Add necessary classes
                minibox.innerHTML = `
                    <input style="cursor:pointer;" type="checkbox" id="student_${studentId}" name="student_id[]" value="${studentId}" checked>
                    <label style="cursor:pointer:" for="student_${studentId}">${this.nextElementSibling.textContent}</label>
                `;

                // Append the newly created minibox2 element to the container
                document.getElementById('createminibox').appendChild(minibox);
            } else {
                // If checkbox is unchecked, find and remove the corresponding minibox2 element
                const miniboxToRemove = document.querySelector(`.minibox2 input[value="${studentId}"]`)
                    .parentNode;
                miniboxToRemove.remove();
            }
        });
    });
</script>

<script>
    document.getElementById('phone').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
    });
</script>

<script>
    const miniboxes = document.querySelectorAll('.minibox2');

    // Add click event listener to each .minibox2
    miniboxes.forEach((minibox) => {
        const checkbox = minibox.querySelector('input[type="checkbox"]');

        minibox.addEventListener('click', function(event) {
            // Toggle the checkbox on click
            checkbox.checked = !checkbox.checked;

            // Toggle the class for styling
            if (checkbox.checked) {
                minibox.classList.add('checked'); // Add a class to change color when checked
            } else {
                minibox.classList.remove('checked'); // Remove the class when unchecked
            }

            // Prevent the click event from propagating to the label
            event.stopPropagation();
        });
    });
</script>
<script>
    // Simulate checking the checkboxes on page load
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.minibox2 input[type="checkbox"]');

        checkboxes.forEach((checkbox) => {
            checkbox.checked = true; // Simulate check
            const minibox = checkbox.parentNode; // Get the parent .minibox2 element
            minibox.classList.add('checked'); // Add a class to change color when checked
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const miniboxes = document.querySelectorAll('.minibox2');
        const existingLabels = new Set(); // To store existing label names

        miniboxes.forEach((minibox) => {
            const label = minibox.querySelector('label');
            const labelText = label.textContent.trim();

            if (existingLabels.has(labelText)) {
                minibox.remove(); // Remove duplicates
            } else {
                existingLabels.add(labelText); // Add the label text to the Set
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

<script>
    document.getElementById('searchClass').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const studentLabels = document.querySelectorAll('.student-item label');

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
    document.addEventListener('DOMContentLoaded', function() {
        const yourForm = document.getElementById('yourFormId');

        // Handle form submission
        yourForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Remove duplicate inputs
            const uniqueClassroomIds = new Set();
            const classroomInputs = document.querySelectorAll('input[name="student_id[]"]');

            classroomInputs.forEach(input => {
                if (uniqueClassroomIds.has(input.value)) {
                    input.remove(); // Remove duplicate inputs
                } else {
                    uniqueClassroomIds.add(input.value); // Add unique input values to the Set
                }
            });

            // Submit the form without duplicate inputs
            yourForm.submit();
        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const miniboxContainer = document.getElementById('createminibox');

        miniboxContainer.addEventListener('mouseenter', function() {
            this.focus();
        });

        miniboxContainer.addEventListener('mouseleave', function() {
            this.blur();
        });

        miniboxContainer.addEventListener('wheel', function(event) {
            event.preventDefault();
            this.scrollLeft += event.deltaY;
        });
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
