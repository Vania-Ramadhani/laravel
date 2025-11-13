<?php
require 'data-karakter.php';

$katalog = new KatalogService($daftarKarakter);

$nama_yang_dicari = $_GET['nama'] ?? "";

$karakter_ditemukan = $katalog->findByName($nama_yang_dicari);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail: <?php echo ($karakter_ditemukan) ? htmlspecialchars($karakter_ditemukan->nama) : "Tidak Ditemukan"; ?></title>  
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="detail-container">
        
        <?php
        if ($karakter_ditemukan != null) {
            echo "<h1>" . htmlspecialchars($karakter_ditemukan->nama) . "</h1>";
            echo "<p><strong>Rarity:</strong> " . htmlspecialchars($karakter_ditemukan->rarity) . "</p>";
            echo "<p><strong>Afflatus:</strong> " . htmlspecialchars($karakter_ditemukan->afflatus) . "</p>";
            echo "<p><strong>Damage Type:</strong> " . htmlspecialchars($karakter_ditemukan->damageType) . "</p>";

            $tags_html = implode(", ", $karakter_ditemukan->tags);
            echo "<p><strong>Tags:</strong> <span class='tags'>" . htmlspecialchars($tags_html) . "</span></p>";
        } else {
            echo "<h1>Karakter Tidak Ditemukan</h1>";
            echo "<p class='error'>Maaf, karakter dengan nama '" . htmlspecialchars($nama_yang_dicari) . "' tidak ada di database kami.</p>";
        }
        ?>
        
        <hr>
        <a href="index.php"> &larr; Kembali ke Daftar</a>
    </div>

</body>
</html>