<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Veli Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/parentEdit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">


</head>

<body>

    <div class="centerEdit">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div id="mainbox" class="duzenle container">
            <form id="yourFormId" action="{{ route('get-update-parent') }}" method="POST">

                <p id="backbutton_1"><button id="toclick" style="color: black;" class="btn back-btn"><i
                            class="fa-solid fa-arrow-left"></i></button></p>

                <div class="row row_1">

                    <div class="col-md-12">
                        <div id="secondbox" class="container Entrance">

                            <input type="hidden" name="parent_id" id="parent_id"
                                value="{{ $data['parent']->parent_id }}">

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Ad Soyad</b> </div>
                                <input type="text" name="name" id="name" value="{{ $data['parent']->name }}"
                                    required placeholder="{{ $data['parent']->name }}" class="INPUT col-sm-7">
                            </div>


                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Öğrencileri</b>

                                    <button
                                        style="border:#F5F4F6; position: absolute; right:5px; justify-content:center; border-radius: 6px; background-color: #F5F4F6; color: black;"
                                        class="btn btn-secondary dropdown-toggle btn-sm ogrenci-dropdown" type="button"
                                        id="ogrenciDropdown" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>

                                    <div id="studentDropdownButton" class="dropdown-menu">
                                        @foreach ($data['students'] as $item)
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
                                <div id="createminibox" class="INPUT_2 col-sm-7">
                                    @foreach ($data['parent']->students as $item)
                                        <div class="minibox_2">

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
                                    placeholder="{{ $data['parent']->username }}" class="INPUT col-sm-7">

                            </div>

                            <div class="row">
                                <div class="LABEL col-sm-4"><b>Telefon No</b></div>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ $data['parent']->phone }}" required
                                    placeholder="{{ $data['parent']->phone }}" class="INPUT col-sm-7">
                            </div>
                            <div id="kayıtdivi" class="row">
                                <div class="col-md-1"></div>
                                @csrf
                                <div class="kayıt col-md-4">
                                    <button type="submit" class="btn btn-light kayıt_design_2"><strong>
                                            Veliyi Kaydet</strong></button>
                                </div>
                                <div class="col-md-1"></div>

                                @csrf
                                <div class="kayıt col-md-4">
                                    <button id="del" type="submit" class="btn btn-light kayıt_design_3"
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
                // If checkbox is checked, create a corresponding minibox_2 element
                const minibox = document.createElement('div');
                minibox.className = 'minibox_2 checked'; // Add necessary classes
                minibox.innerHTML = `
                    <input style="cursor:pointer;" type="checkbox" id="student_${studentId}" name="student_id[]" value="${studentId}" checked>
                    <label style="cursor:pointer:" for="student_${studentId}">${this.nextElementSibling.textContent}</label>
                `;

                // Append the newly created minibox_2 element to the container
                document.getElementById('createminibox').appendChild(minibox);
            } else {
                // If checkbox is unchecked, find and remove the corresponding minibox_2 element
                const miniboxToRemove = document.querySelector(`.minibox_2 input[value="${studentId}"]`)
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
    const miniboxes = document.querySelectorAll('.minibox_2');

    // Add click event listener to each .minibox_2
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
        const checkboxes = document.querySelectorAll('.minibox_2 input[type="checkbox"]');

        checkboxes.forEach((checkbox) => {
            checkbox.checked = true; // Simulate check
            const minibox = checkbox.parentNode; // Get the parent .minibox_2 element
            minibox.classList.add('checked'); // Add a class to change color when checked
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const miniboxes = document.querySelectorAll('.minibox_2');
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
</html>
