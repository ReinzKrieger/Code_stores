  
<?php

class Login_M extends CI_Model
{
    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function register($enc_password)
    {
        // User data array
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
            'role_id' => 2,
            'is_active' => 1,
        );

        // Insert user
        return $this->db->insert('users', $data);
    }

    function cek_session()
    {
        return $this->session->userdata('username');
    }
}
?>