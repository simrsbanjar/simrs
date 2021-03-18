<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganStatusJenisOperasi extends CI_Model
{
    function gettahun()
    {
        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");
        return $query->result();
    }

    function filterbytanggal($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' AND KdInstalasi ='" . $instalasi . "' 
        ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisOperasiTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' AND Judul = 'Jenis Operasi' AND KdInstalasi ='" . $instalasi . "' 
        GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' AND Judul = 'Status Pasien' 
        AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' 
        AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }
    function filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '$tahun1' AND MONTH(TglPendaftaran) BETWEEN '$bulanawal' AND '$bulanakhir' 
        AND KdInstalasi ='" . $instalasi . "' ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisOperasiBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '$tahun1' AND MONTH(TglPendaftaran) BETWEEN '$bulanawal' AND '$bulanakhir' 
        AND KdInstalasi ='" . $instalasi . "' AND Judul = 'Jenis Operasi' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '$tahun1' AND MONTH(TglPendaftaran) BETWEEN '$bulanawal' AND '$bulanakhir' 
        AND KdInstalasi ='" . $instalasi . "' AND Judul = 'Status Pasien' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '" . $tahun1 . "' AND MONTH(TglPendaftaran) BETWEEN '" . $bulanawal . "' AND '" . $bulanakhir . "' 
        AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    function filterbytahun($tahun2, $instalasi)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '$tahun2' AND KdInstalasi ='" . $instalasi . "'  ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisOperasiTahun($tahun2, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '$tahun2' AND Judul = 'Jenis Operasi' AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTahun($tahun2, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '$tahun2' AND Judul = 'Status Pasien' AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTahun($tahun2, $instalasi)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) = '" . $tahun2 . "' AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }
}
