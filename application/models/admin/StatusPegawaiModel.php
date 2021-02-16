<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class StatusPegawaiModel extends CI_Model
{
    public $KdStatus;
    public $Status;
    public $QStatus;
    public $KodeExternal;
    public $NamaExternal;
    public $StatusEnabled;

    public function rules()
    {
        return [
            [
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            ]

        ];
    }

    public function getAll()
    {
        return $this->db->get("StatusPegawai")->result();
    }

    public function getById($KdStatus)
    {
        return $this->db->get_where("StatusPegawai", ["kdStatus" => $KdStatus])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kodeStatus = uniqid();
        $this->Status = $post["status"];
        $this->Status = $post["qstatus"];
        $this->Status = $post["kodeexternal"];
        $this->Status = $post["namaexternal"];
        $this->Status = $post["statusenabled"];
        $this->db->insert("StatusPegawai", $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->kodeStatus = uniqid();
        $this->Status = $post["status"];
        $this->Status = $post["qstatus"];
        $this->Status = $post["kodeexternal"];
        $this->Status = $post["namaexternal"];
        $this->Status = $post["statusenabled"];
        $this->db->update("StatusPegawai", $this, array('KdStatus' => $post['kodestatus']));
    }

    public function delete($KdStatus)
    {
        return $this->db->delete("StatusPegawai", array("kdStatus" => $KdStatus));
    }
}
