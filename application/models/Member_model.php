<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $table = 'members';
    var $select_column = array('member_id', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'no_ktp', 'foto', 'email');
    var $order_column = array(null, 'nama', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'no_ktp', 'foto', 'email'); //set column field database for datatable orderable
    var $order = array('member_id' => 'asc'); // default order 

    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->like('nama', $_POST["search"]["value"]);
            $this->db->or_like('email', $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("member_id", "ASC");
        }
    }

    public function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getById($id)
    {
        return $this->db->get_where('members', ["member_id" => $id])->row_array();
    }

    public function add_data($data)
    {
        $this->db->insert('members', $data);
    }

    function edit_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_data($id)
    {
        $this->db->where('member_id', $id);
        $this->db->delete($this->table);
    }

    function get_all(){
        $this->db->select('*');
        $this->db->from('members');
        $query = $this->db->get();

        return $query->result();
    }
}
