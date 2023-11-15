<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            margin-bottom: 5px;
            color: #333;
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        @if(isset($data['error_message']))
            <h1> {{$data['error_message']}} </h1>
        @endif
        <form action = "{{route('login-control-page')}}" method="post">
            @csrf
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>


<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


<script>

    function controlForLogin(){
        var username = $("#username").val();
        var password = $("#password").val();

        $.ajax({
            type: "GET",
            url: '{{route("login-control-page")}}',
            data: {username:username , password:password},
            success: function(data){
                if(data.hasOwnProperty("error_message")){
                    alert(data.error_message);
                }
                else{
                    if(data.hasOwnProperty("successful")){
                        console.log("Başarılı");
                        window.location.href = data.redirect;
                    }
                }
            },
            error: function(xhr, status, error){
                console.log(error);
            }
        });
    }
</script> -->