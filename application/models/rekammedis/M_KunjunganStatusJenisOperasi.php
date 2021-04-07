<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganStatusJenisOperasi extends CI_Model
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
                                    from V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                    where TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' 
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
                                    from V_DataKunjunganPasienMasukBStatusPasien 
                                    where TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' and '" . $tanggalakhir . " 23:59:59' 
                                      and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                 ORDER BY KdRuanganPelayanan,RuanganPelayanan,Detail");

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
                                    from V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                    where YEAR(TglPendaftaran) = '$tahun1' 
                                    and MONTH(TglPendaftaran) BETWEEN '$bulanawal' 
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
                                    from V_DataKunjunganPasienMasukBStatusPasien 
                                    where YEAR(TglPendaftaran) = '$tahun1' 
                                    and MONTH(TglPendaftaran) BETWEEN '$bulanawal' 
                                    and '$bulanakhir' 
                                    and KdInstalasi ='" . $instalasi . "'
                                 GROUP BY KdRuanganPelayanan,RuanganPelayanan,Detail
                                 ORDER BY KdRuanganPelayanan,RuanganPelayanan,Detail");

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
                                    from V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                    where YEAR(TglPendaftaran) BETWEEN '" . $tahun2 . "' 
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
                                    from V_DataKunjunganPasienMasukBStatusPasien 
                                    where YEAR(TglPendaftaran) BETWEEN '" . $tahun2 . "' 
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
                                                   TANGGAL = CONVERT(DATE,TglPendaftaran)
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi 
                                             WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and KdInstalasi ='" . $instalasi . "'
                                            UNION ALL
                                            SELECT DISTINCT 
                                                   TANGGAL = CONVERT(DATE,TglPendaftaran)
                                              FROM V_DataKunjunganPasienMasukBStatusPasien 
                                             WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE B.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                                                and '" . $tanggalakhir . " 23:59:59' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                               ORDER BY CONVERT(DATE,TglPendaftaran) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdJenisOperasi,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, JenisOperasi B
                                        WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                            and '" . $tanggalakhir . " 23:59:59' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.JenisOperasi
                                        UNION ALL
                                        SELECT DISTINCT 
                                                KDKELOMPOK = CASE WHEN A.Detail = 'Baru' THEN '01' ELSE '02' END,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukBStatusPasien A
                                        WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                            and '" . $tanggalakhir . " 23:59:59' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE B.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                                                and '" . $tanggalakhir . " 23:59:59' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                            ORDER BY A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(DATE,A.TglPendaftaran), 
                                                  KDKELOMPOK = B.KdJenisOperasi,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, JenisOperasi B
                                             WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.JenisOperasi
                                               GROUP BY CONVERT(DATE,A.TglPendaftaran),B.KdJenisOperasi,A.Detail
                                            UNION ALL
                                            SELECT DISTINCT 
                                                  TANGGAL = CONVERT(DATE,A.TglPendaftaran), 
                                                  KDKELOMPOK = CASE WHEN A.Detail = 'Baru' THEN '01' ELSE '02' END,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukBStatusPasien A
                                             WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE B.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                                                and '" . $tanggalakhir . " 23:59:59' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                               GROUP BY CONVERT(DATE,A.TglPendaftaran),A.Detail
                                            ORDER BY CONVERT(DATE,A.TglPendaftaran)  ");
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
                                               UNION ALL
                                               SELECT DISTINCT 
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
                                              FROM V_DataKunjunganPasienMasukBStatusPasien 
                                             WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE YEAR(B.TglPendaftaran) = '$tahun'
                                                                and MONTH(B.TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                                                and '" . $tanggalakhir . "' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                               ORDER BY CONVERT(CHAR(2),TglPendaftaran,101) 
                                               ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdJenisOperasi,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, JenisOperasi B
                                        WHERE YEAR(TglPendaftaran) = '$tahun'
                                            and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.JenisOperasi
                                        UNION ALL
                                        SELECT DISTINCT 
                                                KDKELOMPOK = CASE WHEN A.Detail = 'Baru' THEN '01' ELSE '02' END,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukBStatusPasien A
                                        WHERE YEAR(TglPendaftaran) = '$tahun'
                                            and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE YEAR(B.TglPendaftaran) = '$tahun'
                                                                and MONTH(B.TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                                                and '" . $tanggalakhir . "' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                            ORDER BY A.Detail 
                                        ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(2),A.TglPendaftaran,101), 
                                                  KDKELOMPOK = B.KdJenisOperasi,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, JenisOperasi B
                                              WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.JenisOperasi
                                               GROUP BY CONVERT(CHAR(2),A.TglPendaftaran,101),B.KdJenisOperasi,A.Detail
                                            UNION ALL
                                            SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(2),A.TglPendaftaran,101), 
                                                  KDKELOMPOK =  CASE WHEN A.Detail = 'Baru' THEN '01' ELSE '02' END,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukBStatusPasien A
                                              WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE  YEAR(B.TglPendaftaran) = '$tahun'
                                                                and MONTH(B.TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                                                and '" . $tanggalakhir . "' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                               GROUP BY CONVERT(CHAR(2),A.TglPendaftaran,101),A.Detail
                                            ORDER BY CONVERT(CHAR(2),A.TglPendaftaran,101)");
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
                                               UNION ALL
                                               SELECT DISTINCT 
                                                   TANGGAL = CONVERT(CHAR(4),TglPendaftaran,102)
                                              FROM V_DataKunjunganPasienMasukBStatusPasien 
                                             WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE YEAR(B.TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                                                and '" . $tanggalakhir . "' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                               ORDER BY CONVERT(CHAR(4),TglPendaftaran,102) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdJenisOperasi,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, JenisOperasi B
                                        WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.JenisOperasi
                                        UNION ALL
                                        SELECT DISTINCT 
                                                KDKELOMPOK = CASE WHEN A.Detail = 'Baru' THEN '01' ELSE '02' END,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukBStatusPasien A
                                        WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE YEAR(B.TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                                                and '" . $tanggalakhir . "' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                            ORDER BY A.Detail
                                         ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(4),A.TglPendaftaran,102), 
                                                  KDKELOMPOK = B.KdJenisOperasi,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukIBSBJenisOperasi A, JenisOperasi B
                                              WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.JenisOperasi
                                               GROUP BY CONVERT(CHAR(4),A.TglPendaftaran,102),B.KdJenisOperasi,A.Detail
                                        UNION ALL
                                        SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(4),A.TglPendaftaran,102), 
                                                  KDKELOMPOK = CASE WHEN A.Detail = 'Baru' THEN '01' ELSE '02' END,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukBStatusPasien A
                                              WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND NOT EXISTS (SELECT 1	
                                                                FROM V_DataKunjunganPasienMasukIBSBJenisOperasi B
                                                                WHERE YEAR(B.TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                                                and '" . $tanggalakhir . "' 
                                                                and B.KdInstalasi ='" . $instalasi . "')
                                               GROUP BY CONVERT(CHAR(4),A.TglPendaftaran,102),A.Detail
                                            ORDER BY A.Detail,CONVERT(CHAR(4),A.TglPendaftaran,102)
                                         ");
            }
        }

        return $query->result();
    }
}
