<?php
class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $publicMethods = array(
            'show','pdf'
        );

        if( in_array( $this->uri->segment(2), $publicMethods ) ){
            return;
        }
        if(!$this->session->userdata('logged_in')){
            //Set error
            $this->session->set_flashdata('need_login', 'Sorry, you need to be logged in to view that area');
            redirect('home/index');
        }
    }
    
    public function index(){
        //Get the logged in users id
        //$user_id = $this->session->userdata('user_id');
        $user_id = $this->session->userdata('user_id');
        //Load view and layout
        $data['user_news'] = $this->News_model->get_top_ten_news_by_user($user_id);
        $data['main_content'] = 'news/index';
        $this->load->view('layouts/main',$data);

    }

    public function my_news(){
        //Get the logged in users id
        //$user_id = $this->session->userdata('user_id');
        $user_id = $this->session->userdata('user_id');
        //Load view and layout
        $data['headline'] = "All News";
        $data['user_news'] = $this->News_model->get_top_ten_news_by_user($user_id);
        $data['main_content'] = 'news/index';
        $this->load->view('layouts/main',$data);

    }
    
     public function show($id){

        $data['news'] = $this->News_model->get_news($id);

        //Load view and layout
        $data['main_content'] = 'news/show';
        $this->load->view('layouts/main',$data);
    }
    
    
    public function add(){

        $this->form_validation->set_rules('title','Title','trim|required|xss_clean');
        $this->form_validation->set_rules('news_text','News Details','trim|required|xss_clean');
        
        //upload image into temp dir
        $config = array(
            'image_library' => "gd2",
            'upload_path'   => "./uploads/news_images/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite'     => FALSE,
            'max_size'      => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height'    => "2040",
            'max_width'     => "2040"
        );

        

        if($this->form_validation->run() == FALSE){
            //Load view and layout
            $data['main_content'] = 'news/add_news';
            $this->load->view('layouts/main',$data);  
        } else {
            //Validation has ran and passed  
             //Post values to array
            $this->load->library('upload', $config);
            if($this->upload->do_upload('news_image')){
    
                $data = array(             
                    'title'        => $this->input->post('title'),
                    'news_text'    => $this->input->post('news_text'),
                    'news_image'   => $this->upload->file_name,
                    'added_by'     => $this->session->userdata('user_id'),
                    'is_published' => 1
                );
               if($this->News_model->create_news($data)){
                    $this->session->set_flashdata('news_created', 'News published successfully');
                    //Redirect to index page with error above
                    redirect('news/index');
               }
           }else{

                $this->session->set_flashdata('error', 'Error occured while uploading image. Please try again');
                //Redirect to index page with error above
                redirect('news/add');
           }
        }
    }
    

    
    public function delete($news_id){      
            //Delete News
            $this->News_model->delete_news($news_id);
            //Create Message
            $this->session->set_flashdata('news_deleted', 'Your list has been deleted');        
            //Redirect to News index
            redirect('news/index');
     }

    public function publish($news_id){      
            //Delete News
            $this->News_model->publish_news($news_id);
            //Create Message
            $this->session->set_flashdata('published', 'Your list has been published');        
            //Redirect to News index
            redirect('news/index');
     } 

    public function unpublish($news_id){      
            //Delete News
            $this->News_model->unpublish_news($news_id);
            //Create Message
            $this->session->set_flashdata('published', 'Your list has been unpublished');        
            //Redirect to News index
            redirect('news/index');
     }
    public function published(){      
        
        $user_id = $this->session->userdata('user_id');
        //Load view and layout

        $data['headline'] = "Published News";
        $data['user_news'] = $this->News_model->get_published_news_by_user_id($user_id);
        $data['main_content'] = 'news/index';
        $this->load->view('layouts/main',$data);
     } 

    public function unpublished(){      
            //Delete News
        $user_id = $this->session->userdata('user_id');
        $data['headline'] = "Unpublished News";
        //Load view and layout
        $data['user_news'] = $this->News_model->get_unpublished_news_by_user_id($user_id);
        $data['main_content'] = 'news/index';
        $this->load->view('layouts/main',$data);
     }


    public function pdf($news_id){
            $news =  $this->News_model->get_news($news_id);
            $pdf = generate_news_pdf($news);
     }


}
