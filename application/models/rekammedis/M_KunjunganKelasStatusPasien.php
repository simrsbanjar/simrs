<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganKelasStatusPasien extends CI_Model
{

    function gettahun()
    {
        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");
        return $query->result();
    }

    function filterbytanggal($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' AND KdInstalasi ='" . $instalasi . "' 
        ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetKelasPelayananTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' AND Judul = 'Kelas Pelayanan' AND KdInstalasi ='" . $instalasi . "' 
        GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }
    function GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' AND Judul = 'Status Pasien' 
        AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' AND '" . $tanggalakhir . " 23:59:59' 
        AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    function filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) = '$tahun1' AND MONTH(TglPendaftaran) BETWEEN '$bulanawal' AND '$bulanakhir' 
        AND KdInstalasi ='" . $instalasi . "' ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetKelasPelayananBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) = '$tahun1' AND MONTH(TglPendaftaran) BETWEEN '$bulanawal' AND '$bulanakhir' 
        AND KdInstalasi ='" . $instalasi . "' AND Judul = 'Kelas Pelayanan' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) = '$tahun1' AND MONTH(TglPendaftaran) BETWEEN '$bulanawal' AND '$bulanakhir' 
        AND KdInstalasi ='" . $instalasi . "' AND Judul = 'Status Pasien' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) = '" . $tahun1 . "' AND MONTH(TglPendaftaran) BETWEEN '" . $bulanawal . "' AND '" . $bulanakhir . "' 
        AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    function filterbytahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) between '$tahun2' and '$tahun3' AND KdInstalasi ='" . $instalasi . "'  ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetKelasPelayananTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) between '$tahun2' and '$tahun3' AND Judul = 'Kelas Pelayanan' AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) between '$tahun2' and '$tahun3' AND Judul = 'Status Pasien' AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukBsetatusBKelas 
        WHERE YEAR(TglPendaftaran) between  '" . $tahun2 . "' and '$tahun3' AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }
}
