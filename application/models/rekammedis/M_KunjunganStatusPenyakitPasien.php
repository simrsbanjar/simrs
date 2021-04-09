<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_KunjunganStatusPenyakitPasien extends CI_Model
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
                                    from V_DataKunjunganPasienMasukBKasusPenyakit 
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
                                    from V_DataKunjunganPasienMasukBKasusPenyakit 
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
                                    from V_DataKunjunganPasienMasukBKasusPenyakit 
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
                                 ORDER BY RuanganPelayanan,KdRuanganPelayanan,Detail");

        return $query->result();
    }

    public function getGrafik($tahun, $tanggalawal, $tanggalakhir, $instalasi, $status, $format)
    {
        // format tanggal
        if ($status == 1) {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                     IDTANGGAL = CONVERT(DATE,TglPendaftaran),
                                                   TANGGAL = CONVERT(DATE,TglPendaftaran)
                                              FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit 
                                             WHERE TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(DATE,TglPendaftaran) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdSubInstalasi,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit A, SubInstalasi B
                                        WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                            and '" . $tanggalakhir . " 23:59:59' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.NamaSubInstalasi
                                            ORDER BY B.KdSubInstalasi, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(DATE,A.TglPendaftaran), 
                                                  KDKELOMPOK = B.KdSubInstalasi,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit A, SubInstalasi B
                                             WHERE A.TglPendaftaran BETWEEN '" . $tanggalawal . " 00:00:00" . "' 
                                               and '" . $tanggalakhir . " 23:59:59' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.NamaSubInstalasi
                                               GROUP BY CONVERT(DATE,A.TglPendaftaran),B.KdSubInstalasi,A.Detail
                                            ORDER BY A.Detail,B.KdSubInstalasi,CONVERT(DATE,A.TglPendaftaran) ");
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
                                              FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit 
                                             WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(CHAR(2),TglPendaftaran,101) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdSubInstalasi,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit A, SubInstalasi B
                                        WHERE YEAR(TglPendaftaran) = '$tahun'
                                            and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.NamaSubInstalasi
                                            ORDER BY B.KdSubInstalasi, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(2),A.TglPendaftaran,101), 
                                                  KDKELOMPOK = B.KdSubInstalasi,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit A, SubInstalasi B
                                              WHERE YEAR(TglPendaftaran) = '$tahun'
                                               and MONTH(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.NamaSubInstalasi
                                               GROUP BY CONVERT(CHAR(2),A.TglPendaftaran,101),B.KdSubInstalasi,A.Detail
                                            ORDER BY A.Detail,B.KdSubInstalasi,CONVERT(CHAR(2),A.TglPendaftaran,101) ");
            }
            // format tahun
        } else {
            if ($format == '1') {
                $query = $this->db->query("SELECT DISTINCT 
                                                    IDTANGGAL = CONVERT(CHAR(4),TglPendaftaran,102),
                                                   TANGGAL = CONVERT(CHAR(4),TglPendaftaran,102)
                                              FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit 
                                             WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and KdInstalasi ='" . $instalasi . "'
                                               ORDER BY CONVERT(CHAR(4),TglPendaftaran,102) ");
            } else if ($format == '2') {
                $query = $this->db->query("SELECT DISTINCT 
                                                KDKELOMPOK = B.KdSubInstalasi,
                                                KELOMPOK = A.Detail
                                        FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit A, SubInstalasi B
                                        WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                            and '" . $tanggalakhir . "' 
                                            and A.KdInstalasi ='" . $instalasi . "'
                                            AND A.Detail	= B.NamaSubInstalasi
                                            ORDER BY B.KdSubInstalasi, A.Detail ");
            } else {
                $query = $this->db->query("SELECT DISTINCT 
                                                  TANGGAL = CONVERT(CHAR(4),A.TglPendaftaran,102), 
                                                  KDKELOMPOK = B.KdSubInstalasi,
                                                  KELOMPOK = A.Detail,
                                                  JUMLAH	= SUM(A.JmlPasien) 
                                              FROM V_DataKunjunganPasienMasukBstatusBkasusPenyakit A, SubInstalasi B
                                              WHERE YEAR(TglPendaftaran) BETWEEN '" . $tanggalawal . "' 
                                               and '" . $tanggalakhir . "' 
                                               and A.KdInstalasi ='" . $instalasi . "'
                                               AND A.Detail	= B.NamaSubInstalasi
                                               GROUP BY CONVERT(CHAR(4),A.TglPendaftaran,102),B.KdSubInstalasi,A.Detail
                                            ORDER BY A.Detail,B.KdSubInstalasi,CONVERT(CHAR(4),A.TglPendaftaran,102) ");
            }
        }

        return $query->result();
    }
}
