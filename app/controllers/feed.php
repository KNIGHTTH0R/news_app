<?php
class Feed extends CI_Controller {
    
    public function index(){
        $data['feed_name'] = "News App";
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = base_url();
        $data['page_description'] = 'Top 10 News';
        $data['page_language'] = 'en-en';
        $data['news'] = $this->News_model->get_top_ten_news(10);    
        header("Content-Type: application/rss+xml");
         
        $this->load->view('rss', $data);
    }
}