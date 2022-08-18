<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/Facebook/Facebook.php';
 
class FB extends Facebook
{
    function __construct()
    {
		//~ $config = ([
		  //~ 'app_id' => '119324968723954', // Replace {app-id} with your app id
		  //~ 'app_secret' => '53fdb8d89e14a8effa6633435bf870bf',
		  //~ 'default_graph_version' => 'v2.2',
		//~ ]);
        parent::__construct();
    }

}
 
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
