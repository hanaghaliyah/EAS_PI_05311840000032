$(function () {

    $('.tombolTambahTransaksi').on('click', function () {
        // Ubah judul form
        $('#judulModal').html('Transaksi');
        // Ubah teks button
        $('.modal-footer button[type=submit]').html('Transaksi');

        // Ubah action form
        $('.modal form').attr('action', 'http://localhost/integratif/donasi/public/transaksi/add');

        // Kosongkan isi teks
        $('#nama_bantuan').val("");
        $('#ketBantuan').val("");

        $('#ket_uang').hide();
        $('#ket_alkes').hide();
        $('#ket_obat').hide();
        $('#ket_kebpok').hide();

        $('#cb_uang').on('click', function(){
            $('#ket_uang').toggle();
        });
        $('#cb_alkes').on('click', function(){
            $('#ket_alkes').toggle();
        });
        $('#cb_obat').on('click', function(){
            $('#ket_obat').toggle();
        });
        $('#cb_kebpok').on('click', function(){
            $('#ket_kebpok').toggle();
        });

        $('#gender').val("");

    });

});