<?php
session_start();
include 'koneksi.php';

$id = ''; $nama = ''; $email = ''; $update_mode = false;

// Logika Simpan / Update
if (isset($_POST['save'])) {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password_val = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_POST['id'] != '') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE users SET nama=?, email=?, password=? WHERE id=?");
        $stmt->execute([$nama, $email, $password_val, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$nama, $email, $password_val]);
    }
    header('Location: daftar.php'); 
    exit;
}

// Logika Hapus
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
    $stmt->execute([$id]);
    header('Location: daftar.php'); 
    exit;
}

// Logika Get Data untuk Edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update_mode = true;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    if ($user) {
        $nama = $user['nama'];
        $email = $user['email'];
    }
}

// Ambil semua data anggota
$users = $pdo->query("SELECT * FROM users")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota | SYNSS LIBRARY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-200 py-10 px-5">

    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8">
        
        <div class="bg-slate-900 border border-slate-800 p-8 rounded-lg self-start">
            <h2 class="text-xl font-bold tracking-widest text-emerald-400 mb-6 uppercase">
                <?= $update_mode ? 'Edit Anggota' : 'Anggota Baru' ?>
            </h2>
            <form action="daftar.php" method="POST" class="space-y-5">
                <input type="hidden" name="id" value="<?= $id; ?>">
                
                <div>
                    <label class="block text-xs uppercase tracking-wider text-slate-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($nama); ?>" required 
                           class="w-full bg-slate-950 border border-slate-800 rounded px-4 py-2 focus:outline-none focus:border-emerald-500">
                </div>
                
                <div>
                    <label class="block text-xs uppercase tracking-wider text-slate-400 mb-2">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email); ?>" required 
                           class="w-full bg-slate-950 border border-slate-800 rounded px-4 py-2 focus:outline-none focus:border-emerald-500">
                </div>
                
                <div>
                    <label class="block text-xs uppercase tracking-wider text-slate-400 mb-2">Password Akun</label>
                    <input type="password" name="password" placeholder="Masukkan password" required 
                           class="w-full bg-slate-950 border border-slate-800 rounded px-4 py-2 focus:outline-none focus:border-emerald-500">
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="submit" name="save" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold uppercase py-2 rounded transition">
                        <?= $update_mode ? 'Update' : 'Simpan' ?>
                    </button>
                    <?php if ($update_mode): ?>
                        <a href="daftar.php" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold uppercase py-2 px-4 rounded transition text-center">Batal</a>
                    <?php endif; ?>
                </div>
                <div class="text-center mt-4 border-t border-slate-800 pt-4">
                     <a href="login.php" class="text-xs text-slate-400 hover:text-emerald-400 transition">Kembali ke Login</a>
                </div>
            </form>
        </div>

        <div class="md:col-span-2 bg-slate-900 border border-slate-800 rounded-lg overflow-hidden">
            <div class="p-6 border-b border-slate-800">
                <h2 class="text-lg font-bold tracking-widest text-slate-200 uppercase">Data Anggota Perpustakaan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-400">
                    <thead class="text-xs uppercase bg-slate-800 text-slate-300">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <?php if (count($users) > 0): ?>
                            <?php foreach ($users as $row): ?>
                                <tr class="hover:bg-slate-800/50">
                                    <td class="px-6 py-4"><?= $row['id']; ?></td>
                                    <td class="px-6 py-4 font-medium text-white"><?= htmlspecialchars($row['nama']); ?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($row['email']); ?></td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="daftar.php?edit=<?= $row['id']; ?>" class="text-emerald-400 hover:text-emerald-300 border border-emerald-500/30 hover:border-emerald-400 px-3 py-1 rounded text-xs transition">Edit</a>
                                        <a href="daftar.php?delete=<?= $row['id']; ?>" class="text-red-400 hover:text-red-300 border border-red-500/30 hover:border-red-400 px-3 py-1 rounded text-xs transition" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic">Belum ada data pendaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>