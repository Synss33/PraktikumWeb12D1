<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    header('Location: toko.php');
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR nama = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nama'] = $user['nama'];
        header('Location: toko.php');
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SYNSS LIBRARY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 flex items-center justify-center min-h-screen text-slate-200">

    <div class="bg-slate-900 border border-slate-800 p-10 rounded-lg shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold tracking-widest text-emerald-400">SYNSS LIBRARY</h2>
            <p class="text-xs tracking-widest text-slate-500 uppercase mt-2">Portal Layanan Mandiri</p>
        </div>
        
        <?php if($error): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-3 rounded mb-6 text-sm text-center">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-400 mb-2">Username / Email</label>
                <input type="text" name="username" placeholder="Masukkan nama atau email" required 
                       class="w-full bg-slate-950 border border-slate-800 rounded px-4 py-3 focus:outline-none focus:border-emerald-500 transition">
            </div>
            
            <div>
                <label class="block text-xs uppercase tracking-wider text-slate-400 mb-2">Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required 
                       class="w-full bg-slate-950 border border-slate-800 rounded px-4 py-3 focus:outline-none focus:border-emerald-500 transition">
            </div>
            
            <button type="submit" name="login" 
                    class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold uppercase tracking-wider py-3 rounded transition duration-300">
                Masuk Sistem
            </button>
        </form>

        <p class="mt-6 text-center text-xs text-slate-500">
            Belum punya akun? <a href="daftar.php" class="text-emerald-400 hover:underline">Daftar di sini</a>
        </p>
    </div>

</body>
</html>