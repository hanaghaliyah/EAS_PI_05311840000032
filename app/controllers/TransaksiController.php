<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Transaksi;
use App\Core\FlashMessage;
use App\Models\Penyumbang;

class TransaksiController {

    public function index() {
        $transaksis = Transaksi::findAll();

        View::render("transaksi/index.html", [
            "transaksis" => $transaksis
        ]);
    }
    
    public function show($params) {

        $id = $params[0];

        $transaksi = Transaksi::findTransaksiById($id);
        
        View::render("transaksi/show.html", [
            "transaksi" => $transaksi
        ]);
    }
    
    public function add() {

        if(isset($_POST['save'])) {

            $nama = $_POST['id_orang'];
            //$tempcheck = $_POST['check'];
            $tempket = $_POST['ket'];
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d H:i:s');
            $gender = $_POST['gender'];
            // for($i=0; $i<4; $i++)
            // {
            //     $id_bantuan = $checkbox[$i];
            //     $ketBantuan = $ketItem[$i];
            //     $transaksi = Transaksi::insert($nama, $id_bantuan, $ketBantuan);
            // }

            // $nama = this->input->post('id_orang');
            // $tempcheck = this->input->post('check');
            // $tempket = this->input->post('ket');
            
            if(!empty($_POST["check"])){
                foreach($_POST["check"] as $tempcheck)
                {
                    $check .= $tempcheck . ', ';
                    //$ket .= $tempket . ', ';
                   
                //aku njajal mus
                }
                $i = 0;
                foreach($_POST["ket"] as $temptes)
                {
                    if($temptes[$i] != ''){
                        $ket .= $temptes . ', ';
                    }
                   $i++;
                   
                }


                $check = substr($check, 0, -2);
                $ket   = substr($ket, 0, -2);

                echo $ket.'<br>';
            }


            // $check = ($tempcheck) ? implode(",", $tempcheck) : null;
            // $ket = ($tempket) ? implode(",", $tempket) : null;
               
            $data = array(
            'nama_penyumbang' => $nama,
            'nama_bantuan' => $check,
            'keterangan' => $ket,
            'time' => $now,
            'gender' => $gender);

            
            $transaksi = Transaksi::insert($data);
        }

        
        if($transaksi > 0) {
            FlashMessage::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASE_URL . '/transaksi');
        } 
        else {
            FlashMessage::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASE_URL . '/transaksi');
        }
        
    }

    public function getupdate() {
        $id = $_POST['id_transaksi'];

        $transaksi = Transaksi::findTransaksiById($id);

        echo json_encode($transaksi);
    }


    public function search() {
        $keyword = $_POST['keyword'];
        
        $transaksis = Transaksi::search($keyword);

        View::render("transaksi/index.html", [
            "transaksis" => $transaksis
        ]);
    }

}