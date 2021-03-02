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
    var $order = array(
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

    public function getDataTable()
    {
        $tangal   = date('Y-m-d');


        $query  = $this->db->query("SELECT * FROM (SELECT 
        NoPendaftaran, NoCM,
        [Nama Pasien] AS NamaPasien,
        JK, Umur, Alamat,
        TglPendaftaran, TglMeninggal,
        Penyebab, [Tempat Meninggal] AS TempatMeninggal,
        [Dokter Pemeriksa] AS DokterPemeriksa,
        KdRuangan, NamaSubInstalasi, UmurTahun,
        Pekerjaan, KdKelasAkhir, DeskKelas,
        NamaDiagnosa, KdKelompokPasien, JenisPasien,
        Kota, Kelurahan, Kecamatan, RTRW, TglLahir,
        IdPegawai, NamaJabatan
        FROM V_DaftarPasienMeninggal) AS COBA 
        WHERE TglPendaftaran
        BETWEEN '" . $tangal . " 00:00:00' 
        AND '" . $tangal . " 23:59:59' ");
        return $query->result();
    }

    public function getDataTableFilter($awal, $akhir, $caritext)
    {
        $query  = $this->db->query("SELECT * FROM (SELECT 
        NoPendaftaran, NoCM,
        [Nama Pasien] AS NamaPasien,
        JK, Umur, Alamat,
        TglPendaftaran, TglMeninggal,
        Penyebab, [Tempat Meninggal] AS TempatMeninggal,
        [Dokter Pemeriksa] AS DokterPemeriksa,
        KdRuangan, NamaSubInstalasi, UmurTahun,
        Pekerjaan, KdKelasAkhir, DeskKelas,
        NamaDiagnosa, KdKelompokPasien, JenisPasien,
        Kota, Kelurahan, Kecamatan, RTRW, TglLahir,
        IdPegawai, NamaJabatan 
        FROM V_DaftarPasienMeninggal) AS COBA 
        WHERE TglPendaftaran
        BETWEEN '" . $awal . " 00:00:00' 
        AND '" . $akhir . " 23:59:59' 
        AND (UPPER(NamaPasien) LIKE '%" . $caritext . "%' OR NoCM LIKE '%" . $caritext . "%')");
        return $query->result();
    }

    public function getdataById($kode)
    {
        return $this->db->get_where($this->table, ['NoCM' => $kode])->row();
    }
}
