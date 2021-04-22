<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class M_DaftarPasienPulangRanap extends CI_Model
{
    public function _get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang, $status)
    {
        $this->db->select("V_DaftarPasienRawatInapPulang.NoCM AS NoCM, 
                            NamaLengkap AS NamaPasien, 
                            JenisKelamin, 
                            JenisPasien, 
                            NamaRuangan, 
                            TglPendaftaran, 
                            TglLahir, 
                            Telepon, 
                            Alamat, 
                            TglPulang, 
                            LamaDirawat,
                            JenisDiagnosa.JenisDiagnosa as JenisDiagnosa, 
                            KodeDiagnosa as KodeDiagnosa,
                            Diagnosa.NamaDiagnosa as NamaDiagnosa, 
                            Dokter, 
                            StatusPulang, 
                            KondisiPulang");
        $this->db->from("V_DaftarPasienRawatInapPulang");
        $this->db->join('JenisDiagnosa', 'JenisDiagnosa.KdJenisDiagnosa = V_DaftarPasienRawatInapPulang.KdJenisDiagnosa');
        $this->db->join('Diagnosa', 'Diagnosa.KdDiagnosa = V_DaftarPasienRawatInapPulang.Diagnosa');
        $this->db->where("TglPendaftaran BETWEEN '" . $awal .  " 00:00:00' AND '" . $akhir .  " 23:59:59'");
        if ($jenispasien != '%') {
            $this->db->where("JenisPasien", $jenispasien);
        }
        if ($ruangan != '%') {
            $this->db->where("NamaRuangan", $ruangan);
        }

        if ($kondisipulang == '2') {
            $this->db->where("KdStatusPulang !='13'");
        } else if ($kondisipulang == '3') {
            $this->db->where("KdStatusPulang ='13'");
        }

        if ($status == '1') {
            $searchValue = $_POST['search']['value'];
            $searchQuery = "";
            if (isset($searchValue)) {
                $searchQuery = " (NamaLengkap like '%" . $searchValue . "%' or 
                              V_DaftarPasienRawatInapPulang.NoCM like '%" . $searchValue . "%' or 
                              JenisPasien like '%" . $searchValue . "%' or 
                              NamaRuangan like '%" . $searchValue . "%' or 
                              V_DaftarPasienRawatInapPulang.NoCM like '%" . $searchValue . "%' or 
                              NamaDiagnosa like'%" . $searchValue . "%' ) ";
            }
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
        }

        $this->db->order_by('TglPendaftaran,NamaLengkap,V_DaftarPasienRawatInapPulang.NoCM', 'ASC');
    }

    public function getDataTable($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang, $status)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang, $status);
        if ($status == '1') {
            if ($_POST['length'] != -1) {
                $this->db->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered_data($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang, '1');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang)
    {
        $this->_get_data_query($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang, '1');
        return $this->db->count_all_results();
    }
}
