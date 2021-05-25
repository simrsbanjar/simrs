<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_SurveilensMorbiditasPasien extends CI_Model
{
    public function GetRuanganInst($instalasi)
    {

        $query  = $this->db->query("SELECT * FROM Ruangan WHERE KdInstalasi ='" . $instalasi . "' ORDER BY NamaRuangan");
        return $query->result();
    }

    public function gettahun()
    {

        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");

        return $query->result();
    }

    public function ExecuteSP($tahun, $bulan, $instalasi, $hostname, $ruangan, $filter)
    {
        $query = $this->db->query("EXECUTE CREATE_T_SURVEILENS_MORBIDITAS_PASIEN '" . $hostname . "','" . $filter . "','" . $tahun . "','" . $bulan . "','" . $instalasi . "','" . $ruangan . "'");
        return $query->result();
    }

    public function GetData($hostname)
    {
        $query = $this->db->query("SELECT * FROM T_SURVEILENS_MORBIDITAS_PASIEN WHERE CompName = '" . $hostname . "' ORDER BY NamaDiagnosa");
        return $query->result();
    }
}
