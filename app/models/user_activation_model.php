<?php
class User_activation_model extends CI_Model{



    public function get_user_activation_by_email($email){

        $this->db->from('user_activations');
        $this->db->where('email',$email);
        $query = $this->db->get();
         if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }
    
    public function create_member(){
        $new_member_insert = array(
            'email'             => $this->input->post('email'),
            'hash'              => md5( rand(0,1000) )
        );
        send_verification_mail($new_member_insert['email'],$new_member_insert['hash']);
        $insert = $this->db->insert('user_activations', $new_member_insert);
        return $insert;
    }

    public function update_by_email($email,$data){
        $this->db->where('email', $email);
        $this->db->update('user_activations', $data); 
        return TRUE;

    }

    //validations
    public function validate_user_exists($email){
    	//validate whether user already exixts
    	//$email = $this->input->post('email');
      	$this->db->from('user_activations');
      	$this->db->where('email',$email );
      	$records = $this->db->get()->result();
      	if( 0 == count( $records ) ) {
        	return false;
      	} else {
        	return true;
      	}
    }

    public function validate_user_verification($email,$hash){
        //validate whether user already exixts
        //$email = $this->input->post('email');
        $this->db->from('user_activations');
        $this->db->where('email',$email );
       // $this->db->where('hash',$hash );
        $records = $this->db->get()->result();

        if( 0 == count( $records ) ) {
            return false;
        } else {
            return true;
        }
    }
}