<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Html_helper {
      
    public function build_select_boxes($data)
    {
        $html = '';
        if(is_array($data))
        {
            foreach ($data as $element)
            {
                $html .= "<input type='checkbox' name='features[]' value='".$element['id']."'>".$element['feature']."<br />" . PHP_EOL;
            }           
            return $html;
        }
        else
        {
            return FALSE;
        }       
    }    
}