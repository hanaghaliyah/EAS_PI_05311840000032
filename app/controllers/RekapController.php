<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Transaksi;
use App\Core\FlashMessage;

class RekapController {

    public function index() {
        $transaksis = Transaksi::findAll();

        View::render("rekap/index.html", [
            "transaksis" => $transaksis
        ]);

    }
    
    public function show($params) {

        $id = $params[0];

        $transaksi = Transaksi::findTransaksiById($id);
        
        View::render("rekap/show.html", [
            "transaksi" => $transaksi
        ]);
    }

    public function search() {
        $keyword = $_POST['keyword'];
        
        $transaksis = Transaksi::search($keyword);

        View::render("rekap/index.html", [
            "transaksis" => $transaksis
        ]);
    }

}