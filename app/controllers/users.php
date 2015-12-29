<?php
class Users extends CI_Controller{
    
    public function register(){
       // if($this->session->userdata('logged_in')){
        //    redirect('home/index');
        //}

        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');

        $passedCases = true;

        if($this->form_validation->run() == FALSE){
            //Load view and layout
            $data['main_content'] = 'users/register';
            $this->load->view('layouts/main',$data);
        //Validation has ran and passed    
        } else {
        	$passedCases = false;
        	$email = $this->input->post('email');

        	if(!$this->User_model->validate_user_exists($email)){
        	   if(!$this->User_activation_model->validate_user_exists($email)){
                    if($this->User_activation_model->create_member()){

		                $this->session->set_flashdata('registered', 'verificaion email have been sent, please verify the account');
		                //Redirect to index page with error above
		    			redirect('home/index');
		            }
                } else{
                        $objUserActivation = $this->User_activation_model->get_user_activation_by_email($email);
                        send_verification_mail($objUserActivation->email,$objUserActivation->hash);
                        $this->session->set_flashdata('registered', 'verificaion email have been resent, please verify the account');
                        redirect('home/index');
                }
		
		  	} else{
		       	$this->session->set_flashdata('already_member', 'You are already registered.Please login');
                redirect('home/index');
	       }
        }

    }


    public function verify(){
        // if($this->session->userdata('logged_in')){
        //     redirect('home/index');
        // }

        $email  = $this->input->get('email');
        $hash   = $this->input->get('hash');


        if($this->User_activation_model->validate_user_verification($email,$hash)) {

            $data['email']          = $email;
            $data['main_content']   = 'users/password';
            $this->load->view('layouts/main',$data);

           
        }
    }
    
    public function activate_user(){

        $this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
        $this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]|xss_clean');
        $this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]|xss_clean');
            
        if($this->form_validation->run() == FALSE){
            //Load view and layout
            $data['main_content'] = 'users/password';
            $this->load->view('layouts/main',$data);
        //Validation has ran and passed    
        } else {

           if($this->User_model->create_member()){
                $this->session->set_flashdata('registered', 'You are now registered, please log in');
                //Redirect to index page with error above
                redirect('home/index');
           }
        }


    }
    public function login(){
        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]|xss_clean');      
        $this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[50]|xss_clean');        
        
        if($this->form_validation->run() == FALSE){
            //Set error
            $this->session->set_flashdata('login_failed', 'Sorry, the login info that you entered is invalid');
            redirect('home/index');
        } else {
           //Get from post
           $username = $this->input->post('username');
           $password = $this->input->post('password');
               
           //Get user id from model
           $user_id = $this->User_model->login_user($username,$password);
               
           //Validate user
           if($user_id){
                $userInfo = $this->User_model->user_info_by_id($user_id);
               //Create array of user data
               $user_data = array(
                       'user_id'   => $user_id,
                       'username'  => $username,
                       'logged_in' => true,
                       'name'      => ucfirst($userInfo->first_name)." ".ucfirst($userInfo->last_name)
                );
                //Set session userdata
               $this->session->set_userdata($user_data);
                                  
               redirect('home/index');
            } else {
                //Set error
                $this->session->set_flashdata('login_failed', 'Sorry, the login info that you entered is invalid');
                redirect('home/index');
            }
        }
    }
    
    
    public function logout(){
        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        
         //Set message
        $this->session->set_flashdata('logged_out', 'You have been logged out');
        redirect('home/index');
    }
    
    
}
