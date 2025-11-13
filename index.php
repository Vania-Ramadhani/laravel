<?php
require 'data-karakter.php';

$katalog = new KatalogService($daftarKarakter);

$filter_pilihan = [
    'search'      => $_GET['search'] ?? "",
    'rarity'      => $_GET['rarity'] ?? "",
    'afflatus'    => $_GET['afflatus'] ?? "",
    'damage_type' => $_GET['damage_type'] ?? "",
    'tag'         => $_GET['tag'] ?? ""
];

$karakter_terfilter = $katalog->filter($filter_pilihan);

$search_term       = $filter_pilihan['search'];
$rarity_terpilih   = $filter_pilihan['rarity'];
$afflatus_terpilih = $filter_pilihan['afflatus'];
$damage_terpilih   = $filter_pilihan['damage_type'];
$tag_terpilih      = $filter_pilihan['tag'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Karakter Reverse: 1999</title>  
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Katalog Karakter Reverse: 1999</h1>
    <form action="index.php" method="GET" class="filter-container">
        <div class="filter-group">
            <label for="search-input">Search Name:</label>
            <input type="text" name="search" id="search-input" placeholder="Ketik nama..." value="<?php echo htmlspecialchars($search_term); ?>">
        </div>

        <div class="filter-group">
            <label for="rarity-select">Rarity:</label>
            <select name="rarity" id="rarity-select">
                <option value="">-- Semua --</option>
                <option value="Bintang 6" <?php if ($rarity_terpilih == "Bintang 6") echo "selected"; ?>>Bintang 6</option>
                <option value="Bintang 5" <?php if ($rarity_terpilih == "Bintang 5") echo "selected"; ?>>Bintang 5</option>
                <option value="Bintang 4" <?php if ($rarity_terpilih == "Bintang 4") echo "selected"; ?>>Bintang 4</option>
            </select>
        </div>
        
        <div class="filter-group">
            <label for="afflatus-select">Afflatus:</label>
            <select name="afflatus" id="afflatus-select">
                <option value="">-- Semua --</option>
                <option value="Beast" <?php if ($afflatus_terpilih == "Beast") echo "selected"; ?>>Beast</option>
                <option value="Intellect" <?php if ($afflatus_terpilih == "Intellect") echo "selected"; ?>>Intellect</option>
                <option value="Mineral" <?php if ($afflatus_terpilih == "Mineral") echo "selected"; ?>>Mineral</option>
                <option value="Plant" <?php if ($afflatus_terpilih == "Plant") echo "selected"; ?>>Plant</option>
                <option value="Spirit" <?php if ($afflatus_terpilih == "Spirit") echo "selected"; ?>>Spirit</option>
                <option value="Star" <?php if ($afflatus_terpilih == "Star") echo "selected"; ?>>Star</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="damage-select">Damage Type:</label>
            <select name="damage_type" id="damage-select">
                <option value="">-- Semua --</option>
                <option value="Reality" <?php if ($damage_terpilih == "Reality") echo "selected"; ?>>Reality</option>
                <option value="Mental" <?php if ($damage_terpilih == "Mental") echo "selected"; ?>>Mental</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="tag-select">Tags:</label>
            <select name="tag" id="tag-select">
                <option value="">-- Semua --</option>
                <option value="Heal" <?php if ($tag_terpilih == "Heal") echo "selected"; ?>>Heal</option>
                <option value="Support" <?php if ($tag_terpilih == "Support") echo "selected"; ?>>Support</option>
                <option value="Shield" <?php if ($tag_terpilih == "Shield") echo "selected"; ?>>Shield</option>
                <option value="Debuff" <?php if ($tag_terpilih == "Debuff") echo "selected"; ?>>Debuff</option>
                <option value="DPS" <?php if ($tag_terpilih == "DPS") echo "selected"; ?>>DPS</option>
            </select>
        </div>
        
        <button type="submit">Filter</button>
        <a href="index.php" class="reset-btn">Reset</a>
        
    </form>

    <div class="character-grid">    
        <?php 
        if (count($karakter_terfilter) > 0) {
            foreach ($karakter_terfilter as $karakter) {
                echo '<a href="detail.php?nama=' . urlencode($karakter->nama) . '" class="character-card">';
                echo '<img 
                        src="images/' . htmlspecialchars($karakter->gambar) . '" 
                        alt="' . htmlspecialchars($karakter->nama) . '" 
                        class="card-image"
                      >';
                
                echo '<div class="card-name">';
                echo htmlspecialchars($karakter->nama);
                echo '</div>';
                echo '</a>';
            }
        
        } else {
            echo "<p class='no-results'>Oops! Tidak ada karakter yang cocok dengan filter kamu.</p>";
        }
        ?>

    </div> 
</body>
</html>