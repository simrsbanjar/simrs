<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class DaftarPasienRajalModel extends CI_Model
{
    var $table  = 'V_LaporanPasienRawatJalan';
    var $column_order = array('NoCM', '[Nama Pasien] AS NamaPasien', 'StatusPasien', 'Umur', 'JK', 'JenisPasien', 'NamaRuangan', 'NamaDiagnosa', 'TglMasuk', 'TglLahir', 'Telepon', 'Alamat');
    var $order = array('NoCM', '[Nama Pasien] AS NamaPasien', 'StatusPasien', 'Umur', 'JK', 'JenisPasien', 'NamaRuangan', 'NamaDiagnosa', 'TglMasuk', 'TglLahir', 'Telepon', 'Alamat');

    public function getDataTable()
    {
        $tangal   = date('Y-m-d');

        $query  = $this->db->query("SELECT * FROM (SELECT NoCM, [Nama Pasien] AS NamaPasien, StatusPasien, Umur, JK, JenisPasien, NamaRuangan, NamaDiagnosa, StatusKasus, TglMasuk, TglLahir, Telepon, Alamat FROM V_LaporanPasienRawatJalan ) AS COBA WHERE TGLMASUK BETWEEN '" . $tangal . " 00:00:00' AND '" . $tangal . " 23:59:59' ");
        return $query->result();
    }
}
