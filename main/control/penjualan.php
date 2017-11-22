<?php
/**
 * Created by PhpStorm.
 * User: Aleq
 * Date: 01/11/2017
 * Time: 0:25
 */

class ControlPenjualan {

    public function koAgenPenjualan() {
        $kecamatan = Penjualan::lihatTokoPadaKec();
        require_once ('main/pages/ko_agen-dashboard-penjualan.php');
    }

    public function koAgenPenjualanToko() {
        require_once ('main/pages/ko_agen-dashboard-penjualan_toko.php');
    }

    public function manajerPenjualan() {
        require_once ('main/pages/manajer-dashboard-penjualan.php');
    }

    public function manajerPenjualanToko() {
        require_once ('main/pages/manajer-dashboard-penjualan_toko.php');
    }

    public function tambahProduk()
    {
        Penjualan::tambahProduk($_GET['_200ml'], $_GET['_600ml'], $_GET['_1500ml'], $_GET['Tanggal'], $_GET['IDToko']);
        require_once ('main/pages/ko_agen-dashboard-pemetaan.php');
    }

    public function updateProduk()
    {
        Penjualan::updateProduk($_GET['_200ml'], $_GET['_600ml'], $_GET['1500ml'], $_GET['Tanggal'], $_GET['IDToko']);
        require_once ('main/pages/ko_agen-dashboard-pemetaan.php');
    }
}
?>