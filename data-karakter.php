<?php
class Karakter //class bernama karakter
{
    public $nama;
    public $rarity;
    public $afflatus;
    public $damageType;
    public $tags;
    public $gambar; // properti (variabel dalam class)

    public function __construct($nama, $rarity, $afflatus, $damageType, $tags, $gambar) 
    //construct biar otomatis dipanggil saat objek dibuat, menerima paramater untuk mengisi properti
    {
        $this->nama = $nama;
        $this->rarity = $rarity;
        $this->afflatus = $afflatus;
        $this->damageType = $damageType;
        $this->tags = $tags;
        $this->gambar = $gambar; // ini paramaternnya. gunanya ngisi properti class dari parameter construct ($this)
    }
}

class KatalogService // khusus untuk mengelola daftar karakter
{
        private $semuaKarakter = []; //properti class
        //private artinya hanya bisa diakses dari dalam class aja. klo mau dipanggil keluar pakai public function di dalam class ini
        public function __construct($daftarKarakter) //paramater
    {
        $this->semuaKarakter = $daftarKarakter;
    }

    public function findByName($nama) //ini biar $nama bs dipanggil dr luar
    {
        foreach ($this->semuaKarakter as $karakter) { //looping
            if ($karakter->nama == $nama) { //kalau ada yang cocok, dibalikin objeknnya sbg hasil
                return $karakter;
            }
        }
        return null; //klo gk ada yg cocok
    }

    public function filter($filterArray)
    {
        $hasilFilter = []; //buat hasil filter
        $searchTerm   = strtolower($filterArray['search'] ?? "");//biar jadi kecil semua hurufnya
        $rarity       = $filterArray['rarity'] ?? "";
        $afflatus     = $filterArray['afflatus'] ?? "";
        $damageType   = $filterArray['damage_type'] ?? "";
        $tag          = $filterArray['tag'] ?? ""; // ambil semua, klo gaada pakai empty string

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