<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title']  = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi sukses
            $this->_login();
        }
    }

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

    private function _login()
    {
        $username       =   $this->input->post('username');
        $password       =   $this->input->post('password');
        $ruangan        =   $this->input->post('ruangan');

        $user           =   $this->db->query("SELECT * FROM Login WHERE cast(Username as varchar)= '" . $username . "'")->row_array();
        $pwd_decript     =  $this->_decript($user['Password']);
        $ip             =   $this->getIp();
        $hostname        =  gethostbyaddr($ip);

        if ($ruangan    == '0') {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Ruangan belum dipilih</div>'
            );
            redirect('auth');
        } else {
            if ($user) {
                if ($password == $pwd_decript) {
                    $data = [
                        'idpegawai' => $user['IdPegawai'],
                        'ruangan'   => $ruangan,
                        'password' => $password,
                        'hostname'  => $hostname
                    ];

                    $loginaplikasi           = $this->db->get_where('LoginAplikasi', ['IdPegawai' => $user['IdPegawai']])->row_array();
                    if ($loginaplikasi) {
                        $loginruangan = $this->db->query("SELECT * FROM LoginRuangan WHERE IdPegawai = '" . $user['IdPegawai'] . "' AND KdRuangan ='" . $ruangan . "'")->result();

                        if ($loginruangan) {
                            if ($user['IdPegawai'] == "8888888888") {
                                $this->session->set_userdata($data);
                                //$this->session->set_userdata('coba');
                                redirect('user');
                            } else {
                                $settingglobal = $this->db->query("SELECT * FROM SettingGlobal where prefix = 'BerlakuExpirasiPasswordLogin' AND Value = '1'")->result();
                                if ($settingglobal) {
                                    $loginexpired = $this->db->query("SELECT * FROM LoginExpired where IdPegawai = '" . $user['IdPegawai'] . "' AND datediff( day, GETDATE(), TglExpired ) >= 1000")->result();

                                    if ($loginexpired) {
                                        $this->session->set_flashdata(
                                            'message',
                                            '<div class="alert alert-danger" role="alert">Password Anda telah Kadaluarsa, Silahkan ganti Password Anda..!!</div>'
                                        );
                                        redirect('auth');
                                    } else {
                                        $this->session->set_userdata($data);
                                        //$this->session->set_userdata('coba');
                                        redirect('user');
                                    }
                                } else {
                                    $this->session->set_userdata($data);
                                    //$this->session->set_userdata('coba');
                                    //$this->session->set_userdata('coba');
                                    redirect('user');
                                }
                            }
                        } else {
                            $this->session->set_flashdata(
                                'message',
                                '<div class="alert alert-danger" role="alert">User tidak berhak mengakses ruangan ini</div>'
                            );
                            redirect('auth');
                        }
                    } else {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger" role="alert">User tidak berhak mengakses ruangan ini</div>'
                        );
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">Password Salah</div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Username Tidak Ada.</div>'
                );
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Anda berhasil keluar.</div>'
        );
        redirect('auth');
    }

    public function getIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
