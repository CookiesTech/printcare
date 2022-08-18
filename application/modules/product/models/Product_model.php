<?php
Class Product_model extends CI_Model {    
	private $menu_html;
	 public function __construct() {
        parent::__construct();
        $this->menu_html = '';
    }    

}
?>
