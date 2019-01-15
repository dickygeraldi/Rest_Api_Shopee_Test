<?php

class Shoope_model extends CI_Model{

    function submit_currencies($data){
        $insert_data = $this->db->insert('exchange_rate', $data);
        return $insert_data;
    }

    function add_exchange_rate($data){
        $insert_data = $this->db->insert('track', $data);
        return $insert_data;
    }

    function get_exchange_rate($data){
        return $this->db->get_where('exchange_rate', $data);
    }

    function update_deleted_track($user_id, $id){
        $sql = "update track set delete_at = '".date_create("now")."' where user_id = '".$user_id."' and id = '".$id."'";
        return $this->db->query($sql)->first_row();
    }

    function track_data($where){
        return $this->db->get_where('track', $where);
    }

    function get_list_exchange_track($user_id, $date){
        $sql = "SELECT * FROM exchange_rate as er inner join track as t on t.id = er.track_id WHERE er.user_id = '".$user_id."' and er.date = '".$date."' group by er.track_id";
        return $this->db->query($sql);
    }

    function get_list_exchange_2($user_id, $date_to, $date_from, $track_id){
        $sql = "select * from exchange_rate as er where er.date between '".$date_to."' and '".$date_from."'
                 and er.user_id = '".$user_id."' and er.track_id ='".$track_id."' order by er.date DESC";
        return $this->db->query($sql);
    }

    function get_list_trend($user_id, $date_from, $date_to){
        $sql = "select t.from, t.to, avg(er.rate) as average, (max(er.rate) - min(er.rate)) as variance, er.track_id
            from exchange_rate as er inner join track as t on t.id = er.track_id where er.user_id = '".$user_id."' 
            and er.date BETWEEN '".$date_from."' and '".$date_to."' group by er.track_id order by variance DESC";
        return $this->db->query($sql);
    }

    function get_average($date_from, $date_to, $user_id){
        $sql = "SELECT AVG(er.rate) as average FROM exchange_rate as er inner join track as t on t.id = er.track_id WHERE er.user_id = '".$user_id."' and er.date BETWEEN '".$date_from."' and '".$date_to."' group by er.track_id";
        return $this->db->query($sql);
    }
    
    function update_deleted_track_2($user_id, $id){
        $sql = "DELETE From track where user_id = '".$user_id."' and id = '".$id."'";
        return $this->db->query($sql);
    }

    function delete_data_by_track_id($id){
        $sql = "DELETE from exchange_rate where track_id = '".$id."'";
        return $this->db->query($sql);
    }

    function get_list_exchange($where){
        return $this->db->get_where('track', $where);
    }

    function cek_login($where){
        return $this->db->get_where("user", $where);
    }

    function register($data){
        return $this->db->insert('user', $data);
    }

    function update_token($email, $token){
        $sql = "update user set token = '".$token."' where email = '".$email."'";
        return $this->db->query($sql);
    }

    function get_token($token){
        return $this->db->get_where('user', $token);
    }

    public function cek_data_email($emal){
        $sql = "select * from user where email ='".$emal."'";
        return $this->db->query($sql);
    }
}

?>