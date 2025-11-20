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
$daftarKarakter[] = new Karakter( "APPLe", "★★★★", "Star", "Mental", ["Heal"], "APPLe.png");
$daftarKarakter[] = new Karakter( "Name Day", "★★★★★", "Mineral", "Mental", ["Support"], "Nameday2.webp" );
$daftarKarakter[] = new Karakter( "Tennant", "★★★★★", "Beast", "Reality", ["Shield"], "tennant.jpg" );
$daftarKarakter[] = new Karakter( "Bkornblume", "★★★★★", "Plant", "Reality", ["Debuff"], "bkornblume.webp" );
$daftarKarakter[] = new Karakter( "A Knight", "★★★★★★", "Spirit", "Reality", ["DPS"], "knight.jpg" );
$daftarKarakter[] = new Karakter( "Lucy", "★★★★★★", "Intellect", "Reality", ["DPS"], "lucy.jpg" );
?>