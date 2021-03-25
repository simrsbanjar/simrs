<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganStatusKondisiPulang extends CI_Model
{
    function gettahun()
    {

        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");

        return $query->result();
    }

    function filterbytanggal($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT * from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' and KdInstalasi ='" . $instalasi . "' ORDER BY TglKeluar ASC ");

        return $query->result();
    }

    function GetPeriodeTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT TglKeluar	= CONVERT(DATE,TglKeluar) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' AND Judul = 'Kondisi Pulang' and KdInstalasi ='" . $instalasi . "' GROUP BY CONVERT(DATE,TglKeluar) ORDER BY CONVERT(DATE,TglKeluar)");

        return $query->result();
    }

    function GetKondisiPasienTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' AND Judul = 'Kondisi Pulang' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }
    function GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' AND Judul = 'Status Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi, $tanggalkeluar)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' and KdInstalasi ='" . $instalasi . "' and convert(DATE,TglKeluar) = '" . $tanggalkeluar . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    function GetPeriodeBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT TglKeluar	= MONTH(TglKeluar),Bulan	= CASE WHEN MONTH(TglKeluar) = 1 THEN 'Januari' 
        WHEN MONTH(TglKeluar) = 2 THEN 'Februari' 
        WHEN MONTH(TglKeluar) = 3 THEN 'Maret' 
        WHEN MONTH(TglKeluar) = 4 THEN 'April' 
        WHEN MONTH(TglKeluar) = 5 THEN 'Mei' 
        WHEN MONTH(TglKeluar) = 6 THEN 'Juni' 
        WHEN MONTH(TglKeluar) = 7 THEN 'Juli' 
        WHEN MONTH(TglKeluar) = 8 THEN 'Agustus' 
        WHEN MONTH(TglKeluar) = 9 THEN 'September' 
        WHEN MONTH(TglKeluar) = 10 THEN 'Oktober' 
        WHEN MONTH(TglKeluar) = 11 THEN 'November' 
        ELSE 'Desember' END from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun1' and MONTH(TglKeluar) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' GROUP BY MONTH(TglKeluar) ORDER BY MONTH(TglKeluar) ASC ");

        return $query->result();
    }

    function filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT * from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun1' and MONTH(TglKeluar) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' ORDER BY TglKeluar ASC ");

        return $query->result();
    }

    function GetKondisiPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun1' and MONTH(TglKeluar) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' AND Judul = 'Kondisi Pulang'GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }
    function GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun1' and MONTH(TglKeluar) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' AND Judul = 'Status Pasien' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '" . $tahun1 . "' and MONTH(TglKeluar) BETWEEN '" . $bulanawal . "' and '" . $bulanakhir . "' and KdInstalasi ='" . $instalasi . "' and MONTH(TglKeluar) ='" . $periode . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");
        return $query->result();
    }

    function GetPeriodeTahun($tahun2, $instalasi)
    {
        $query = $this->db->query("SELECT TglKeluar	= YEAR(TglKeluar) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun2' and KdInstalasi ='" . $instalasi . "' GROUP BY Year(TglKeluar) ORDER BY Year(TglKeluar) ASC ");

        return $query->result();
    }

    function filterbytahun($tahun2, $instalasi)
    {

        $query = $this->db->query("SELECT * from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun2' and KdInstalasi ='" . $instalasi . "'  ORDER BY TglKeluar ASC ");

        return $query->result();
    }

    function GetKondisiPasienTahun($tahun2, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail  from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun2' AND Judul = 'Kondisi Pulang'and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTahun($tahun2, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail  from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '$tahun2' AND Judul = 'Status Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTahun($tahun2, $instalasi, $periode)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) = '" . $tahun2 . "' and KdInstalasi ='" . $instalasi . "' and YEAR(TglKeluar) = '" . $periode . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    public function getGrafik($tahun, $tanggalawal, $tanggalakhir, $instalasi, $status, $format)
    {
        if ($status == 'tanggal') {
            $query = $this->db->query("EXEC Sp_GrafikKunPasMasukJenisPasienWeb '1',NULL,'" . $tanggalawal . "','" . $tanggalakhir . "','" . $instalasi . "','" . $format . "'");
        } else if ($status == 'bulan') {
            $query = $this->db->query("EXEC Sp_GrafikKunPasMasukJenisPasienWeb '2'," . $tahun . "," . $tanggalawal . "," . $tanggalakhir . ",'" . $instalasi . "','" . $format . "'");
        } else {
            $query = $this->db->query("EXEC Sp_GrafikKunPasMasukJenisPasienWeb '3'," . $tahun . "," . $tanggalawal . ",'" . $tanggalawal . "','" . $instalasi . "','" . $format . "'");
        }

        return $query->result();
    }
}
