<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class M_RekapBesarPenyakitTen extends CI_Model
{
    public function GetRuanganInst($instalasi)
    {

        $query  = $this->db->query("SELECT * FROM Ruangan WHERE KdInstalasi ='" . $instalasi . "' ORDER BY NamaRuangan");
        return $query->result();
    }

    public function _get_data_query($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, $status)
    {
        $this->db->select("KdDiagnosa, 
                           Diagnosa, 
                           sum(jumlahpasien) as [JumlahPasien]");
        $this->db->from("V_RekapitulasiDiagnosaTopTen");
        $this->db->where("TglPeriksa BETWEEN '" . $awal .  " 00:00:00' AND '" . $akhir .  " 23:59:59'");
        if ($jenispasien != '%') {
            $this->db->where("KdKelompokPasien", $jenispasien);
        }
        if ($ruangan != '%') {
            $this->db->where("KdRuangan", $ruangan);
        }

        if ($instalasi != '%') {
            $this->db->where("KdInstalasi", $instalasi);
        } else {
            $instalasi = array('01', '02', '03', '06', '08');
            $this->db->where_in('KdInstalasi', $instalasi);
        }

        if ($status == '1') {
            $searchValue = $_POST['search']['value'];
            $searchQuery = "";
            if (isset($searchValue)) {
                $searchQuery = " (Diagnosa like '%" . $searchValue . "%' or 
                KdDiagnosa like '%" . $searchValue . "%') ";
            }
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
        }

        $this->db->group_by("Diagnosa, KdDiagnosa");
        if ($kriteria  == '1') {
            $this->db->order_by('Diagnosa', 'ASC');
        } else {
            $nodtd = array('267', '268', '269', '270.0', '270.1', '270.2', '270.3', '270.4', '270.5', '270.9');
            $this->db->where_not_in('NoDTD', $nodtd);
            $this->db->order_by('JumlahPasien', 'DESC');
        }
        $this->db->limit($jumlahbaris);
    }

    public function getDataTable($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, $status)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, $status);
        // if ($status == '1') {
        //     if ($_POST['length'] != -1) {
        //         $this->db->limit($_POST['length'], $_POST['start']);
        //     }
        // }
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_data($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, $status)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, '1');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, $status)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris, $instalasi, $kriteria, '1');
        return $this->db->count_all_results();
    }
}
