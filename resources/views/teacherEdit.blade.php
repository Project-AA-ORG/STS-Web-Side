<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Ogretmen Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/teacherEdit.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">


</head>

<style>
    #classroomdropdown {
        min-height: 2rem;
        max-height: 8rem;
        max-width: 5rem;
        border: 1px solid gray;
    }
</style>

<body>

    <div class="centerEdit">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div id="mainbox" class="edit container">

            <form id="yourFormId" action="{{ route('get-update-teacher') }}" method="POST">


                <p id="backbutton1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                            class="fa-solid fa-arrow-left"></i></button></p>

                <div class="row row1">

                    <div class="col-md-4">
                        <div class="photo">
                            <img id="teacherphoto" src="data:image/jpeg;base64,{{ $data['teacher']->teacher_image }}" alt="">
                            <input type="hidden" id="booleanValue" name="control" value="false">
                            <button type="button" id="confirmationButton" class="btn btn-light">&times;</button>
                        </div>

                        <div class="regdiv">
                            @csrf
                            <div class="reg">

                                <button type="submit" class="btn btn-light regdesign1"><strong>
                                        Öğretmeni Kaydet</strong></button>

                            </div>

                            @csrf
                            <div class="reg">
                                <button id="del" type="submit" class="btn btn-light regdesign2"
                                    form="del"><strong>
                                        Öğretmeni Sil</strong></button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="secondbox" class="container Entrance">
                            <input type="hidden" name="teacher_id" id="teacher_id"
                                value="{{ $data['teacher']->teacher_id }}">

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Ad Soyad</b> </div>
                                <input type="text" name="name" id="name" value="{{ $data['teacher']->name }}"
                                    required placeholder="{{ $data['teacher']->name }}" class="INPUT col-sm-7"
                                    maxlength="50">
                            </div>

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Sınıflar</b>

                                    <button
                                        style="border:#F5F4F6; position: absolute; right:5px; justify-content:center; border-radius: 6px; background-color: #F5F4F6; color: black;"
                                        class="btn btn-secondary dropdown-toggle btn-sm class-dropdown" type="button"
                                        id="classroomdropdown1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>

                                    <div id="classroomdropdown" class="dropdown-menu">
                                        <div>
                                            <nav id="searchNav" style="max-width: 10rem; border-radius: 5px;">
                                                <form class="form-inline">
                                                    <input style="height:1.7rem; font-size: 15px;" id="searchClass"
                                                        class="form-control mr-sm-2" type="search"
                                                        placeholder="&#x1F50E; Ara" aria-label="Ara">
                                                </form>
                                            </nav>
                                        </div>
                                        @php
                                            $sortedClasses = $data['classroom']->sort(function ($a, $b) {
                                                return strnatcmp($a->classroom_name, $b->classroom_name);
                                            });
                                        @endphp

                                        @foreach ($sortedClasses as $item)
                                            <div class="class-item">
                                                <input style="cursor: pointer;" type="checkbox"
                                                    id="classroom_{{ $item->classroom_id }}" name="classroom_id[]"
                                                    value="{{ $item->classroom_id }}">
                                                <label style="cursor: pointer;"
                                                    for="classroom_{{ $item->classroom_id }}">{{ $item->classroom_name }}</label>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                                {{-- TEMP ORIGINAL LARAVEL CODE --}}
                                <div id="createminibox" class="INPUT2 col-sm-7">
                                    @foreach ($data['teacher']->classrooms as $item)
                                        <div class="minibox2">

                                            <input style="display:none; cursor: pointer;" type="checkbox"
                                                id="classroom_{{ $item->classroom_id }}" name="classroom_id[]"
                                                value="{{ $item->classroom_id }}">
                                            <label style="cursor: pointer;"
                                                for="classroom_{{ $item->classroom_id }}">{{ $item->classroom_name }}</label>

                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <div id="courserow" class="row">
                                <div class="LABEL col-sm-4"><b>Ders</b></div>
                                <button style="font-size:16px; background-color: #F5F4F6; color: black;"
                                    class="btn btn-secondary dropdown-toggle btn-sm course-dropdown INPUT col-sm-7"
                                    type="button" id="dersDropdownButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ isset($data['teacher']->course->course_name) ? $data['teacher']->course->course_name : 'Seçiniz' }}

                                </button>
                                <input type="hidden" name="course_id" id="course_id"
                                    value="{{ $data['teacher']->course_id }}">
                                <div class="dropdown-menu close_dropdown" aria-labelledby="dersDropdownButton">
                                    <div>
                                        <nav id="searchNav3" style="width:90%; border-radius: 5px;">
                                            <form class="form-inline">
                                                <input style="height:1.7rem; font-size: 15px;" id="searchClass3"
                                                    class="form-control mr-sm-2" type="search"
                                                    placeholder="&#x1F50E; Ara" aria-label="Ara">
                                            </form>
                                        </nav>
                                    </div>

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

                                    @foreach ($sortedCourses as $item)
                                        <a class="dropdown-item course-item" href="#"
                                            data-course-id="{{ $item->course_id }}"
                                            onclick="setSelectedcourse('{{ $item->course_name }}', '{{ $item->course_id }}')">
                                            {{ $item->course_name }}
                                        </a>
                                    @endforeach


                                    {{-- @foreach ($data['courses'] as $item)
                                        <a class="dropdown-item course-item" href="#"
                                            data-course-id="{{ $item->course_id }}"
                                            onclick="setSelectedcourse('{{ $item->course_name }}', '{{ $item->course_id }}')">
                                            {{ $item->course_name }}
                                        </a>
                                    @endforeach --}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Kullanıcı Adı</b></div>
                                <input type="text" name="username" id="username"
                                    value="{{ $data['teacher']->username }}" required
                                    placeholder="{{ $data['teacher']->username }}" class="INPUT col-sm-7"
                                    maxlength="50">

                            </div>

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Telefon No</b></div>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ $data['teacher']->phone }}" required
                                    placeholder="{{ $data['teacher']->phone }}" class="INPUT col-sm-7"
                                    maxlength="14"  pattern="[0-9]{4}-[0-9]{3}-[0-9]{2}-[0-9]{2}" required>
                            </div>

                            <div id="regdiv2" class="registerdiv2 row">
                                @csrf
                                <div class="reg">
                                    <button type="submit" class="btn btn-light regdesign1"><strong>
                                            Öğretmeni Kaydet</strong></button>
                                </div>

                                @csrf
                                <div class="reg">
                                    <button id="del" type="submit" class="btn btn-light regdesign3"
                                        form="del"><strong>
                                            Öğretmeni Sil</strong></button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </form>
        </div>

        <form id="del"
            action="{{ route('get-delete-teacher', ['teacherId' => $data['teacher']->teacher_id]) }}" method="GET">
            <div id="confirmationModal" class="modal_2">
                <div class="modal-content_2">
                    <p>Öğretmeni silmek istediğine emin misin?</p>
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

        // Listen for click on regdesign2 button
        document.querySelector('.regdesign2').addEventListener('click', function(event) {
            event.preventDefault();

            // Show the confirmation modal for deletion
            displayModalForDeletion();
        });
        document.querySelector('.regdesign3').addEventListener('click', function(event) {
            event.preventDefault();

            // Show the confirmation modal for deletion
            displayModalForDeletion();
        });
    </script>

    <script>
        // Listen for changes in class-item checkboxes
        document.querySelectorAll('.class-item input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const classroomId = this.value; // Get the value of the selected checkbox

                if (this.checked) {
                    // If checkbox is checked, create a corresponding minibox2 element
                    const minibox = document.createElement('div');
                    minibox.className = 'minibox2 checked'; // Add necessary classes
                    minibox.innerHTML = `
            <input style="cursor:pointer;" type="checkbox" id="classroom_${classroomId}" name="classroom_id[]" value="${classroomId}" checked>
            <label style="cursor:pointer:" for="classroom_${classroomId}">${this.nextElementSibling.textContent}</label>
            `;

                    // Append the newly created minibox2 element to the container
                    document.getElementById('createminibox').appendChild(minibox);
                } else {
                    // If checkbox is unchecked, find and remove the corresponding minibox2 element
                    const miniboxToRemove = document.querySelector(
                        `.minibox2 input[value="${classroomId}"]`).parentNode;
                    miniboxToRemove.remove();
                }
            });
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
            window.location.href = "{{ route('get-our-teacher-page') }}";
            event.preventDefault();
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Prevent dropdown from closing on checkbox click
        $('#classroomdropdown').on('click', function(e) {
            if ($(this).hasClass('show')) {
                e.stopPropagation();
            }
        });

        // Close dropdown on document click when it's open
        $(document).on('click', function() {
            if ($('#classroomdropdown1').hasClass('show')) {
                $('#classroomdropdown1').removeClass('show');
            }
        });
    });
