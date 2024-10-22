<?php
session_start();
include __DIR__ . "/config/database.php"; // Pastikan path ini benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    // Persiapkan statement untuk memeriksa email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        header("Location: profile.php"); // Redirect ke halaman profile
        exit();
    } else {
        echo "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Screen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!---->
    <div class="bg-white min-h-screen flex items-center justify-center">
        <!--Login Container-->
        <div class="bg-gray-100 flex rounded-2xl hover:shadow-blue-300 shadow-xl max-w-3xl p-5">

            <!--form-->
            <div class="sm:w-1/2 px-16">
                <h2 class="font-bold text-2xl text-blue-600">Sign In</h2>
                <p class="text-xs mt-2">Jika anda sudah punya akun, tinggal langsung login</p>

                <!-- Update form with method and action -->
                <form action="/Project-lec/user/login.php" method="POST" class="flex flex-col gap-4">
                    <input class="p-2 mt-6 rounded-xl border" type="email" name="email" placeholder="Email" required>
                    <input class="p-2 rounded-xl border" type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-300 rounded-xl text-white py-2">Login</button>
                </form>

                <div class="mt-10 grid grid-cols-3 items-center">
                    <hr class="border-gray-500">
                    <p class="text-center">OR</p>
                    <hr class="border-gray-500">
                </div>

                <p class="mt-2 text-xs border-b border-gray-400 py-2">Forgot Your Password?</p>

                <div class="mt-2 text-xs flex items-center justify-between">
                    <p>Belum punya akun?</p>
                    <a href="signup.php">
                        <button class="py-2 px-5 bg-white border rounded-xl hover:bg-blue-600 hover:text-white transition ease-in-out delay-75">Register</button>
                    </a>
                </div>
            </div>

            <!--image-->
            <div class="w-1/2">
                <img class="sm:block hidden rounded-xl h-full" src="Image/login.webp" alt="#">
            </div>
        </div>
    </div>
</body>
</html>
