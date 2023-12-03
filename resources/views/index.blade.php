<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Giris Ekrani</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('css/login_tasarım.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="/images/square_logo2.png" type="image/x-icon">

</head>

<body class="bg">


            <div class="parent">
                <img src="/images/download-removebg-preview.png" alt=""">
            </div>
        <div class= "adminGiris">
            
                <label for="gir" class="giris"><b>
                        <h4>ADMIN GIRISI</h4>
                    </b></label>
                <br><br>
                <hr>
                <form action="{{route('home-page')}}" method="post">
                    @csrf

                    <div class="verigiris1">
                        <i class="fa-regular fa-user" style="margin-left: 10px; color: whitesmoke;"></i>
                        <input type="text" id="username" name="username" required placeholder="Kullanıcı Adı" class="labeldesign">

                    </div>
                    <div class="verigiris2">
                        <i class="fa-solid fa-lock" style="margin-left: 10px; color: whitesmoke;"></i>
                        <input type="password" id="password" name="password" required placeholder="Şifre" class="labeldesign">
                    </div>

                    <div class="girisbuton">
                        <button style="color: blue;" type="submit" class="btn btn-light"><b> GIRIS YAP </b></button>
                    </div>

                    @if(isset($data['error_message']))
                        <p class="error-message">{{$data['error_message']}}</p>
                    @endif
                </form>

            </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>
</html>