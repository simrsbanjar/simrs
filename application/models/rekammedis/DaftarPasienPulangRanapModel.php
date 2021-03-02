<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class DaftarPasienPulangRanapModel extends CI_Model
{
    public function getDataTable()
    {
        $tanggal   = date('Y-m-d');
        //$tangal   = '2020-12-16';

        $query  = $this->db->query("SELECT * FROM (SELECT NoCM, NamaLengkap AS NamaPasien, JenisKelamin, JenisPasien, NamaRuangan, TglPendaftaran, TglLahir, Telepon, Alamat, TglPulang, LamaDirawat,JenisDiagnosa.JenisDiagnosa as JenisDiagnosa, KodeDiagnosa as KodeDiagnosa,Diagnosa.NamaDiagnosa as NamaDiagnosa, Dokter, StatusPulang, KondisiPulang FROM V_DaftarPasienRawatInapPulang, JenisDiagnosa, Diagnosa WHERE V_DaftarPasienRawatInapPulang.KdJenisDiagnosa	= JenisDiagnosa.KdJenisDiagnosa AND V_DaftarPasienRawatInapPulang.Diagnosa	= Diagnosa.KdDiagnosa) AS COBA WHERE TglPendaftaran BETWEEN '" . $tanggal . " 00:00:00' AND '" . $tanggal . " 23:59:59' ORDER BY StatusPulang, KondisiPulang,TglPendaftaran,NamaPasien,NoCM");
        return $query->result();
    }

    public function getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext,  $kondisipulang)
    {
        if ($kondisipulang  == '1') {
            $query  = $this->db->query("SELECT * FROM (SELECT NoCM, NamaLengkap AS NamaPasien, JenisKelamin, JenisPasien, NamaRuangan, TglPendaftaran, TglLahir, Telepon, Alamat, TglPulang, LamaDirawat,JenisDiagnosa.JenisDiagnosa as JenisDiagnosa, KodeDiagnosa as KodeDiagnosa,Diagnosa.NamaDiagnosa as NamaDiagnosa, Dokter, StatusPulang, KondisiPulang FROM V_DaftarPasienRawatInapPulang, JenisDiagnosa, Diagnosa WHERE V_DaftarPasienRawatInapPulang.KdJenisDiagnosa	= JenisDiagnosa.KdJenisDiagnosa AND V_DaftarPasienRawatInapPulang.Diagnosa	= Diagnosa.KdDiagnosa) AS COBA WHERE TglPendaftaran BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59' AND JenisPasien LIKE '" . $jenispasien . "' AND NamaRuangan LIKE '" . $ruangan . "' AND (UPPER(NamaPasien) LIKE '%" . $caritext . "%' OR NoCM LIKE '%" . $caritext . "%') ORDER BY StatusPulang, KondisiPulang,TglPendaftaran,NamaPasien,NoCM");
        } elseif ($kondisipulang  == '2') {
            $query  = $this->db->query("SELECT * FROM (SELECT NoCM, NamaLengkap AS NamaPasien, JenisKelamin, JenisPasien, NamaRuangan, TglPendaftaran, TglLahir, Telepon, Alamat, TglPulang, LamaDirawat,JenisDiagnosa.JenisDiagnosa as JenisDiagnosa, KodeDiagnosa as KodeDiagnosa,Diagnosa.NamaDiagnosa as NamaDiagnosa, Dokter, StatusPulang, KondisiPulang FROM V_DaftarPasienRawatInapPulang, JenisDiagnosa, Diagnosa WHERE V_DaftarPasienRawatInapPulang.KdJenisDiagnosa	= JenisDiagnosa.KdJenisDiagnosa AND V_DaftarPasienRawatInapPulang.Diagnosa	= Diagnosa.KdDiagnosa AND V_DaftarPasienRawatInapPulang.KdStatusPulang != '13') AS COBA WHERE TglPendaftaran BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59' AND JenisPasien LIKE '" . $jenispasien . "' AND NamaRuangan LIKE '" . $ruangan . "' AND (UPPER(NamaPasien) LIKE '%" . $caritext . "%' OR NoCM LIKE '%" . $caritext . "%') ORDER BY StatusPulang, KondisiPulang,  TglPendaftaran,NamaPasien,NoCM");
        } else {
            $query  = $this->db->query("SELECT * FROM (SELECT NoCM, NamaLengkap AS NamaPasien, JenisKelamin, JenisPasien, NamaRuangan, TglPendaftaran, TglLahir, Telepon, Alamat, TglPulang, LamaDirawat,JenisDiagnosa.JenisDiagnosa as JenisDiagnosa, KodeDiagnosa as KodeDiagnosa,Diagnosa.NamaDiagnosa as NamaDiagnosa, Dokter, StatusPulang, KondisiPulang FROM V_DaftarPasienRawatInapPulang, JenisDiagnosa, Diagnosa WHERE V_DaftarPasienRawatInapPulang.KdJenisDiagnosa	= JenisDiagnosa.KdJenisDiagnosa AND V_DaftarPasienRawatInapPulang.Diagnosa	= Diagnosa.KdDiagnosa AND V_DaftarPasienRawatInapPulang.KdStatusPulang = '13') AS COBA WHERE TglPendaftaran BETWEEN '" . $awal . " 00:00:00' AND '" . $akhir . " 23:59:59' AND JenisPasien LIKE '" . $jenispasien . "' AND NamaRuangan LIKE '" . $ruangan . "' AND (UPPER(NamaPasien) LIKE '%" . $caritext . "%' OR NoCM LIKE '%" . $caritext . "%') ORDER BY StatusPulang, KondisiPulang, TglPendaftaran,NamaPasien,NoCM");
        }
        return $query->result();
    }
}
