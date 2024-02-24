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
        <form action="/login" method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <select name="role" required>
                    <option value="" disabled selected>Choose Role</option>
                    <option value="mitra">Mitra</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="input-group">
                <button type="submit">LOGIN</button>
            </div>
        </form>
        <a href="/forgot-password">Lupa Password?</a>
        <p>Masukkan username dan password yang telah dikonfirmasi admin</p>
    </div>
</div>
</body>
</html>
