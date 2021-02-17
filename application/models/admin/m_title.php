<?php
class M_title extends CI_Model
{
    //Nodel function edit
    public function edit($editkdtitle)
    {
        $query = $this->db->where("KdTitle", $editkdtitle)->get("Title");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    // Model function Hapus
    public function hapus($kodetitle)
    {
        $query = $this->db->delete("Title", $kodetitle);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
