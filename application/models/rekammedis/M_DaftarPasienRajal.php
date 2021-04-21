<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class M_DaftarPasienRajal extends CI_Model
{
    public function _get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, $status)
    {
        $this->db->select("V_LaporanPasienRawatJalan.NoCM AS NoCM, 
                          NamaLengkap AS NamaPasien, 
                          StatusPasien,
                          Umur, 
                          JK, 
                          JenisPasien, 
                          NamaRuangan, 
                          NamaDiagnosa, 
                          StatusKasus, 
                          TglMasuk, 
                          V_LaporanPasienRawatJalan.TglLahir AS TglLahir, 
                          V_LaporanPasienRawatJalan.Telepon AS Telepon, 
                          V_LaporanPasienRawatJalan.Alamat AS Alamat, 
                          KdRuangan");
        $this->db->from("V_LaporanPasienRawatJalan");
        $this->db->join('Pasien', 'Pasien.NoCM = V_LaporanPasienRawatJalan.NoCM');
        $this->db->where("TGLMASUK BETWEEN '" . $awal .  " 00:00:00' AND '" . $akhir .  " 23:59:59'");
        if ($jenispasien != '%') {
            $this->db->where("JenisPasien", $jenispasien);
        }
        if ($ruangan != '%') {
            $this->db->where("KdRuangan", $ruangan);
        }

        if ($status == '1') {
            $searchValue = $_POST['search']['value'];
            $searchQuery = "";
            if (isset($searchValue)) {
                $searchQuery = " (NamaLengkap like '%" . $searchValue . "%' or 
                              V_LaporanPasienRawatJalan.NoCM like '%" . $searchValue . "%' or 
                              JenisPasien like '%" . $searchValue . "%' or 
                              NamaRuangan like '%" . $searchValue . "%' or 
                              NamaDiagnosa like'%" . $searchValue . "%' ) ";
            }
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
        }
        $this->db->order_by('TglMasuk,NamaLengkap,V_LaporanPasienRawatJalan.NoCM', 'ASC');
    }

    public function getDataTable($awal, $akhir, $jenispasien, $ruangan, $caritext, $status)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, $status);

        if ($status == '1') {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_data($awal, $akhir, $jenispasien, $ruangan, $caritext)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, '1');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data($awal, $akhir, $jenispasien, $ruangan, $caritext)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, '1');
        return $this->db->count_all_results();
    }
}
