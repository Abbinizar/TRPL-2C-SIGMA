<?php
/**
 * Created by PhpStorm.
 * User: Aleq
 * Date: 02/11/2017
 * Time: 0:26
 */

class Laporan
{
    public function __construct()
    {

    }

    public static function daftarPerBulan()
    {
        $db = DB::getInstance();
        $req = $db->query("SELECT (SUM(s.200ml_diterima) + SUM(s.600ml_diterima) + SUM(s.1500ml_diterima)) as Diterima, (SUM(s.200ml_terjual) + SUM(s.600ml_terjual) + SUM(s.1500ml_terjual)) as Terjual, k.Kecamatan, k.IDKecamatan, MONTH(TanggalDiterima) FROM toko t JOIN stok s ON t.IDToko = s.IDToko JOIN kecamatan k ON t.IDKecamatan = k.IDKecamatan GROUP BY k.Kecamatan;");
        foreach ($req as $item) {
            $hasil[] = array(
                'Diterima' => $item['Diterima'],
                'Terjual' => $item['Terjual'],
                'Kecamatan' => $item['Kecamatan']
            );
        }
        return $hasil;
    }

    public static function terdistribusiPerTahun($kecamatan)
    {
        $db = DB::getInstance();
        $req = $db->query("SELECT SUM(s.200ml_diterima) as p200, SUM(s.600ml_diterima) as p600, SUM(s.1500ml_diterima) as p1500, MONTH(s.TanggalDiterima) as bulan, t.NamaToko FROM stok s JOIN toko t ON s.IDToko = t.IDToko WHERE t.IDKecamatan = $kecamatan AND YEAR(s.TanggalTerjual) = YEAR(NOW()) GROUP BY s.IDToko;");
        foreach ($req as $item) {
            $hasil [] = array(
                'dis200' => $item['p200'],
                'dis600' => $item['p600'],
                'dis1500' => $item['p1500'],
                'bulan' => $item['bulan'],
                'NamaToko' => $item['NamaToko']
            );
        }
        return $hasil;
    }

    public static function terjualPerTahun($kecamatan)
    {
        $db = DB::getInstance();
        $req = $db->query("SELECT SUM(s.200ml_terjual) as p200, SUM(s.600ml_terjual) as p600, SUM(s.1500ml_terjual) as p1500, MONTH(s.TanggalTerjual) as bulan, t.NamaToko FROM stok s JOIN toko t ON s.IDToko = t.IDToko WHERE t.IDKecamatan = $kecamatan AND YEAR(s.TanggalTerjual) = YEAR(NOW()) GROUP BY s.IDToko;");
        foreach ($req as $item) {
            $hasil [] = array(
                'jual200' => $item['p200'],
                'jual600' => $item['p600'],
                'jual1500' => $item['p1500'],
                'bulan' => $item['bulan'],
                'NamaToko' => $item['NamaToko']
            );
        }
        return $hasil;
    }

}