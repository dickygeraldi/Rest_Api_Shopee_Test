<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shoope_controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Shoope_model');
		$this->load->helper('url');
    }
    
    function form(){
        $this->get_exchange_rate();
    }

    function login_form(){
        $this->load->view('login.php');
    }

    function index(){
        $this->load->view('pendaftaran.php');
    }

    function tambah(){
        $this->load->view('tambah.php');
    }

    public function login(){
        // User must login to get token and to access all feature in website

        // $this->form_validation->set_rules('email', 'email', 'required|email');
        // $this->form_validation->set_rules('password', 'password', 'required|min_lenght[3]|max_length[100]');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $where = array(
                'email' => $email,
                'password' => md5($password)
            );
            $cek = $this->Shoope_model->cek_login($where)->num_rows();

            // if($cek > 0){
                $token = md5(rand(1, 100000000));
                $data_session = array(
                    'email' => $email,
                    'status' => "login",
                    'token' => $token
                    );
                $this->Shoope_model->update_token($email, $token);

                $this->session->set_userdata($data_session);
                redirect('Shoope_controller/form');
                // $this->response($data, 200);

            // }else{
            //     redirect('Shoope_controller/login');
            //     // $this->response(array('status' => 'email or password wrong', 502));
            // }
        }else{
            redirect('Shoope_controller/login_form');
            // $this->response(array('status' => 'validation error', 400));
        }
    }

    public function register(){
        // User register to website which wants to use all features

        // $this->form_validation->set_rules('email', 'email', 'required|email');
        // $this->form_validation->set_rules('password', 'password', 'required|min_lenght[3]|max_length[100]');
        // $this->form_validation->set_rules('nama', 'nama', 'required|min_lenght[3]|max_length[100]');

        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $nama  = $this->input->post('nama');

        if (filter_var($email, FILTER_VALIDATE_EMAIL) and is_string($nama) == TRUE){
            $cek = $this->Shoope_model->cek_data_email($email)->num_rows();

            if($cek > 0){
                $this->response(array('status' => 'email has been registered', 502));
            }else{
                
                $data = array(
                    'email'=> $email,
                    'password'=> md5($password),
                    'nama'=> $nama
                );

                $regist = $this->Shoope_model->register($data);

                if ($regist) {
                    redirect('Shoope_controller/login_form');
                    // $this->response($data, 200);
                } else {
                    redirect('Shoope_controller');
                    // $this->response(array('status' => 'fail', 502));
                }    
            }            
        }else{
            redirect('Shoope_controller');
            // $this->response(array('status' => 'validation error', 400));
        }
    }

    public function currencies_form()
    {
        $this->load->view('add_currencies');
    }

    public function currencies_submit(){
        // User can input daily exchange rate data

        // $this->form_validation->set_rules('date', 'date', 'required|date');
        // $this->form_validation->set_rules('from', 'from', 'required|min_lenght[3]|max_length[3]');
        // $this->form_validation->set_rules('to', 'to', 'required|min_lenght[3]|max_length[3]');
        // $this->form_validation->set_rules('rate', 'rate', 'required|float');
        
        // if ($this->form_validation->run() == FALSE){
        //     $this->response(array('status' => 'fail', 502));
        // }else{
            $date = $this->input->post('date');
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $rate = $this->input->post('rate');
            
            $token = array(
                'token' => $this->session->userdata('token')
            );

            $cek_token = $this->Shoope_model->get_token($token)->row();
            if (is_null($cek_token) == FALSE){
                // if ((is_string($from) == TRUE and is_string($to) == TRUE) and is_float($rate) == TRUE){
                    $where = array(
                        'from' => $from,
                        'to' => $to,
                        'user_id' => $cek_token->id
                    );
                    $track = $this->Shoope_model->track_data($where)->row();

                    if (is_null($cek_token) == FALSE){

                        $data = array(
                            'date' => $date,
                            'rate' => $rate,
                            'user_Id' => $cek_token->id,
                            'track_id' => $track->id
                        );
                        $insert = $this->Shoope_model->submit_currencies($data);
                        
                        if ($insert) {
                            redirect('Shoope_controller/form');
                            // $this->response($data, 200);
                        } else {
                            redirect('Shoope_controller/currencies_submit');
                            // $this->response(array('status' => 'fail', 502));
                        }
                    }else{
                        redirect('Shoope_controller/currencies_submit');
                        // $this->response(array('status' => 'User no have list, or invalid token', 502));
                    }
                // }else{
                //     $this->response(array('status' => 'validation error', 502));
                // }
            }else{
                $this->response(array('status' => 'Token not Found', 502));
            }
            //  }else{
            //      $this->response(array('status' => 'validation error', 502));
            //  }   
    }

    public function get_exchange_trend(){
        // User get exchange track trend from most recent 7 days points
        
        $token = array(
            'token' => $this->session->userdata('token')
        );

        $cek_token = $this->Shoope_model->get_token($token)->row();
        if (is_null($cek_token) == FALSE){
            $user_id = $cek_token->id;
            $date_from = '2018-07-01';
            // $date_from = CURRDATE();
            $date_to = date('Y-m-d', strtotime($date_from." + 6 days"));

            $data_trend = $this->Shoope_model->get_list_trend($user_id, $date_from, $date_to)->row();
            
            $track_id = $data_trend->track_id;
            
            $get_data = $this->Shoope_model->get_list_exchange_2($user_id, $date_from, $date_to, $track_id);

            // if($get_data->num_rows() > 0){
                $data["trend"] = $this->Shoope_model->get_list_trend($user_id, $date_from, $date_to);
                $data["list"] = $this->Shoope_model->get_list_exchange_2($user_id, $date_from, $date_to, $track_id);
                $this->load->view('trend', $data);
                // $this->response($get_data, 200);
            // }else{
                // $this->response(array('status' => 'No data', 502));
            // }
        }else{
            $this->response(array('status' => 'Token not Found', 502));
        } 
    }

    public function list_currencies(){
        // User has list of exchange rates to be tracked

        // $this->form_validation->set_rules('date', 'date', 'required|date');
        
        $date_from = $this->input->post('date_from');
        $date_to = date('Y-m-d', strtotime($date_from." + 6 days"));

        // if ($this->form_validation->run() == FALSE){
        //     $this->response(array('status' => 'fail', 502));
        // }else{
                
                // if is_date($date_from) == TRUE{
                
                $token = array(
                    'token' => $this->session->userdata('token')
                );

                $cek_token = $this->Shoope_model->get_token($token)->row();
                if (is_null($cek_token) == FALSE){
                    $user_id = $cek_token->id;
                    $data['avg'] = $this->Shoope_model->get_average($date_from, $date_to, $user_id);
                    $data['list'] = $this->Shoope_model->get_list_exchange_track($user_id, $date_from);
                    
                    // if (is_null($get_data_average) == FALSE and is_null($get_list_exchange_track) == FALSE){
                    //     $data = array();
                    //     $data_final = array();
                        
                    //     foreach ($get_list_exchange_track->result() as $record){
                    //         if(is_null($record->rate) == FALSE){
                    //             array_push($data, array(
                    //                 'from' => $record->from,
                    //                 'to' => $record->to,
                    //                 'rate' => $record->rate
                    //             ));    
                    //         }else{
                    //             array_push($data, array(
                    //                 'from' => $record->from,
                    //                 'to' => $record->to,
                    //                 'rate' => 'Insufficient data'
                    //             ));    
                    //         }
                    //     }

                    //     foreach ($get_data_average->result() as $rcrd){
                    //         if (is_null($rcrd->average) == FALSE){
                    //             array_push($data_final, array(
                    //                 'avg' => $rcrd->average
                    //             ));    
                    //         }else{
                    //             array_push($data_final, array(
                    //                 'avg' => 'Insufficient data'
                    //             ));    
                    //         }
                    //     }

                    //     $data_fix = array('data_main' => $data, 'data_avg' => $data_final);
                    //     $data_new['inter'] = json_encode($data_fix);

                        // if (is_null($json)) {
                            $this->load->view('list_currencies',$data);
                            // $this->response($json, 200);
                        // } else {
                        //     $this->response(array('status' => 'fail', 502));
                        // }
                    // }else{
                    //     $this->response(array('status' => 'Data not found', 502));
                    // }
                }else{
                    $this->response(array('status' => 'Token not Found', 502));
                }    
            // }else{
            //     $this->response(array('status' => 'validation error', 502));
            // }
        // }
    }

    public function add_exchange_rate(){
        // User add exchange rate to the list

        // $this->form_validation->set_rules('from', 'from', 'required|min_lenght[3]|max_length[3]');
        // $this->form_validation->set_rules('to', 'to', 'required|min_lenght[3]|max_length[3]');
        
        // if ($this->form_validation->run() == FALSE){
        //     $this->response(array('status' => 'fail', 502));
        // }else{
            $from = $this->input->post('from');
            $to = $this->input->post('to');

            $token = array(
                'token' => $this->session->userdata('token')
            );

            $cek_token = $this->Shoope_model->get_token($token)->row();
            
            if (is_null($cek_token) == FALSE){
                if (is_string($from) == TRUE and is_string($to) == TRUE){
                    $data = array(
                        'from' => $from,
                        'to' => $to,
                        'user_id' => $cek_token->id
                    );
                    $insert = $this->Shoope_model->add_exchange_rate($data);
                    
                    if ($insert) {
                       redirect('Shoope_controller/get_exchange_rate');
                        // $this->response($data, 200);
                    } else {
                        $this->add_form;
                        // $this->response(array('status' => 'fail', 502));
                    }
                }
            }else{
                $this->response(array('status' => 'token not found', 502));
            }    
        //     }else{
        //         $this->response(array('status' => 'validation error', 502));
        //     }
        // }
    }

    public function add_form(){
        $this->load->view('add_form');
    }

    function soft_remove_exchange_rate(){
        // Remove list exchange rate but not permanent and it's tracked by delete_at

        $id = $this->uri->segment(3);
        $token = array(
            'token' => $this->session->userdata('token')
        );

        $cek_token = $this->Shoope_model->get_token($token)->row();
        
        if (is_null($cek_token) == FALSE){

            $delete = $this->Shoope_model->update_deleted_track($cek_token->id, $id);
            
            if($delete > 0){
                $this->response("Success", 200);
            }else{
                $this->response(array('status' => 'No data', 502));
            }

        }else{
            $this->response(array('status' => 'token not found', 502));
        }
    }

    function hard_remove_exchange_rate(){
        // Remove permanent list exchange rate from list and database
        $id = $this->uri->segment(3);
        $token = array(
            'token' => $this->session->userdata('token')
        );

        $cek_token = $this->Shoope_model->get_token($token)->row();
        
        if (is_null($cek_token) == FALSE){

            $delete = $this->Shoope_model->update_deleted_track_2($cek_token->id, $id);
            $delete_all = $this->Shoope_model->delete_data_by_track_id($id);

            if($delete > 0){
                redirect('get_exchange_rate');
                // $this->response("Success", 200);
            }else{
                redirect('get_exchange_rate');                
                // $this->response(array('status' => 'No data', 502));
            }

        }else{
            redirect(get_exchange_rate);
            // $this->response(array('status' => 'token not found', 502));
        }
    }

    function get_exchange_rate(){
        // Load view all exchange currencies rate data where user_id is login and get per user_id

        $data = array(
            'token' => $this->session->userdata('token')
        );     

        $cek_token = $this->Shoope_model->get_token($data)->row();
        
        if (is_null($cek_token) == FALSE){
            
            $where = array(
                'user_id' => $cek_token->id,
                'delete_at' => NULL
            );

            $get_data = $this->Shoope_model->get_list_exchange($where);

            if($get_data->num_rows() > 0){
                $data_exchange['data'] = $this->Shoope_model->get_list_exchange($where);
                $this->load->view('form', $data_exchange);
                // $this->response($get_data, 200);
            }else{
                $this->load->view('form');
                // $this->response(array('status' => 'No data', 502));
            }
        }else{
            $this->load->view('form');
            // $this->response(array('status' => 'token not found', 502));
        }
    }

    function logout(){
        // Logout status and destroy session

        $destroy = $this->session->sess_destroy();
        if ($destroy) {
                $this->response('Success', 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }   
        }   
    }

?>
