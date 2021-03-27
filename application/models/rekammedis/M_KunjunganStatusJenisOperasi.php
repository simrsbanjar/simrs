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

    function filterbytahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT * FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) between '$tahun2' and '$tahun3' AND KdInstalasi ='" . $instalasi . "'  ORDER BY TglPendaftaran ASC ");

        return $query->result();
    }

    function GetJenisOperasiTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) between '$tahun2' and '$tahun3' AND Judul = 'Jenis Operasi' AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT Judul, Detail FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) between '$tahun2' and '$tahun3' AND Judul = 'Status Pasien' AND KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan FROM V_DataKunjunganPasienMasukIBSBJenisOperasiBstatus 
        WHERE YEAR(TglPendaftaran) between '" . $tahun2 . "' and '$tahun3' AND KdInstalasi ='" . $instalasi . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    public function getGrafik($tahun, $tanggalawal, $tanggalakhir, $instalasi, $status, $format)
    {
        // format tanggal
        if ($status == 1) {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                   TANGGAL = CONVERT(DATE,TglPendaftaran)
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                             WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(DATE,TglPendaftaran) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdKelompokPasien,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, KelompokPasien B
                                        WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                            and '" . $tanggalakhir . " 23:59:59' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.JenisPasien
                                            ORDER BY B.KdKelompokPasien, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(DATE,A.TglPendaftaran), 
                                                  KDKELOMPOK = B.KdKelompokPasien,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, KelompokPasien B
                                             WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.JenisPasien
                                               GROUP BY CONVERT(DATE,A.TglPendaftaran),B.KdKelompokPasien,A.Detail
                                            ORDER BY A.Detail,B.KdKelompokPasien,CONVERT(DATE,A.TglPendaftaran) ");
            }
            // format bulan    
        } else if ($status == 2) {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                   IDTANGGAL	= CONVERT(CHAR(2),TglPendaftaran,101),
                                                   TANGGAL = (CASE WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '01' THEN 'JANUARI'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '02' THEN 'FEBRUARI'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '03' THEN 'MARET'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '04' THEN 'APRIL'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '05' THEN 'MEI'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '06' THEN 'JUNI'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '07' THEN 'JULI'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '08' THEN 'AGUSTUS'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '09' THEN 'SEPTEMBER'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '10' THEN 'OKTOBER'
                                                                    WHEN CONVERT(CHAR(2),TglPendaftaran,101) = '11' THEN 'NOVEMBER'
                                                                    ELSE 'DESEMBER'
                                                                END)
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                             WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(CHAR(2),TglPendaftaran,101) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdKelompokPasien,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, KelompokPasien B
                                        WHERE YEAR(TglPendaftaran) = '$tahun'
                                            and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.JenisPasien
                                            ORDER BY B.KdKelompokPasien, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(2),A.TglPendaftaran,101), 
                                                  KDKELOMPOK = B.KdKelompokPasien,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, KelompokPasien B
                                              WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.JenisPasien
                                               GROUP BY CONVERT(CHAR(2),A.TglPendaftaran,101),B.KdKelompokPasien,A.Detail
                                            ORDER BY A.Detail,B.KdKelompokPasien,CONVERT(CHAR(2),A.TglPendaftaran,101) ");
            }
            // format tahun
        } else {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                   TANGGAL = CONVERT(CHAR(4),TglPendaftaran,102)
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                             WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(CHAR(4),TglPendaftaran,102) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdKelompokPasien,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, KelompokPasien B
                                        WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.JenisPasien
                                            ORDER BY B.KdKelompokPasien, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(4),A.TglPendaftaran,102), 
                                                  KDKELOMPOK = B.KdKelompokPasien,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, KelompokPasien B
                                              WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.JenisPasien
                                               GROUP BY CONVERT(CHAR(4),A.TglPendaftaran,102),B.KdKelompokPasien,A.Detail
                                            ORDER BY A.Detail,B.KdKelompokPasien,CONVERT(CHAR(4),A.TglPendaftaran,102) ");
            }
        }

        return $query->result();
    }
}
