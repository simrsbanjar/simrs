<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UbahPassword extends CI_Controller
{
    private function _decript($strData)
    {
        $strData = '-' . $strData;
        $Code = "1234567890";
        $result = "";
        for ($i = 1; $i <= strlen($strData) - 1; $i++) {
            $lokasi = (($i) % strlen($Code));
            $result = $result . chr(ord(substr($strData, $i, 1)) ^ ord(substr($Code, $lokasi, 1)));
        }
        return $result;
    }

    public function index()
    {
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['title']          = 'Ubah Password';
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $data['menu']           = $this->db->query("SELECT * FROM ListMenuWeb WHERE StatusEnabled = '1' ORDER BY NoUrut")->result();
        $data['laporan'] = 'Ubah Password';

        $this->form_validation->set_rules('currentpassword', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'Password Baru', 'required|trim|min_length[3]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'Ulangi Password', 'required|trim|min_length[3]|matches[newpassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('auth/ubahpassword', $data);
            $this->load->view('templates/footer');
        } else {
            $currentpassword = $this->input->post('currentpassword');
            $newpassword = $this->input->post('newpassword1');

            if ($currentpassword  != $this->session->userdata('password')) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Password Lama Salah!!</div>'
                );
                redirect('UbahPassword');
            } else {
                if ($currentpassword == $newpassword) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">Password Baru Tidak Boleh Sama Dengan Password Lama</div>'
                    );
                    redirect('UbahPassword');
                } else {
                    //password ok
                    $pwd_decript     = $this->_decript($newpassword);
                    $this->db->query("UPDATE Login SET Password =cast('" . $pwd_decript . "' as VARBINARY) WHERE IdPegawai = '" . $this->session->userdata('idpegawai') . "'");

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">Password Berhasil Diubah.</div>'
                    );
                    redirect('UbahPassword');
                }
            }
        }
    }
}
