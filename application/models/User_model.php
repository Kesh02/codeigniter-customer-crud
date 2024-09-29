<?php
class User_model extends CI_Model {

    public function insert_user($data) {
        return $this->db->insert('customers', $data);
    }

    public function get_all_users() {
        $query = $this->db->get('customers');
        return $query->result();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('customers', $data);

    }


    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('customers');
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('customers');
        return $query->row();
    }
    
    
}
