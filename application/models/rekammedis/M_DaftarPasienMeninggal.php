<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class M_DaftarPasienMeninggal extends CI_Model
{
    var $table  = 'V_DaftarPasienMeninggal';
    var $column_order = array(
        'NoPendaftaran', 'NoCM',
        '[Nama Pasien] AS NamaPasien',
        'JK', 'Umur', 'Alamat',
        'TglPendaftaran', 'TglMeninggal',
        'Penyebab', '[Tempat Meninggal] AS TempatMeninggal',
        '[Dokter Pemeriksa] AS DokterPemeriksa',
        'KdRuangan', 'NamaSubInstalasi', 'UmurTahun',
        'Pekerjaan', 'KdKelasAkhir', 'DeskKelas',
        'NamaDiagnosa', 'KdKelompokPasien', 'JenisPasien',
        'Kota', 'Kelurahan', 'Kecamatan', 'RTRW', 'TglLahir',
        'IdPegawai', 'NamaJabatan'
    );
    var $order = array('NoPendaftaran', 'NoCM', '[Nama Pasien] AS NamaPasien', 'StatusPasien', 'Umur', 'JK', 'JenisPasien', 'NamaRuangan', 'NamaDiagnosa', 'TglMasuk', 'TglLahir', 'Telepon', 'Alamat', 'KdRuangan');

    public function getDataTable()
    {
        $tangal   = date('Y-m-d');


        $query  = $this->db->query("SELECT * FROM (SELECT NoCM, [Nama Pasien] AS NamaPasien, StatusPasien, Umur, JK, JenisPasien, NamaRuangan, NamaDiagnosa, StatusKasus, TglMasuk, TglLahir, Telepon, Alamat, KdRuangan FROM V_LaporanPasienRawatJalan ) AS COBA WHERE TGLMASUK BETWEEN '" . $tangal . " 00:00:00' AND '" . $tangal . " 23:59:59' ");
        return $query->result();
    }

    public function getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext)
    {
        $query  = $this->db->query("SELECT * FROM (SELECT NoCM, [Nama Pasien] AS NamaPasien, StatusPasien, Umur, JK, JenisPasien, NamaRuangan, NamaDiagnosa, StatusKasus, TglMasuk, TglLahir, Telepon, Alamat, KdRuangan FROM V_LaporanPasienRawatJalan ) AS COBA WHERE TGLMASUK BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59' AND JenisPasien LIKE '" . $jenispasien . "' AND KdRuangan LIKE '" . $ruangan . "' AND (UPPER(NamaPasien) LIKE '%" . $caritext . "%' OR NoCM LIKE '%" . $caritext . "%')");
        return $query->result();
    }
}
