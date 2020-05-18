<?php

namespace App\Models;

use App\Core\Model;
use DateTime;
use PDO;
use PDOException;

class Transaksi extends Model
{

    public static function findAll()
    {
        try {
            $db = static::getDb();
            
            $stmt = $db->query('SELECT * FROM transaksi');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "Terjadi kegagalan koneksi ke database.";
        }
    }

    public static function findTransaksiById($id)
    {
        try {
            $db = static::getDb();
            
            $stmt = $db->prepare('SELECT * FROM transaksi where id_transaksi = :id_transaksi');
            $stmt->bindParam(":id_transaksi", $id);

            $stmt->execute();

            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            return $results;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "Terjadi kegagalan koneksi ke database.";
        }
    }

    public static function insert($data)
    {

        try {

            $db = static::getDb();

            $sql = "INSERT INTO transaksi (nama_penyumbang, nama_bantuan, keterangan, time, gender)
                        VALUES(:id_orang, :id_bantuan, :keterangan, :time, :gender)";

            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(":id_orang", $data['nama_penyumbang']);
            $stmt->bindParam(":id_bantuan", $data['nama_bantuan']);
            $stmt->bindParam(":keterangan", $data['keterangan']);
            $stmt->bindParam(":time", $data['time']);
            $stmt->bindParam(":gender", $data['gender']);

            $stmt->execute();

            return $stmt->rowCount();

        } catch (PDOException $e) {
            echo "Terjadi kegagalan saat menyimpan data";
        }
    }

    public function search($keyword)
    {
        try {
            $db = static::getDb();
            
            $stmt = $db->prepare('SELECT * FROM transaksi where nama_bantuan LIKE :nama_bantuan');
            $stmt->bindValue(":nama_bantuan", "%$keyword%");

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            echo "Terjadi kegagalan koneksi ke database.";
        }
    }
    
}
