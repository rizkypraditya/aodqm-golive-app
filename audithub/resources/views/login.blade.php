<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/lgin.css">
    <link href="https://fonts.google.com/selection?query=poppins" rel="stylesheet">
    <title>AuditHub Login</title>
</head>
<body style="background-image: url('assets/img/bag.png');">
<div class="login-container">
    <h1>AuditHub</h1>
    <h4>by Telkom</h4>
    <div class="login-box">
        <form action="" method="post">
            @csrf
            <div class="input-group">
                <input type="email" name="email" placeholder="Username" required value="{{old('email')}}">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <button type="submit">LOGIN</button>
                @if($errors->any()) 
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                            <li>{{$item}}</li>    
                            @endforeach
                        </ul>
                    </div>
                @endif   
            </div>
        </form>
        <a href="/forgot-password">Lupa Password?</a>
        <p>Masukkan username dan password yang telah dikonfirmasi admin</p>
    </div>
</div>
</body>
</html>
