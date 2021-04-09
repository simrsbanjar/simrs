<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganStatusKondisiPulang extends CI_Model
{
    function gettahun()
    {

        $query = $this->db->query("SELECT TAHUN AS tahun FROM TahunFiterWeb ORDER BY TAHUN ASC");

        return $query->result();
    }

    function GetDataTgl($tanggalawal, $tanggalakhir, $instalasi)
    {

        $query = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), 
                                          P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), 
                                          TOTAL	= ISNULL(SUM(JmlPasien),0) ,
                                          KdRuanganPelayanan,
                                          RuanganPelayanan,
                                          Detail,
                                          STS_FORMAT	 = '1'
                                    from V_DataKunjunganPasienKeluarBKondisiPulang 
                                    where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' 
                                      and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                UNION ALL
                                SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), 
                                          P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), 
                                          TOTAL	= ISNULL(SUM(JmlPasien),0) ,
                                          KdRuanganPelayanan,
                                          RuanganPelayanan,
                                          Detail,
                                          STS_FORMAT	 = '2'
                                    from V_DataKunjunganPasienKeluarBStatusPasien 
                                    where TglKeluar BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' 
                                      and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                 ORDER BY RuanganPelayanan,KdRuanganPelayanan,Detail");

        return $query->result();
    }

    function GetDataBulan($tahun1, $bulanawal, $bulanakhir, $instalasi)
    {

        $query = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), 
                                          P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), 
                                          TOTAL	= ISNULL(SUM(JmlPasien),0) ,
                                          KdRuanganPelayanan,
                                          RuanganPelayanan,
                                          Detail,
                                          STS_FORMAT	 = '1'
                                    from V_DataKunjunganPasienKeluarBKondisiPulang 
                                    where YEAR(TglKeluar) = '$tahun1' 
                                    and MONTH(TglKeluar) BETWEEN '$bulanawal' 
                                    and '$bulanakhir' 
                                    and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                UNION ALL
                                SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), 
                                          P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), 
                                          TOTAL	= ISNULL(SUM(JmlPasien),0) ,
                                          KdRuanganPelayanan,
                                          RuanganPelayanan,
                                          Detail,
                                          STS_FORMAT	 = '2'
                                    from V_DataKunjunganPasienKeluarBStatusPasien 
                                    where YEAR(TglKeluar) = '$tahun1' 
                                    and MONTH(TglKeluar) BETWEEN '$bulanawal' 
                                    and '$bulanakhir' 
                                    and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                 ORDER BY RuanganPelayanan,KdRuanganPelayanan,Detail");

        return $query->result();
    }

    function GetDataTahun($tahun2, $instalasi, $tahun3)
    {

        $query = $this->db->query("SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), 
                                          P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), 
                                          TOTAL	= ISNULL(SUM(JmlPasien),0) ,
                                          KdRuanganPelayanan,
                                          RuanganPelayanan,
                                          Detail,
                                          STS_FORMAT	 = '1'
                                    from V_DataKunjunganPasienKeluarBKondisiPulang 
                                    where YEAR(TglKeluar) BETWEEN '" . $tahun2 . "' 
                                    and '$tahun3' 
                                    and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                UNION ALL
                                SELECT L		= ISNULL(SUM(CASE WHEN JK = 'L' THEN   JmlPasien ELSE 0 END),0), 
                                          P 		= ISNULL(SUM(CASE WHEN JK = 'P' THEN   JmlPasien ELSE 0 END),0), 
                                          TOTAL	= ISNULL(SUM(JmlPasien),0) ,
                                          KdRuanganPelayanan,
                                          RuanganPelayanan,
                                          Detail,
                                          STS_FORMAT	 = '2'
                                    from V_DataKunjunganPasienKeluarBStatusPasien 
                                    where YEAR(TglKeluar) BETWEEN '" . $tahun2 . "' 
                                    and '$tahun3' 
                                    and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                 ORDER BY KdRuanganPelayanan,RuanganPelayanan,Detail");

        return $query->result();
    }

    public function getGrafik($tahun, $tanggalawal, $tanggalakhir, $instalasi, $status, $format)
    {
        // format tanggal
        if ($status == 1) {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                IDTANGGAL = CONVERT(DATE,TglKeluar),
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
                                                    IDTANGGAL = CONVERT(CHAR(4),TglKeluar,102),
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
