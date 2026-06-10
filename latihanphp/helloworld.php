<?php 
    setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesia');
    $timezone = new DateTimeZone('Asia/Jakarta');
    $now = new DateTime('now', $timezone);
    $tanggal = strftime('%A, %d %B %Y', $now->getTimestamp());
    $waktu = $now->format('H:i:s');
    $produk = [
        [
            "nama"      => "Laptop",
            "kategori"  => "Elektronik",
            "harga"     => 8500000,
            "thumb"     => "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop",
            "title"     => "Laptop Pro 15",
            "desc"      => "Prosesor cepat, layar 15 inci, cocok untuk kerja dan kuliah.",
            "price"     => 8_500_000,
        ],
        [
            "nama"      => "Meja Belajar",
            "kategori"  => "Furniture",
            "harga"     => 750000,
            "thumb"     => "https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=400&h=300&fit=crop",
            "title"     => "Meja Belajar Kayu",
            "desc"      => "Meja minimalis dari kayu jati, kuat dan tahan lama.",
            "price"     => 750_000,
        ],
        [
            "nama"      => "Headphone",
            "kategori"  => "Aksesoris",
            "harga"     => 350000,
            "thumb"     => "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop",
            "title"     => "Headphone Wireless",
            "desc"      => "Suara jernih, noise cancelling, baterai tahan 30 jam.",
            "price"     => 350_000,
        ],
        [
            "nama"      => "Smartphone",
            "kategori"  => "Elektronik",
            "harga"     => 5500000,
            "thumb"     => "https://plus.unsplash.com/premium_photo-1680985551009-05107cd2752c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Z2FtYmFyJTIwc21hcnRwaG9uZXxlbnwwfHwwfHx8MA%3D%3D",
            "title"     => "Smartphone",
            "desc"      => "",
            "price"     => 5_500_000,
        ],
           [
            "nama"      => "Pesawat",
            "kategori"  => "Elektronik",
            "harga"     => 5500000,
            "thumb"     => "https://images.unsplash.com/photo-1619659085985-f51a00f0160a?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Z2FtYmFyJTIwcGVzYXdhdHxlbnwwfHwwfHx8MA%3D%3D",
            "title"     => "Pesawat Pribadi",
            "desc"      => "",
            "price"     => 5_500_000,
        ],
        [
            "nama"      => "Mobil",
            "kategori"  => "Elektronik",
            "harga"     => 5500000,
            "thumb"     => "https://images.unsplash.com/photo-1508974239320-0a029497e820?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Z2FtYmFyJTIwbW9iaWx8ZW58MHx8MHx8fDA%3D",
            "title"     => "Mobil Sport",
            "desc"      => "",
            "price"     => 5_500_000,
        ],
    ];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanggal, Waktu & Daftar Produk</title>
</head>
<body class="bg-gray-100 min-h-screen bg-[url('https://images.unsplash.com/photo-1780467763551-f182a0d55c9f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1MXx8fGVufDB8fHx8fA%3D%3D')] bg-cover bg-center">
    <div class="max-w-2xl mx-auto mt-10 px-4 flex flex-col gap-8">

        <div class="gradient-border shadow-2xl shadow-purple-500/40 mx-auto w-full max-w-sm">
            <div class="bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full text-center mx-auto mb-8">
                <h1 class="text-xl font-semibold mb-6">Tanggal dan Waktu Sekarang</h1>
                <p class="mb-4">
                    <span class="font-semibold">Tanggal</span><br>
                    <?= ucfirst($tanggal) ?>
                </p>
                <p>
                    <span class="font-semibold">Waktu</span><br>
                    <?= $waktu ?> WIB
                </p>
            </div>
        </div>


        <div class="gradient-border shadow-2xl shadow-purple-500/40">
            <div class="p-6 rounded-2xl">
                <h1 class="text-xl font-semibold text-center mb-6">Daftar Produk</h1>
                <table class="w-full border-collapse bg-white rounded-lg shadow overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Thumb</th>
                            <th class="px-4 py-3 text-left">Nama Produk</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produk as $i => $item): ?>
                        <tr class="border-b even:bg-gray-50">
                            <td class="px-4 py-3"><?= $i + 1 ?></td>
                            <td class="px-4 py-3">
                                <?php if (!empty($item["thumb"])): ?>
                                    <img src="<?= htmlspecialchars($item["thumb"]) ?>" alt="<?= htmlspecialchars($item["title"]) ?>" class="w-16 h-12 object-cover rounded">
                                <?php else: ?>
                                    <span class="text-gray-400 text-sm">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?= htmlspecialchars($item["nama"]) ?>
                                <?php if (!empty($item["title"]) && $item["title"] !== $item["nama"]): ?>
                                    <br><span class="text-xs text-gray-500"><?= htmlspecialchars($item["title"]) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3"><?= htmlspecialchars($item["kategori"]) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600"><?= htmlspecialchars($item["desc"]) ?></td>
                            <td class="px-4 py-3 text-right">Rp <?= number_format($item["harga"], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="gradient-border shadow-2xl shadow-purple-500/40">
            <div class="p-6 rounded-2xl">
                <h1 class="text-2xl font-semibold text-center mb-8">Katalog Produk</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($produk as $item): ?>
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <?php if (!empty($item['thumb'])): ?>
                            <img src="<?= $item['thumb'] ?>" alt="<?= htmlspecialchars($item['title']) ?>"
                                class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">No Image</div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h2 class="font-semibold text-lg mb-1">
                                <?= htmlspecialchars($item['title']) ?>
                            </h2>
                            <p class="text-gray-600 text-sm mb-3">
                                <?= htmlspecialchars($item['desc']) ?>
                            </p>
                            <span class="text-blue-600 font-bold">
                                Rp <?= number_format($item['price'], 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</body>
</html>