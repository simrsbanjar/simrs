<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class M_DaftarPasienMeninggal extends CI_Model
{
    public function _get_data_query($awal, $akhir, $caritext, $status)
    {
        $this->db->select("NoPendaftaran,
                          V_DaftarPasienMeninggal.NoCM AS NoCM, 
                          Pasien.NamaLengkap AS NamaPasien, 
                          JK, 
                          Umur, 
                          V_DaftarPasienMeninggal.Alamat,
                          TglPendaftaran,
                          TglMeninggal,
                          Penyebab, 
                          Ruangan.NamaRuangan AS TempatMeninggal, 
                          DataPegawai.NamaLengkap AS DokterPemeriksa,
                          V_DaftarPasienMeninggal.KdRuangan, 
                          NamaSubInstalasi, 
                          UmurTahun, 
                          Pekerjaan, 
                          KdKelasAkhir, 
                          DeskKelas, 
                          KdKelompokPasien, 
                          JenisPasien, 
                          V_DaftarPasienMeninggal.Kota AS Kota, 
                          V_DaftarPasienMeninggal.Kelurahan AS Kelurahan, 
                          V_DaftarPasienMeninggal.Kecamatan AS Kecamatan,
                          V_DaftarPasienMeninggal.RTRW AS RTRW, 
                          V_DaftarPasienMeninggal.TglLahir AS TglLahir,
                          V_DaftarPasienMeninggal.IdPegawai AS IdPegawai,
                          NamaJabatan");
        $this->db->from("V_DaftarPasienMeninggal");
        $this->db->join('Pasien', 'Pasien.NoCM = V_DaftarPasienMeninggal.NoCM');
        $this->db->join('Ruangan', 'Ruangan.KdRuangan = V_DaftarPasienMeninggal.KdRuangan');
        $this->db->join('DataPegawai', 'DataPegawai.IdPegawai = V_DaftarPasienMeninggal.IdPegawai');
        $this->db->where("TglPendaftaran BETWEEN '" . $awal .  " 00:00:00' AND '" . $akhir .  " 23:59:59'");

        if ($status == '1') {
            $searchValue = $_POST['search']['value'];
            $searchQuery = "";
            if (isset($searchValue)) {
                $searchQuery = " (Pasien.NamaLengkap like '%" . $searchValue . "%' or 
                              V_DaftarPasienMeninggal.NoCM like '%" . $searchValue . "%' or 
                              JenisPasien like '%" . $searchValue . "%' or 
                              Penyebab like '%" . $searchValue . "%') ";
            }
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
        }
        $this->db->order_by('TglPendaftaran,Pasien.NamaLengkap,V_DaftarPasienMeninggal.NoCM', 'ASC');
    }

    public function getDataTable($awal, $akhir, $caritext, $status)
    {
        $this->_get_data_query($awal, $akhir, $caritext, $status);

        if ($status == '1') {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_data($awal, $akhir, $caritext)
    {
        $this->_get_data_query($awal, $akhir, $caritext, '1');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data($awal, $akhir, $caritext)
    {
        $this->_get_data_query($awal, $akhir, $caritext, '1');
        return $this->db->count_all_results();
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
        KdKelompokPasien, JenisPasien,
        Kota, Kelurahan, Kecamatan, RTRW, TglLahir,
        IdPegawai, NamaJabatan 
        FROM V_DaftarPasienMeninggal) AS COBA 
        WHERE TglPendaftaran
        BETWEEN '" . $awal . " 00:00:00' 
        AND '" . $akhir . " 23:59:59' 
        AND (UPPER(NamaPasien) LIKE '%" . $caritext . "%' OR NoCM LIKE '%" . $caritext . "%')");
        return $query->result();
    }

    public function getDataTableFilterSurat($kode)
    {
        $query  = $this->db->query("SELECT * FROM (SELECT 
        NoPendaftaran, NoCM,
        [Nama Pasien] AS NamaPasien,
        JK, Umur, Alamat,
        TglPendaftaran, TglMeninggal,
        Penyebab, [Tempat Meninggal] AS TempatMeninggal,
        [Dokter Pemeriksa] AS DokterPemeriksa,
        KdRuangan, NamaSubInstalasi, UmurTahun,
        Pekerjaan = ISNULL(Pekerjaan,'-'), KdKelasAkhir, DeskKelas,
        KdKelompokPasien, JenisPasien,
        Kota, Kelurahan, Kecamatan, RTRW, TglLahir,
        IdPegawai, NamaJabatan
        FROM V_DaftarPasienMeninggal) AS COBA 
        WHERE NoPendaftaran = '" . $kode . "'");
        return $query->row();
    }
}
