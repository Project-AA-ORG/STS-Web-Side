<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Duyuru Duzenle Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/announcementEdit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

    <style>
        body {
            overflow: hidden;
        }

        select[multiple] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            padding-right: 30px;
        }

        /* Style the selected options */
        select[multiple] option:checked {
            background-color: green;
            font-weight: bold;
            position: relative;
        }

        /* Add tick icon using CSS pseudo-element */
        select[multiple] option:checked::after {
            content: '\2713';
            /* Unicode for checkmark symbol */
            position: absolute;
            bottom: 7px;
            /* Adjust the position of the tick icon */
            color: black;
            /* Change color of the tick */
            font-weight: bold;
            /* Make the tick icon bold */
        }

        select.form-control {

            &[size],
            &[multiple] {
                height: 75px;
            }
        }

        .minibox_2 {
            -webkit-tap-highlight-color: transparent;
            /* For iOS */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .custom-select-1 {
            /* Add styles specific to the first select element */
            /* Example styles: */
            width: 100px;
            height: 120px;
            /* Add other styles */
        }

        p {
            margin: 0;
            display: inline;
        }

        hr{
            
        }
        #yourFormId{
            padding: 0;
            margin:0;
            display: inline;
        }
        #del{
            margin: 0;
            padding: 0;
            display: inline;
        }
    </style>

</head>

<body>

    <div class="bg_duyuru_duzenle">
        <!-- Sidebar tasarımı baslangıc -->
        @include('sidemenu')
        <!-- sidebar tasarımı son -->

        <div class="duzenle">

            <button style="display:inline; color: black;" class="btn back-btn"><i
                        class="fa-solid fa-arrow-left"></i></button>

            {{-- {{ route('get-update-teacher') }}" --}}
            <form id="yourFormId" action="" method="POST">
                @csrf


                <div class="Entrance" style="" >

                    <input style="display: inline" type="hidden" name="general_announcement_id" id="general_announcement_id"
                        value="general_announcement_id">

                    <div style="display: inline;" class="block">
                        <input type="text" name="announcement_title" id="announcement_title"
                            value="announcement_title" required placeholder="announcement_title" class="INPUT">
                    </div>

                    <hr>

                    <div style="display: inline" class="block">
                            <textarea style="resize: none;" id="announcement_content" name="announcement_content" required placeholder="announcement_content"
                                class="INPUT_2"></textarea>
                    </div>
                </div>
                <div class="kayıt" style="margin-left:10%;">

                    <button type="submit" class="btn btn-light kayıt_design"
                        style="background-color: #FF9595;"><strong>
                            Duyuruyu Kaydet</strong></button>

                </div>
            </form>
            {{-- {{ route('get-delete-teacher', ['teacherId' => $data['teacher']->teacher_id]) }} --}}

            <form id="del" action="" method="GET">

                @csrf
                <div class="kayıt" style="margin-left:27%;">
                    <button type="submit" class="btn btn-light kayıt_design"
                        style="background-color: #FF9595;"><strong>
                            Duyuruyu Sil</strong> </button>
                </div>
            </form>

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
    let sidebar = document.querySelector('.sidebar');
    let searchInput = document.getElementById('searchInput');

    document.getElementById('btn').addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    document.querySelector('.back-btn').addEventListener('click', function() {
        window.history.back();
    });
</script>


<script>
    document.querySelectorAll('.ders-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let dersDropdown = document.querySelector('.ders-dropdown');
            dersDropdown.textContent = selectedText;
        });
    });

    document.querySelectorAll('.sinif-item').forEach(item => {
        item.addEventListener('click', function() {
            let selectedText = this.textContent.trim();
            let sinifDropdown = document.querySelector('.sinif-dropdown');
            sinifDropdown.textContent = selectedText;
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

</html>
