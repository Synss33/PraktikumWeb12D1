<?php

$username = '';
$password = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // =============================================
    // TUGAS 1: Tambahkan validasi di sini
    // - Jika username atau password kosong, tampilkan pesan error
    // - Jika username = "admin" dan password = "12345", tampilkan pesan sukses
    // - Jika salah, tampilkan pesan "Username atau password salah!"
    // =============================================

    if(empty($username)||empty($password)) {
        $error ='Masukkan Username dan Password yang Tersedia';
    } 
    elseif ($username === 'Isa Yanus' && $password === 'isaisaisa') {
        $success ='Login Success, Welcome ' . htmlspecialchars($username) . ' ;)';
    } 
    else{
        $error ='Username atau Password Salah';
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full">
        <h1 class="text-xl font-semibold text-center mb-6">Login</h1>

        <?php if ($error): ?>
            <p class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Username</label>
                <input
                    type="text"
                    name="username"
                    value="<?= htmlspecialchars($username) ?>"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan username">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan password">
            </div>

            <!-- ============================================= -->
            <!-- TUGAS 2: Tambahkan checkbox "Remember me"    -->
            <!-- di antara password dan tombol login di bawah  -->
            <!-- ============================================= -->

            <div class="mb-4 flex items-center gap-2">
                <input
                    type="checkbox"
                    id="rememberme"
                    class="w-4 h-4 accent-blue-600">
                <label for="rememberme" class="text-sm text-gray-600">Remember me</label>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

</body>

</html>
