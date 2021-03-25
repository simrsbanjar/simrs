<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class M_RekapBesarKematianTen extends CI_Model
{
    public function GetRuanganInst($instalasi)
    {

        $query  = $this->db->query("SELECT * FROM Ruangan WHERE KdInstalasi ='" . $instalasi . "' ORDER BY NamaRuangan");
        return $query->result();
    }

    public function getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria)
    {
        if ($kriteria  == '1') {
            $query  = $this->db->query("SELECT TOP  " . $jumlahbaris . " KdDiagnosa, Diagnosa, sum(jumlahpasien) as [JumlahPasien]  FROM V_RekapitulasiDiagnosaKematian WHERE TglPeriksa BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59'  AND KdInstalasi LIKE '" . $instalasi . "' AND KdRuangan LIKE '" . $ruangan . "' AND KdKelompokPasien LIKE '" . $jenispasien . "' group by Diagnosa, KdDiagnosa  order by Diagnosa asc");
        } else {
            $query  = $this->db->query("SELECT TOP  " . $jumlahbaris . " KdDiagnosa, Diagnosa, sum(jumlahpasien) as [JumlahPasien]  FROM V_RekapitulasiDiagnosaKematian WHERE TglPeriksa BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59'  AND KdInstalasi LIKE '" . $instalasi . "' AND KdRuangan LIKE '" . $ruangan . "' AND KdKelompokPasien LIKE '" . $jenispasien . "' group by Diagnosa, KdDiagnosa  order by JumlahPasien desc");
        }
        return $query->result();
    }

    public function getGrafik($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria)
    {
        if ($kriteria  == '1') {
            $query  = $this->db->query("SELECT TOP  " . $jumlahbaris . " Diagnosa as hasil, sum(jumlahpasien) as total  FROM V_RekapitulasiDiagnosaKematian WHERE TglPeriksa BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59'  AND KdInstalasi LIKE '" . $instalasi . "' AND KdRuangan LIKE '" . $ruangan . "' AND KdKelompokPasien LIKE '" . $jenispasien . "' group by Diagnosa  order by Diagnosa asc");
        } else {
            $query  = $this->db->query("SELECT TOP  " . $jumlahbaris . " Diagnosa as hasil, sum(jumlahpasien) as total  FROM V_RekapitulasiDiagnosaKematian WHERE TglPeriksa BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59'  AND KdInstalasi LIKE '" . $instalasi . "' AND KdRuangan LIKE '" . $ruangan . "' AND KdKelompokPasien LIKE '" . $jenispasien . "' group by Diagnosa  order by total desc");
        }
        return $query->result();
    }
}
