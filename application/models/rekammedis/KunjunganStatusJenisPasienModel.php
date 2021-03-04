<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KunjunganStatusJenisPasienModel extends CI_Model
{
    function gettahun()
    {

        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");

        return $query->result();
    }

    function filterbytanggal($tanggalawal, $tanggalakhir)
    {

        $query = $this->db->query("SELECT * from V_DatakunjunganPasienMasukBjenisBstausPasien where TglPendaftaran BETWEEN '$tanggalawal' and '$tanggalakhir' ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function filterbybulan($tahun1, $bulanawal, $bulanakhir)
    {

        $query = $this->db->query("SELECT * from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) = '$tahun1' and MONTH(TglPendaftaran) BETWEEN '$bulanawal' and '$bulanakhir' ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function filterbytahun($tahun2)
    {

        $query = $this->db->query("SELECT * from V_DatakunjunganPasienMasukBjenisBstausPasien where YEAR(TglPendaftaran) = '$tahun2'  ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }
}
