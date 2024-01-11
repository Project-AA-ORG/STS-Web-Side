<!DOCTYPE html>
<html lang="tr">
{{-- Giriş sayfası --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Şenay Duran Okulları Yönetici Paneli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

</head>

<style>
    .transparent-cream-rgba {
        background-color: rgba(255, 240, 200, 0.7);
        /* Adjust the last value for transparency (0 for fully transparent, 1 for fully opaque) */
    }

    .transparent-dark-gray {
        background-color: rgba(50, 50, 50, 0.7);
        /* Change the last value (0.7) to adjust transparency (0 for fully transparent, 1 for fully opaque) */
    }

    .transparent-light-gray-hsla {
        background-color: hsla(0, 0%, 70%, 0.5);
        /* Adjust the last value for transparency */
    }
</style>

<body>

    <div style="display: none;"><h1>Şenay Duran Okulları, Darıca Genç Bilim Koleji</h1></div>

    <div class="backgr pencils">
        {{-- sol üstteki logo --}}

        <div class="Logo">
            <img src="/images/download-removebg-preview.png" alt="Main Logo">
        </div>

        {{-- ekranın ortasındaki şifre, ve kullanıcı adının girileceği butonun koyulacağı yer --}}
        <div class = "adminGiris">

            <div class="title">
                <h4 id="tit">YÖNETİCİ ÖZEL GİRİŞİ</h4>
            </div>
            <hr>
            <div class="enter">
                {{-- Form-post yöntemi ile girilen bilgiler backend'e gönderilir  --}}
                <form action="{{ route('home-page') }}" method="post">
                    @csrf

                    {{-- kullanıcı adı inputu --}}
                    <div class="verigiris1">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="username" name="username" required placeholder="Kullanıcı Adı"
                            class="labeldesign" maxlength="50">
                    </div>

                    {{-- şifre inputu --}}
                    <div class="verigiris2">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" required placeholder="Şifre"
                            class="labeldesign" maxlength="50">
                    </div>

                    {{-- backend'e gönderme butonu --}}
                    <div>
                        @if (isset($data['error_message']))
                            <p class="error-message">{{ $data['error_message'] }}</p>
                        @endif
                        <button type="submit" class="girisbutton btn btn-light"><b> GİRİŞ YAP </b></button>
                    </div>

                </form>
            </div>
        </div>




    </div>


    </div>




    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>

</html>
