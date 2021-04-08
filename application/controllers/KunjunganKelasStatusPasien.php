<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KunjunganKelasStatusPasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekammedis/M_KunjunganKelasStatusPasien');
    }
    function index()
    {
        $data['tahun'] = $this->M_KunjunganKelasStatusPasien->gettahun();

        $data['title'] = 'Kunjungan Berdasarkan Status dan Kelas Pasien';
        $data['laporan'] = 'Laporan Berdasarkan Status dan Kelas';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/KunjunganKelasStatusPasien', $data);
        $this->load->view('templates/footer');
    }

    public function Grafik()
    {
        $this->form_validation->set_rules('instalasi', 'Instalasi', 'trim|required');
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $tahun3 = $this->input->post('tahun3');
        $periode = $this->input->post('periode');
        $instalasi = $this->input->post('instalasi');

        if ($periode == 1) {
            $data['tanggal']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '1');
            $data['hasil']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '2');
            $data['total']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '3');
        } elseif ($periode == 2) {
            $data['tanggal']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '1');
            $data['hasil']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '2');
            $data['total']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '3');
        } else {
            $data['tanggal']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '1');
            $data['hasil']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '2');
            $data['total']    = $this->M_KunjunganKelasStatusPasien->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '3');
        }

        echo json_encode($data);
    }


    function filter()
    {
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $nilaifilter = $this->input->post('nilaifilter');
        $tahun3 = $this->input->post('tahun3');
        $format = $this->input->post('flexRadioDefault');

        if ($nilaifilter == 1) {
            $instalasi = $this->input->post('instalasi');

            $data['title'] = "Laporan Kunjungan Kelas dan Status Pasien Berdasarkan Tanggal";
            $data['subtitle'] = date('d-m-Y', strtotime($tanggalawal)) . ' s.d : ' . date('d-m-Y', strtotime($tanggalakhir));
            $data['instalasi'] = $instalasi;
            if ($format == '1') {
                $data['datafilter'] = $this->M_KunjunganKelasStatusPasien->filterbytanggal($tanggalawal, $tanggalakhir, $instalasi);
                $data['kelaspelayanan'] = $this->M_KunjunganKelasStatusPasien->GetKelasPelayananTgl($tanggalawal, $tanggalakhir, $instalasi);
                $data['statuspasien'] = $this->M_KunjunganKelasStatusPasien->GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi);
                $data['ruangan'] = $this->M_KunjunganKelasStatusPasien->GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi);
            };
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'format' => $format,
                'tahun' => $tahun1,
                'tahun1' => $tahun1,
                'tahun2' => $tahun2,
                'tahun3' => $tahun3,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganKelasStatusPas', $data);
        } elseif ($nilaifilter == 2) {
            $instalasi = $this->input->post('instalasi1');

            if ($bulanawal == '1') {
                $bulanawaltext = 'Januari';
            } else if ($bulanawal == '2') {
                $bulanawaltext = 'Februari';
            } else if ($bulanawal == '3') {
                $bulanawaltext = 'Maret';
            } else if ($bulanawal == '4') {
                $bulanawaltext = 'April';
            } else if ($bulanawal == '5') {
                $bulanawaltext = 'Mei';
            } else if ($bulanawal == '6') {
                $bulanawaltext = 'Juni';
            } else if ($bulanawal == '7') {
                $bulanawaltext = 'Juli';
            } else if ($bulanawal == '8') {
                $bulanawaltext = 'Agustus';
            } else if ($bulanawal == '9') {
                $bulanawaltext = 'September';
            } else if ($bulanawal == '10') {
                $bulanawaltext = 'Oktober';
            } else if ($bulanawal == '11') {
                $bulanawaltext = 'November';
            } else {
                $bulanawaltext = 'Desember';
            }

            if ($bulanakhir == '1') {
                $bulanakhirtext = 'Januari';
            } else if ($bulanakhir == '2') {
                $bulanakhirtext = 'Februari';
            } else if ($bulanakhir == '3') {
                $bulanakhirtext = 'Maret';
            } else if ($bulanakhir == '4') {
                $bulanakhirtext = 'April';
            } else if ($bulanakhir == '5') {
                $bulanakhirtext = 'Mei';
            } else if ($bulanakhir == '6') {
                $bulanakhirtext = 'Juni';
            } else if ($bulanakhir == '7') {
                $bulanakhirtext = 'Juli';
            } else if ($bulanakhir == '8') {
                $bulanakhirtext = 'Agustus';
            } else if ($bulanakhir == '9') {
                $bulanakhirtext = 'September';
            } else if ($bulanakhir == '10') {
                $bulanakhirtext = 'Oktober';
            } else if ($bulanakhir == '11') {
                $bulanakhirtext = 'November';
            } else {
                $bulanakhirtext = 'Desember';
            }


            $data['title'] = "Laporan Kunjungan Kelas dan Status Pasien Berdasarkan Bulan";;
            $data['subtitle'] =  $bulanawaltext . ' s.d ' . $bulanakhirtext . ' Tahun : ' . $tahun1;
            $data['instalasi'] = $instalasi;
            if ($format == '1') {
                $data['datafilter'] = $this->M_KunjunganKelasStatusPasien->filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
                $data['kelaspelayanan'] = $this->M_KunjunganKelasStatusPasien->GetKelasPelayananBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
                $data['statuspasien'] = $this->M_KunjunganKelasStatusPasien->GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
                $data['ruangan'] = $this->M_KunjunganKelasStatusPasien->GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            }
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'format' => $format,
                'tahun' => $tahun1,
                'tahun1' => $tahun1,
                'tahun2' => $tahun2,
                'tahun3' => $tahun3,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganKelasStatusPas', $data);
        } elseif ($nilaifilter == 3) {
            $instalasi = $this->input->post('instalasi2');

            $data['title'] = "Laporan Kunjungan Kelas dan Status Pasien Berdasarkan Tahun";;
            $data['subtitle'] =  $tahun2 . ' s.d ' . $tahun3;
            $data['instalasi'] = $instalasi;
            if ($format == '1') {
                $data['datafilter'] = $this->M_KunjunganKelasStatusPasien->filterbytahun($tahun2, $instalasi, $tahun3);
                $data['kelaspelayanan'] = $this->M_KunjunganKelasStatusPasien->GetKelasPelayananTahun($tahun2, $instalasi, $tahun3);
                $data['statuspasien'] = $this->M_KunjunganKelasStatusPasien->GetStatusPasienTahun($tahun2, $instalasi, $tahun3);
                $data['ruangan'] = $this->M_KunjunganKelasStatusPasien->GetRuanganTahun($tahun2, $instalasi, $tahun3);
            }
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'format' => $format,
                'tahun' => $tahun1,
                'tahun1' => $tahun1,
                'tahun2' => $tahun2,
                'tahun3' => $tahun3,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganKelasStatusPas', $data);
        }
    }
}
