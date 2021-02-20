<?php defined('BASEPATH') or exit('No Dirext Script Access Allower');

class DiklatModel extends CI_Model
{
    var $table  = 'Diklat';
    var $column_order = array('KdDiklat', 'NamaDiklat', 'KdJenidDiklat', 'KodeExternal', 'NamaExternal', 'StatusEnabled');
    var $order  = array('KdDiklat', 'NamaDiklat', 'KdJenidDiklat', 'KodeExternal', 'NamaExternal', 'StatusEnabled');

    private function _get_data_query()
    {
        $this->db->from($this->table);
        if (isset($_POST['search']['value'])) {
            $this->db->like('NamaDiklat', $_POST['search']['value']);
            $this->db->or_like('KdJenisDiklat', $_POST['search']['value']);
            $this->db->or_like('KodeExternal', $_POST['search']['value']);
            $this->db->or_like('NamaExternal', $_POST['search']['value']);
            $this->db->or_like('StatusEnabled', $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('KdDiklat', 'ASC');
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
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function getdataById($kode)
    {
        return $this->db->get_where($this->table, ['KdDiklat' => $kode])->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($kode)
    {
        $this->db->delete($this->table, ['KdDiklat' => $kode]);
        return $this->db->affected_rows();
    }
}
