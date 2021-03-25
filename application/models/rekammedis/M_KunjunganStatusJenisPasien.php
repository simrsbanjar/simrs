<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganStatusJenisPasien extends CI_Model
{
    function gettahun()
    {

        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");

        return $query->result();
    }

    function filterbytanggal($tanggalawal, $tanggalakhir, $instalasi)
    {

        $query = $this->db->query("SELECT * from V_DatakunjunganPasienMasukBjenisBstausPasien where TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' and KdInstalasi ='" . $instalasi . "' ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisPasienTgl($tanggalawal, $tanggalakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DatakunjunganPasienMasukBjenisBstausPasien where TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' AND Judul = 'Jenis Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }
    function GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DatakunjunganPasienMasukBjenisBstausPasien where TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' AND Judul = 'Status Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DatakunjunganPasienMasukBjenisBstausPasien where TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' and KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    function filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT * from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) = '$tahun1' and MONTH(TglPendaftaran) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) = '$tahun1' and MONTH(TglPendaftaran) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' AND Judul = 'Jenis Pasien' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }
    function GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT Judul, Detail from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) = '$tahun1' and MONTH(TglPendaftaran) BETWEEN '$bulanawal' and '$bulanakhir' and KdInstalasi ='" . $instalasi . "' AND Judul = 'Status Pasien' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) = '" . $tahun1 . "' and MONTH(TglPendaftaran) BETWEEN '" . $bulanawal . "' and '" . $bulanakhir . "' and KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    function filterbytahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT * from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) BETWEEN '$tahun2' and '$tahun3' and KdInstalasi ='" . $instalasi . "'  ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisPasienTahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT Judul, Detail  from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) BETWEEN '$tahun2' and '$tahun3' AND Judul = 'Jenis Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT Judul, Detail  from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) BETWEEN '$tahun2' and '$tahun3' AND Judul = 'Status Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) BETWEEN '" . $tahun2 . "' and '$tahun3' and KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

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
