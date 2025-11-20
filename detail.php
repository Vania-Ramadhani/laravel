<?php
require 'data-karakter.php'; //manggil file data karakter

$katalog = new KatalogService($daftarKarakter); //bikin class katalogsevice, diopen dari daftar karakter

$nama_yang_dicari = $_GET['nama'] ?? ""; //pengambilan string, ?? buat perintah jika data tidak ditemukan, diisi data kosong

$karakter_ditemukan = $katalog->findByName($nama_yang_dicari);
?>

<!DOCTYPE html>
<html lang="en"> <!--netepin bahasa-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--bikin responsif-->
    <title>Detail: <?php echo ($karakter_ditemukan) ? htmlspecialchars($karakter_ditemukan->nama) : "Tidak Ditemukan"; ?></title>  
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="detail-container">
        
        <?php
        if ($karakter_ditemukan != null) { //tidak sama dengan null
            echo "<h1>" . htmlspecialchars($karakter_ditemukan->nama) . "</h1>";
            echo "<p><strong>Rarity:</strong> " . htmlspecialchars($karakter_ditemukan->rarity) . "</p>"; //htmlspecialchars buat security, ngubah karakter berbahaya jadi entity html
            echo "<p><strong>Afflatus:</strong> " . htmlspecialchars($karakter_ditemukan->afflatus) . "</p>";
            echo "<p><strong>Damage Type:</strong> " . htmlspecialchars($karakter_ditemukan->damageType) . "</p>";
            //semua output dari file lain dikasih htmlspecialchars biar aman

            $tags_html = implode(", ", $karakter_ditemukan->tags); //menggabungkan string
            echo "<p><strong>Tags:</strong> <span class='tags'>" . htmlspecialchars($tags_html) . "</span></p>";
        } else {
            echo "<h1>Karakter Tidak Ditemukan</h1>";
            echo "<p class='error'>karakter'" . htmlspecialchars($nama_yang_dicari) . "' tidak ditemukan.</p>";
        }
        ?>
        
        <hr> <!--balik ke daftar utama-->
        <a href="index.php"> &larr; Back</a>
    </div>

</body>
</html>