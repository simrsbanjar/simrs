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

    function GetPeriodeTahun($tahun2, $instalasi, $tahun3)
    {
        $query = $this->db->query("SELECT TglKeluar	= YEAR(TglKeluar) from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '$tahun2' and '$tahun3' and KdInstalasi ='" . $instalasi . "' GROUP BY Year(TglKeluar) ORDER BY Year(TglKeluar) ASC ");

        return $query->result();
    }

    function filterbytahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT * from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '$tahun2' and '$tahun3' and KdInstalasi ='" . $instalasi . "'  ORDER BY TglKeluar ASC ");

        return $query->result();
    }

    function GetKondisiPasienTahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT Judul, Detail  from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '$tahun2' and '$tahun3' AND Judul = 'Kondisi Pulang'and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetStatusPasienTahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT Judul, Detail  from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '$tahun2' and '$tahun3' AND Judul = 'Status Pasien' and KdInstalasi ='" . $instalasi . "' GROUP BY Judul, Detail ORDER BY Judul, Detail");

        return $query->result();
    }

    function GetRuanganTahun($tahun2, $instalasi, $periode, $tahun3)
    {

        $query = $this->db->query("SELECT KdRuanganPelayanan, RuanganPelayanan from V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus where YEAR(TglKeluar) between '" . $tahun2 . "' and '$tahun3' and KdInstalasi ='" . $instalasi . "' and YEAR(TglKeluar) = '" . $periode . "' GROUP BY KdRuanganPelayanan, RuanganPelayanan");

        return $query->result();
    }

    public function getGrafik($tahun, $tanggalawal, $tanggalakhir, $instalasi, $status, $format)
    {
        // format tanggal
        if ($status == 1) {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                   TANGGAL = CONVERT(DATE,TglKeluar)
                                              FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus 
                                             WHERE TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(DATE,TglKeluar) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdKondisiPulang,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus A, KondisiPulang B
                                        WHERE A.TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                            and '" . $tanggalakhir . " 23:59:59' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.KondisiPulang
                                            ORDER BY B.KdKondisiPulang, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(DATE,A.TglKeluar), 
                                                  KDKELOMPOK = B.KdKondisiPulang,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus A, KondisiPulang B
                                             WHERE A.TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.KondisiPulang
                                               GROUP BY CONVERT(DATE,A.TglKeluar),B.KdKondisiPulang,A.Detail
                                            ORDER BY CONVERT(DATE,A.TglKeluar), A.Detail,B.KdKondisiPulang ");
            }
            // format bulan    
        } else if ($status == 2) {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                   IDTANGGAL	= CONVERT(CHAR(2),TglKeluar,101),
                                                   TANGGAL = (CASE WHEN CONVERT(CHAR(2),TglKeluar,101) = '01' THEN 'JANUARI'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '02' THEN 'FEBRUARI'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '03' THEN 'MARET'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '04' THEN 'APRIL'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '05' THEN 'MEI'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '06' THEN 'JUNI'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '07' THEN 'JULI'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '08' THEN 'AGUSTUS'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '09' THEN 'SEPTEMBER'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '10' THEN 'OKTOBER'
                                                                    WHEN CONVERT(CHAR(2),TglKeluar,101) = '11' THEN 'NOVEMBER'
                                                                    ELSE 'DESEMBER'
                                                                END)
                                              FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus 
                                             WHERE YEAR(TglKeluar) = '$tahun'
                                               and MONTH(TglKeluar) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(CHAR(2),TglKeluar,101) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdKondisiPulang,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus A, KondisiPulang B
                                        WHERE YEAR(TglKeluar) = '$tahun'
                                            and MONTH(TglKeluar) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.KondisiPulang
                                            ORDER BY B.KdKondisiPulang, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(2),A.TglKeluar,101), 
                                                  KDKELOMPOK = B.KdKondisiPulang,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus A, KondisiPulang B
                                              WHERE YEAR(TglKeluar) = '$tahun'
                                               and MONTH(TglKeluar) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.KondisiPulang
                                               GROUP BY CONVERT(CHAR(2),A.TglKeluar,101),B.KdKondisiPulang,A.Detail
                                            ORDER BY A.Detail,B.KdKondisiPulang,CONVERT(CHAR(2),A.TglKeluar,101) ");
            }
            // format tahun
        } else {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                   TANGGAL = CONVERT(CHAR(4),TglKeluar,102)
                                              FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus 
                                             WHERE YEAR(TglKeluar) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(CHAR(4),TglKeluar,102) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdKondisiPulang,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus A, KondisiPulang B
                                        WHERE YEAR(TglKeluar) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.KondisiPulang
                                            ORDER BY B.KdKondisiPulang, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(4),A.TglKeluar,102), 
                                                  KDKELOMPOK = B.KdKondisiPulang,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienKeluarBKondisiPulang_Bstatus A, KondisiPulang B
                                              WHERE YEAR(TglKeluar) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.KondisiPulang
                                               GROUP BY CONVERT(CHAR(4),A.TglKeluar,102),B.KdKondisiPulang,A.Detail
                                            ORDER BY A.Detail,B.KdKondisiPulang,CONVERT(CHAR(4),A.TglKeluar,102) ");
            }
        }
        return $query->result();
    }
}
