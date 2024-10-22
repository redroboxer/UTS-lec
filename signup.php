<?php
session_start();
include __DIR__ . "/config/database.php"; // Pastikan path ini benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Simpan pengguna ke database
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    // Redirect ke halaman login setelah berhasil registrasi
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Screen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="bg-white min-h-screen flex items-center justify-center">
        <!-- Register Container -->
        <div class="bg-gray-100 flex rounded-2xl hover:shadow-blue-300 shadow-xl max-w-3xl p-5">

            <!-- Image -->
            <div class="w-1/2">
                <img class="sm:block hidden rounded-xl h-full" src="Image/login.webp" alt="Register Image">
            </div>

            <!-- Form -->
            <div class="sm:w-1/2 px-16">
                <h2 class="font-bold text-2xl text-blue-600">Sign Up</h2>
                <p class="text-xs mt-2">Buat akun baru untuk mengakses semua fitur yang tersedia</p>

                <form action="/Project-lec/user/register.php" method="POST" class="flex flex-col gap-4">
                    <input class="p-2 mt-6 rounded-xl border" type="text" placeholder="Nama Lengkap">
                    <input class="p-2 rounded-xl border" type="email" placeholder="Email">
                    <input class="p-2 rounded-xl border" type="password" placeholder="Password">
                    <button class="bg-blue-600 hover:bg-blue-300 rounded-xl text-white py-2">Register</button>
                </form>

                <div class="mt-10 grid grid-cols-3 items-center">
                    <hr class="border-gray-500">
                    <p class="text-center">OR</p>
                    <hr class="border-gray-500">
                </div>

                <p class="mt-5 text-xs border-b border-gray-400 py-2">Sudah punya akun?</p>

                <div class="mt-1 text-xs flex items-center justify-between">
                    <p>Login sekarang</p>
                    <a href="login.php">
                        <button class="py-2 px-5 bg-white border rounded-xl hover:bg-blue-600 hover:text-white transition ease-in-out delay-75">Login</button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
