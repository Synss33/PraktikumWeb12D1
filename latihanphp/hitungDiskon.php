<?php
function hitungDiskon($hargaAwal, $persenDiskon) {
    $potongan = $hargaAwal * ($persenDiskon / 100);
    return $hargaAwal - $potongan;
}

$hargaSetelahDiskon = "";
$hargaInput = "";
$diskonInput = "";

if (isset($_POST['hitung'])) {
    $hargaInput = filter_var($_POST['harga'], FILTER_SANITIZE_NUMBER_INT);
    $diskonInput = filter_var($_POST['diskon'], FILTER_SANITIZE_NUMBER_INT);

    if (!empty($hargaInput) && !empty($diskonInput)) {
        $hargaSetelahDiskon = hitungDiskon($hargaInput, $diskonInput);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Smart Discount Calculator</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Warna khas E-Commerce Premium (Vibrant Orange & Deep Blue) */
            --primary: #ff471a;
            --primary-gradient: linear-gradient(135deg, #ff6b4a 0%, #ff471a 100%);
            --secondary: #0f172a;
            --bg-page: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #cbd5e1;
            --accent-green: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            /* Background bermotif kotak halus khas aplikasi belanja + gradasi lembut */
            background-color: #f4f6f9;
            background-image: 
                radial-gradient(#e2e8f0 1.5px, transparent 1.5px), 
                radial-gradient(#e2e8f0 1.5px, #f4f6f9 1.5px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
            
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-main);
            padding: 20px;
        }

        /* Container Utama bergaya halaman checkout / flash sale */
        .app-container {
            width: 100%;
            max-width: 440px;
            position: relative;
        }

        /* Banner Flash Sale di atas Card untuk interaksi visual */
        .promo-badge {
            background: #ffebe7;
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 100px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
            border: 1px solid #ffd4cc;
            letter-spacing: 0.05em;
        }

        .promo-badge::before {
            content: "⚡";
        }

        /* Card didesain mirip Product Detail Box */
        .card {
            background: var(--bg-card);
            padding: 36px 32px;
            border-radius: 24px;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.1);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        /* Aksen garis estetik di bagian atas kartu */
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--primary-gradient);
        }

        .header {
            margin-bottom: 28px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--secondary);
            letter-spacing: -0.02em;
        }

        .header p {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Prefix mata uang Rp dan % bergaya E-commerce input */
        .input-prefix {
            position: absolute;
            left: 16px;
            font-weight: 700;
            color: var(--text-muted);
            font-size: 15px;
        }

        .input-suffix {
            position: absolute;
            right: 16px;
            font-weight: 700;
            color: var(--text-muted);
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            color: var(--secondary);
            transition: all 0.23s ease;
            outline: none;
        }

        /* Input khusus harga perlu padding kiri untuk 'Rp' */
        input#harga {
            padding-left: 45px;
        }

        /* Input khusus diskon perlu padding kanan untuk '%' */
        input#diskon {
            padding-right: 40px;
        }

        input:focus {
            border-color: #ffaa95;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(255, 71, 26, 0.1);
        }

        /* Tombol 'Beli / Hitung' Besar dan Nyaman di-klik */
        button {
            width: 100%;
            padding: 16px;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(255, 71, 26, 0.25);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(255, 71, 26, 0.35);
        }

        button:active {
            transform: translateY(0);
        }

        /* Result Box bergaya struktur Nota / Voucher Belanja */
        .result-container {
            margin-top: 28px;
            padding: 24px;
            background: #fffbfa;
            border-radius: 16px;
            border: 2px dashed #ffd4cc; /* Efek potongan kupon */
            position: relative;
            animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Ornamen setengah lingkaran di sisi kanan & kiri kupon */
        .result-container::before, .result-container::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 14px;
            height: 14px;
            background: #f4f6f9; /* Harus sama dengan background body */
            border-radius: 50%;
        }
        .result-container::before { left: -9px; transform: translateY(-50%); border-right: 2px dashed #ffd4cc; }
        .result-container::after { right: -9px; transform: translateY(-50%); border-left: 2px dashed #ffd4cc; }

        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .result-divider {
            border-top: 1px solid #ffe5e0;
            margin: 12px 0;
        }

        .total-label {
            font-weight: 700;
            color: var(--secondary);
            font-size: 15px;
        }

        .total-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
        }

        .save-badge {
            background: var(--accent-green);
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="app-container">
    <center>
        <div class="promo-badge">Smart Shopping Mode</div>
    </center>
    
    <div class="card">
        <div class="header">
            <h1>Kalkulator Diskon</h1>
            <p>Hitung harga promo flash sale & kupon belanjaanmu</p>
        </div>

        <form method="post">
            <div class="form-group">
                <label for="harga">Harga Original</label>
                <div class="input-wrapper">
                    <span class="input-prefix">Rp</span>
                    <input type="number" name="harga" id="harga" placeholder="0" value="<?= htmlspecialchars($hargaInput) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="diskon">Diskon Toko</label>
                <div class="input-wrapper">
                    <input type="number" name="diskon" id="diskon" placeholder="0" min="0" max="100" value="<?= htmlspecialchars($diskonInput) ?>" required>
                    <span class="input-suffix">% OFF</span>
                </div>
            </div>

            <button type="submit" name="hitung">
                Terapkan Diskon
            </button>
        </form>

        <?php if ($hargaSetelahDiskon !== ""): ?>
            <div class="result-container">
                <div class="result-row">
                    <span style="color: var(--text-muted);">Harga Awal:</span>
                    <span style="text-decoration: line-through; color: var(--text-muted); font-weight: 500;">
                        Rp <?= number_format($hargaInput, 0, ',', '.'); ?>
                    </span>
                </div>
                <div class="result-row">
                    <span style="color: var(--text-muted);">Total Hemat:</span>
                    <span class="save-badge">
                        - Rp <?= number_format($hargaInput - $hargaSetelahDiskon, 0, ',', '.'); ?>
                    </span>
                </div>
                
                <div class="result-divider"></div>
                
                <div class="result-row" style="margin-bottom: 0;">
                    <span class="total-label">Harga Akhir:</span>
                    <span class="total-value">
                        Rp <?= number_format($hargaSetelahDiskon, 0, ',', '.'); ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>