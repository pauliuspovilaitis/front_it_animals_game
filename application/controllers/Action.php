<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Action extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model');
    }

    //main functionality to ask the questions
    public function question($question = null)
    {
        $this->check_session();
        // retrieve session data
        $session_data = $this->session->all_userdata();
        $question_asked = $this->provide_question($session_data['temp']);
        $ask = $question_asked;
        
        if (isset($question)) {
            if ($this->input->post('yes')) {
                $guess = $this->get_animal_by_feature($question_asked);
            }
            if ($this->input->post('no')) {
                $this->remove_from_session_specific_data($question_asked);
                $session_data = $this->session->all_userdata();
                $question_asked = $this->provide_question($session_data['temp']);
                if ($question_asked !== FALSE) {
                    $ask = $question_asked;
                } else {
                    // unable to guess - need to add new animal
                    redirect('animal_add');
                }
            }
        }

        //check what needs to be passed to the view
        if(isset($ask) && !isset($guess))
        {
           $data['status'] = $ask;
        }
        if(isset($guess))
        {
           $data['status'] =  'I think the animal is: ' . $guess . '!';
        }
        
        //loading the view
        $this->__load_view($data);
    }
    
    // functionality to destroy the session
    public function reset()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }
    
    // function to check if the matrix exists in the session. if not - create the matrix
    private function check_session()
    {
        $check = $this->session->all_userdata();
        if (! isset($check['temp'])) {
            $temp['temp'] = $this->model->build_question_answer_matrix();
            $this->session->set_userdata($temp);
        }
    }
    
    // functionality to ask a question
    private function provide_question($data)
    {
        if (is_array($data)) {
            // asking the most common question.
            $temp = array();
            foreach ($data as $feature) {
                if (isset($feature['feature'])) {
                    array_push($temp, $feature['feature']);
                }
            }
            $counted = array_count_values($temp);
            arsort($counted);
            $return = key($counted);
            
            if ($return !== NULL) {
                return $return;
            } else {
                return FALSE;
            }
        }
    }
    
    // find the animal by passing his feature
    private function get_animal_by_feature($question)
    {
        $data = $this->session->all_userdata();
        $old_session_data = $data['temp'];
        foreach ($data['temp'] as $search_and_destroy) {
            if ($search_and_destroy['feature'] == $question) {
                $animal_found = $search_and_destroy['animal'];
                return $animal_found;
                break;
            }
        }
    }
    
    // functionality to remove specific data from session to have smaller answers matrix
    private function remove_from_session_specific_data($question)
    {
        $data = $this->session->all_userdata();
        $old_session_data = $data['temp'];
        $new_session_data = array();
        $i = 0;
        foreach ($data['temp'] as $search_and_destroy) {
            if ($search_and_destroy['feature'] !== $question) {
                $new_session_data[$i]['feature'] = $search_and_destroy['feature'];
                $new_session_data[$i]['animal'] = $search_and_destroy['animal'];
                $i++;
            }
        }
        $this->session->set_userdata('temp', $new_session_data);
    }

    private function __load_view($data = array())
    {
        $this->load->view('header');
        $this->load->view('gameplay', $data);
        $this->load->view('footer');
    }
}
