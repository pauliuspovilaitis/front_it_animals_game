<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
    //function to get all the animal features randomly 
    public function get_all_features()
    {
        $this->db->select('id, feature')->from('features')->order_by('rand()');
        $query = $this->db->get();                
        if (!empty($query))
        {
            return $query->result_array();
        }  
        else 
        {
            return FALSE;
        }   
    }
    //build question/answer matrix
    public function build_question_answer_matrix()
    {
        $sql = "SELECT feature, animal FROM matrix m
                         LEFT JOIN features f
                         on f.id = m.feature_key
                         LEFT JOIN animals a
                         on a.id = m.animal_key 
                         where animal <> '' and feature <> ''
                         order by feature";  
        $results = $this->db->query($sql);
        $return = $results->result_array();
        if (!empty($return))
        {
             return $return;
        }
        else
        {
            return FALSE;
        }                
    }
    //add new animal into animals and matrix tables
    public function add_new_animal($animal_name, $features)
    {
        //adding animal name
        $data = array(
            'animal' => $animal_name,
        );
        $this->db->insert('animals', $data);
        //get newly inserted animal key
        $this->db->select('id')->from('animals')->where('animal', $animal_name);
        $query = $this->db->get();
        if (!empty($query))
        {
            $id_array = $query->result_array();
        }      
        //adding features to the matrix
        if(isset($id_array[0]['id']))
        {
            if(is_array($features))
            {
                foreach ($features as $fill_matrix)
                {                    
                    $this->db->insert('matrix', array('feature_key' => $fill_matrix, 'animal_key' => $id_array[0]['id']));                    
                }
            }
        }   
    }
  
}