<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user_nama = $_SESSION['user_nama'];

if (isset($_GET['beli'])) {
    $barang_id = $_GET['beli'];
    $stmt = $pdo->prepare("SELECT * FROM keranjang WHERE user_id = ? AND barang_id = ?");
    $stmt->execute([$user_id, $barang_id]);
    $cek = $stmt->fetch();

    if ($cek) {
        $stmt = $pdo->prepare("UPDATE keranjang SET jumlah = jumlah + 1 WHERE id = ?");
        $stmt->execute([$cek['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO keranjang (user_id, barang_id, jumlah) VALUES (?, ?, 1)");
        $stmt->execute([$user_id, $barang_id]);
    }

    header('Location: toko.php#keranjang-section');
    exit;
}

if (isset($_GET['hapus'])) {
    $keranjang_id = $_GET['hapus'];
    $stmt = $pdo->prepare("DELETE FROM keranjang WHERE id = ? AND user_id = ?");
    $stmt->execute([$keranjang_id, $user_id]);

    header('Location: toko.php#keranjang-section');
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

$barang_toko = $pdo->query("SELECT * FROM barang")->fetchAll();
$stmt = $pdo->prepare("SELECT k.id, b.nama_barang, b.harga, k.jumlah FROM keranjang k 
                       JOIN barang b ON k.barang_id = b.id 
                       WHERE k.user_id = ?");
$stmt->execute([$user_id]);
$keranjang_user = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYNSS LIBRARY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #0f172a; color: #ffffff; }
    </style>
</head>
<body>

    <nav class="flex justify-between items-center px-10 py-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-md sticky top-0 z-50">
        <div class="flex items-center space-x-2">
            <span class="font-bold tracking-widest text-sm text-emerald-400">SYNSS LIBRARY</span>
        </div>
        <div class="text-xs text-slate-300">
            Halo Pembaca, <span class="text-white font-semibold"><?php echo htmlspecialchars($user_nama); ?></span> | 
            <a href="toko.php?logout=1" class="text-red-400 hover:underline ml-2">Logout</a>
        </div>
    </nav>

    <main class="px-10 py-20">
        <div class="text-center mb-16">
            <p class="text-xs tracking-widest text-slate-500 uppercase">Katalog Buku Digital</p>
            <h2 class="text-2xl font-bold uppercase tracking-wider text-slate-200 mt-1">Perluas Wawasan Anda Hari Ini</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $images = [
                'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=500&q=80',
                'https://images.unsplash.com/photo-1506880018603-83d5b814b5a6?auto=format&fit=crop&w=500&q=80', 
                'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=500&q=80',
                'https://www.ynharari.com/wp-content/uploads/2017/01/sapiens.png',
                'https://images.unsplash.com/photo-1592496431122-2349e0fbc666?q=80&w=1212&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://image.gramedia.net/rs:fit:0:0/plain/https://cdn.gramedia.com/uploads/items/img20220905_11493451.jpg'            ];
            $i = 0;
            foreach ($barang_toko as $b): 
                $img_url = $images[$i % count($images)];
                $i++;
            ?>
                <div class="bg-slate-900 border border-slate-800 rounded-lg overflow-hidden group hover:border-emerald-800 transition duration-300">
                    <div class="h-72 overflow-hidden relative">
                        <img src="<?php echo $img_url; ?>" alt="Buku" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                        <span class="absolute bottom-4 left-4 bg-emerald-950/80 border border-emerald-500 px-3 py-1 text-xs text-emerald-400 rounded font-bold">
                            Denda Telat: Rp <?php echo number_format($b['harga'], 0, ',', '.'); ?>/hari
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white mb-2"><?php echo htmlspecialchars($b['nama_barang']); ?></h3>
                        <p class="text-xs text-slate-400 mb-6">Pinjam buku ini untuk memperkaya literasi dan pengetahuan Anda. Harap kembalikan tepat waktu.</p>
                        
                        <a href="toko.php?beli=<?php echo $b['id']; ?>" class="block text-center w-full bg-emerald-500 text-slate-950 font-bold text-xs py-3 rounded hover:bg-emerald-400 transition uppercase tracking-wider">
                         PINJAM BUKU
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <section id="keranjang-section" class="px-10 py-16 bg-slate-950 border-t border-slate-900">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl font-bold uppercase tracking-wider mb-8 text-center text-emerald-400"> Daftar Pinjaman Buku Anda</h2>
            
            <div class="overflow-x-auto bg-slate-900 border border-slate-800 rounded-lg">
                <table class="w-full text-sm text-left text-slate-400">
                    <thead class="text-xs uppercase bg-slate-800 text-slate-300 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Judul Buku</th>
                            <th class="px-6 py-4">Estimasi Denda/Hari</th>
                            <th class="px-6 py-4">Jumlah (Ekspl)</th>
                            <th class="px-6 py-4">Total Risiko Denda</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <?php 
                        $total_belanja = 0;
                        if (count($keranjang_user) > 0): 
                            foreach ($keranjang_user as $k): 
                                $subtotal = $k['harga'] * $k['jumlah'];
                                $total_belanja += $subtotal;
                        ?>
                            <tr class="hover:bg-slate-800/50 transition">
                                <td class="px-6 py-4 font-medium text-white"><?php echo htmlspecialchars($k['nama_barang']); ?></td>
                                <td class="px-6 py-4">Rp <?php echo number_format($k['harga'], 0, ',', '.'); ?></td>
                                <td class="px-6 py-4"><?php echo $k['jumlah']; ?> Buku</td>
                                <td class="px-6 py-4 text-white font-semibold">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <a href="toko.php?hapus=<?php echo $k['id']; ?>" 
                                       class="bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white px-3 py-1 rounded text-xs transition"
                                       onclick="return confirm('Batalkan peminjaman buku ini?')">
                                        Batal
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                            <tr class="bg-slate-900/80 font-bold text-white">
                                <td colspan="3" class="px-6 py-5 text-right tracking-wider uppercase text-slate-400">Total Akumulasi Risiko Denda:</td>
                                <td colspan="2" class="px-6 py-5 text-xl text-amber-400">Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">Belum ada buku yang dipilih</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <footer class="text-center py-8 text-xs text-slate-600 border-t border-slate-900 bg-slate-950">
        <p>© 2026 Perpustakaan Digital Proyek. UI Theme Swapped.</p>
    </footer>

</body>
</html>