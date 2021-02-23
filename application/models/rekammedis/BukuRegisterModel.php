<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class BukuRegisterModel extends CI_Model
{
    var $table  = 'StatusPegawai';
    var $column_order = array('KdStatus', 'Status', 'QStatus', 'KodeExternal', 'NamaExternal', 'StatusEnabled');
    var $order  = array('KdStatus', 'Status', 'QStatus', 'KodeExternal', 'NamaExternal', 'StatusEnabled');

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('Status', $_POST['search']['value']);
            $this->db->or_like('QStatus', $_POST['search']['value']);
            $this->db->or_like('KodeExternal', $_POST['search']['value']);
            $this->db->or_like('NamaExternal', $_POST['search']['value']);
            $this->db->or_like('StatusEnabled', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('KdStatus', 'ASC');
        }
    }
    public function getDataTable()
    {
        $this->_get_data_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function create($data)
    {
        $this->db->insert('StatusPegawai', $data);
        return $this->db->affected_rows();
    }

    public function getdataById($kdstatus)
    {
        return $this->db->get_where($this->table, ['KdStatus' => $kdstatus])->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($kdstatus)
    {
        $this->db->delete($this->table, ['KdStatus' => $kdstatus]);
        return $this->db->affected_rows();
    }
}
