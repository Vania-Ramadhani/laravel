<?php
class Karakter
{
    public $nama;
    public $rarity;
    public $afflatus;
    public $damageType;
    public $tags;
    public $gambar;

    public function __construct($nama, $rarity, $afflatus, $damageType, $tags, $gambar)
    {
        $this->nama = $nama;
        $this->rarity = $rarity;
        $this->afflatus = $afflatus;
        $this->damageType = $damageType;
        $this->tags = $tags;
        $this->gambar = $gambar;
    }
}

class KatalogService
{
        private $semuaKarakter = [];
        public function __construct($daftarKarakter)
    {
        $this->semuaKarakter = $daftarKarakter;
    }

    public function findByName($nama)
    {
        foreach ($this->semuaKarakter as $karakter) {
            if ($karakter->nama == $nama) {
                return $karakter;
            }
        }
        return null;
    }

    public function filter($filterArray)
    {
        $hasilFilter = [];
        $searchTerm   = strtolower($filterArray['search'] ?? "");
        $rarity       = $filterArray['rarity'] ?? "";
        $afflatus     = $filterArray['afflatus'] ?? "";
        $damageType   = $filterArray['damage_type'] ?? "";
        $tag          = $filterArray['tag'] ?? "";

        foreach ($this->semuaKarakter as $karakter) {
            $lolosSearch = true;
            if ($searchTerm != "") {
                if (stripos($karakter->nama, $searchTerm) === false) {
                    $lolosSearch = false; 
                }
            }

            $lolosRarity = true; 
            if ($rarity != "" && $karakter->rarity != $rarity) {
                $lolosRarity = false; 
            }
            
            $lolosAfflatus = true; 
            if ($afflatus != "" && $karakter->afflatus != $afflatus) {
                $lolosAfflatus = false;
            }

            $lolosDamage = true; 
            if ($damageType != "" && $karakter->damageType != $damageType) {
                $lolosDamage = false;
            }

            $lolosTag = true;
            if ($tag != "") {
                if (!in_array($tag, $karakter->tags)) {
                    $lolosTag = false;
                }
            }

            if ($lolosSearch && $lolosRarity && $lolosAfflatus && $lolosDamage && $lolosTag) {
                $hasilFilter[] = $karakter;
            }
        }

        return $hasilFilter;
    }
}

$daftarKarakter = [];
$daftarKarakter[] = new Karakter( "APPLe", "Bintang 4", "Star", "Mental", ["Heal"], "apple.jpg" );
$daftarKarakter[] = new Karakter( "Name Day", "Bintang 5", "Mineral", "Mental", ["Support"], "name_day.jpg" );
$daftarKarakter[] = new Karakter( "Tennant", "Bintang 5", "Beast", "Reality", ["Shield"], "tennant.jpg" );
$daftarKarakter[] = new Karakter( "Bkornblume", "Bintang 5", "Plant", "Reality", ["Debuff"], "bkornblume.jpg" );
$daftarKarakter[] = new Karakter( "A Knight", "Bintang 6", "Spirit", "Reality", ["DPS"], "a_knight.jpg" );
$daftarKarakter[] = new Karakter( "Lucy", "Bintang 6", "Intellect", "Reality", ["DPS"], "lucy.png" );
?>