<?php
/**
 * Created by PhpStorm.
 * User: Aleq
 * Date: 02/11/2017
 * Time: 0:27
 */

class Penjualan
{
    public function __construct()
    {

    }

    public static function tambahProduk($_200ml, $_600ml, $_1500ml, $tanggal, $idtoko)
    {
        $db = DB::getInstance();
        print "INSERT INTO stok(200ml_Diterima, 600ml_Diterima, 1500ml_Diterima, TanggalDiterima, IDToko) VALUES ($_200ml, $_600ml, $_1500ml, '$tanggal', $idtoko);";
        $req = $db->query("INSERT INTO stok(200ml_Diterima, 600ml_Diterima, 1500ml_Diterima, TanggalDiterima, IDToko) VALUES ($_200ml, $_600ml, $_1500ml, '$tanggal', $idtoko);");
        return $req;
    }

    public static function updateProduk($_200ml, $_600ml, $_1500ml, $tanggal, $idtoko, $idstok)
    {
        $db = DB::getInstance();
        $req = $db->query("UPDATE stok SET 200ml_Terjual=$_200ml, 600ml_Terjual=$_600ml, 1500ml_Terjual=$_1500ml, TanggalTerjual='$tanggal' WHERE MONTH(TanggalDiterima) = MONTH(NOW()) AND IDToko = $idtoko");
        return $req;
    }

    public static function lihatProdukPerBulan($IDToko)
    {
        $db = DB::getInstance();
        $req = $db->query("SELECT IDStok, 200ml_Diterima, 600ml_Diterima, 1500ml_Diterima, 200ml_Terjual, 600ml_Terjual, 1500ml_Terjual, TanggalDiterima, TanggalTerjual, IDToko, MONTH(TanggalDiterima) as bulan FROM stok WHERE YEAR(TanggalDiterima) = YEAR(NOW()) AND IDToko = $IDToko;");
        foreach ($req as $item) {
            $hasil[] = array(
                'IDStok' => $item['IDStok'],
                'Diterima200' => $item['200ml_Diterima'],
                'Diterima600' => $item['600ml_Diterima'],
                'Diterima1500' => $item['1500ml_Diterima'],
                'Terjual200' => $item['200ml_Terjual'],
                'Terjual600' => $item['600ml_Terjual'],
                'Terjual1500' => $item['1500ml_Terjual'],
                'TanggalDiterima' => $item['TanggalDiterima'],
                'TanggalTerjual' => $item['TanggalTerjual'],
                'IDToko' => $item['IDToko'],
                'Bulan' => $item['bulan']
            );
        }
        if (isset($hasil)) return $hasil;
        else return null;
    }

    public static function lihatTokoPadaKec()
    {
        $db = DB::getInstance();
        $req = $db->query("SELECT DISTINCT Kecamatan FROM kecamatan k JOIN toko t ON t.IDKecamatan = k.IDKecamatan WHERE t.StatusToko = 'Ada' ORDER BY Kecamatan");
        foreach ($req as $item) {
            $hasil[] = array(
                'Kecamatan' => $item['Kecamatan']
            );
        }
        if (isset($hasil)) return $hasil;
        else return null;
    }

    public static function lihatTokoPerKec()
    {
        $db = DB::getInstance();
        $req = $db->query("SELECT t.IDToko, t.NamaToko, t.NamaPemilik, t.AlamatToko, t.IDKecamatan, k.Kecamatan, t.NoTelp, t.Keterangan FROM toko t JOIN kecamatan k ON k.IDKecamatan = t.IDKecamatan ORDER BY t.IDKecamatan");
        foreach ($req as $item) {
            $hasil[] = array(
                'IDToko' => $item['IDToko'],
                'NamaToko' => $item['NamaToko'],
                'AlamatToko' => $item['AlamatToko'],
                'Kecamatan' => $item['Kecamatan'],
                'Keterangan' => $item['Keterangan']
            );
        }
        if (isset($hasil)) return $hasil;
        else return null;
    }
}

