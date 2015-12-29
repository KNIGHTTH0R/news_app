<?php
class News_model extends CI_Model{

	public function get_top_ten_news(){
        $this->db->where('is_published', 1 );
        $this->db->order_by('added_on', 'desc');
        $this->db->limit(10);
        $query = $this->db->get('news');
        return $query->result();
    }
    
    public function get_top_ten_news_by_user($user_id){
        $this->db->where('added_by',$user_id);
        $this->db->order_by('added_on', 'desc'); 
        $query = $this->db->get('news');
        return $query->result();
    }

    public function get_news($id){
        $this->db->select('*');
        $this->db->from('news');
        $this->db->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows() != 1){
            return FALSE;
        }
        return $query->row();
    }

    public function create_news($data){
        $this->db->set('added_on', 'NOW()');
	    $insert = $this->db->insert('news', $data);
	    return $insert;
    }
    
    public function delete_news($news_id){
        $this->db->where('id',$news_id);
        $this->db->delete('news');
        return;
    }

    public function unpublish_news($news_id){
        $this->db->where('id',$news_id);
        $this->db->set('is_published', 0, FALSE);
        $this->db->update('news');
        return;
    }
    public function publish_news($news_id){
        $this->db->where('id',$news_id);
        $this->db->set('is_published', 1, TRUE);
        $this->db->update('news');
        return;
    }
    public function get_published_news_by_user_id($user_id){
        $this->db->where('added_by',$user_id);
        $this->db->where('is_published',1);
        $this->db->order_by('added_on', 'desc'); 
        $query = $this->db->get('news');
        return $query->result();
    }
    public function get_unpublished_news_by_user_id($user_id){
        $this->db->where('added_by',$user_id);
        $this->db->where('is_published',0);
        $this->db->order_by('added_on', 'desc'); 
        $query = $this->db->get('news');
        return $query->result();
    }
    
}