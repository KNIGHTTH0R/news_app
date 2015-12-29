<?php
class User_model extends CI_Model{
     
    public function create_member(){
        $new_member_insert = array(
            'first_name'       => $this->input->post('first_name'),
            'last_name'        => $this->input->post('last_name'),
            'email'            => $this->input->post('email'),                   
            'password'         => md5($this->input->post('password')),
            'is_active'        => 1
        );

        $user_activation = array(
            'is_active'        => 1
        );

        $this->db->trans_start();
            $update = $this->User_activation_model->update_by_email($this->input->post('email'),$user_activation);
            $insert = $this->db->insert('users', $new_member_insert);
        $this->db->trans_complete();
        return ( $insert && $update );
    }
    
    
    public function login_user($username,$passowrd){
        //Secure password
        $enc_password = md5($passowrd);
        
        //Validate
        $this->db->where('email',$username);
        $this->db->where('password',$enc_password);
        
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function user_info_by_id($id){

        $this->db->where('id',$id);
        $query = $this->db->get('users');
        if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
    //validation

    function validate_user_exists($email){
      $this->db->from('users');
      $this->db->where('email',$email );
      $records = $this->db->get()->result();
      if( 0 == count( $records ) ) {
        return false;
      } else {
        return true;
      }
    }
    
}
