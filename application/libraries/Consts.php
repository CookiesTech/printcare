<?php
class Consts
{
    private $CI;
    public function __construct()
    {
        $this->CI = & get_instance();
        $this->setConstants();
    }
    private function setConstants()
    {
        $query = $this->CI->db->get('admin_setting');
        foreach($query->result() as $row)
        {
            define((string)$row->admin_setting_key, $row->admin_setting_value);
        }
        return ;
    }
}