</script>

<script>
    document.querySelectorAll('.course-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let dersDropdown = document.querySelector('.course-dropdown');
            dersDropdown.textContent = selectedText;
        });
    });

    function setSelectedcourse(selected, id) {
        console.log('Selected course:', selected);
        console.log('Course ID:', id);
        document.getElementById('course_id').value = id;
    }
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
        const input2Container = document.getElementById('classroom_id');
        const existingLabels = new Set(); // To store existing label names

        miniboxes.forEach((minibox) => {
            const label = minibox.querySelector('label');
            const labelText = label.textContent.trim();

            if (existingLabels.has(labelText)) {
                miniboxes.remove(); // Remove duplicates
            } else {
                existingLabels.add(labelText); // Add the label text to the Set
            }
        });

        miniboxes.forEach((minibox) => {
            const checkbox = minibox.querySelector('input[type="checkbox"]');
            checkbox.checked = true; // Simulate check
            const input2Container = document.getElementById('createminibox');
            input2Container.appendChild(minibox); // Append only unique checkboxes
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const existingClassroomIds = new Set(); // To store existing classroom IDs

        const miniboxes = document.querySelectorAll('.minibox2');
        const input2Container = document.getElementById('classroom_id');

        miniboxes.forEach((minibox) => {
            const checkbox = minibox.querySelector('input[type="checkbox"]');
            const classroomId = checkbox.value;

            if (existingClassroomIds.has(classroomId)) {
                minibox.remove(); // Remove duplicates
            } else {
                existingClassroomIds.add(classroomId); // Add the classroom ID to the Set
            }
        });

        miniboxes.forEach((minibox) => {
            input2Container.appendChild(minibox); // Append only unique checkboxes
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
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchClass');
        const classItems = document.querySelectorAll('.class-item');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            classItems.forEach(item => {
                const label = item.querySelector('label');
                const text = label.textContent.toLowerCase();

                if (text.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput3 = document.getElementById('searchClass3');
        const labels3 = document.querySelectorAll('.course-item');

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
    document.addEventListener('DOMContentLoaded', function() {
        const yourForm = document.getElementById('yourFormId');

        // Handle form submission
        yourForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Remove duplicate inputs
            const uniqueClassroomIds = new Set();
            const classroomInputs = document.querySelectorAll('input[name="classroom_id[]"]');

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

        // Other code...
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
    document.getElementById('confirmationButton').addEventListener('click', function() {
        const val = document.getElementById('booleanValue');
        val.value = true;
        const pht = document.getElementById('teacherphoto');
        pht.src = "";

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
