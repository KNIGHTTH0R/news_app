<?php
class Home extends CI_Controller {
    
    public function index(){
        //Get the logged in users id
        //$user_id = $this->session->userdata('user_id');
        $user_id = $this->session->userdata('user_id');
        //Load view and layout
        $data['news'] = $this->News_model->get_top_ten_news();
        $data['main_content'] = 'home';
        $this->load->view('layouts/main',$data);

    }

}
