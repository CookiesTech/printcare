<?php
Class Master_model extends CI_Model
{
    private $menu_html;
    public function __construct()
    {
        parent::__construct();
        $this->menu_html = '';
    }
    function getMenu()
    {
        $query = $this->db->query("SELECT name, alias_name FROM master");
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
   
    function getTable($alias)
    {
        //echo "SELECT name FROM master WHERE alias_name = '$alias'";
        $query = $this->db->query("SELECT name FROM master WHERE alias_name = '$alias'");
        return $query->result();
    }
    function add1($table, $data)
    {
        //print_r($data);
        $user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $date    = date('Y-m-d H:i:s');
        if ($table == 'business_sub_category') {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',ref_business_category_id = '" . $data['business_category_id'] . "',user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        } elseif ($table == 'area') {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',ref_country_id = '" . $data['country_id'] . "',ref_state_id = '" . $data['state_id'] . "', ref_district_id = '" . $data['district_id'] . "', user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        } elseif ($table == 'district') {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',ref_country_id = '" . $data['country_id'] . "',ref_state_id = '" . $data['state_id'] . "', user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        } elseif ($table == 'state') {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',ref_country_id = '" . $data['country_id'] . "', user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        } elseif ($table == 'product') {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',product_parent_id = '" . $data['product_parent_id'] . "', user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        } elseif ($table == 'proposal_basic_type') {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',proposal_basic_type_content = '" . $data['proposal_basic_type_content'] . "', user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        } else {
            $query = $this->db->query("INSERT INTO $table set " . $table . "_name = '" . $data[$table . '_name'] . "',user_id = '" . $user_id . "', added_date = '" . $date . "'");
            return true;
        }
    }
    
     function addRecord($main_table, $data, $customer_id = 0)
    {
				//~ echo "<pre>";
			//~ print_r( $data);
			//~ echo "</pre>";
			//~ exit;
        $user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $date    = date('Y-m-d H:i:s');
        foreach ($data as $key => $value) {
            if ($this->Common_model->startsWith($key, 'tbl_')) {
                $table_new                  = str_replace('tbl_', '', $key);
                $sub_table_data[$table_new] = $value;
            } else {
                if (strpos($key, '_date') !== false || strpos($key, 'valid_upto') !== false ) {
                    $date_field      = date("Y-m-d H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                } else {
                    $main_data[$key]         = $value;
                    $main_data['ref_user_id']    = $user_id;
                    $main_data['added_date'] = $date;
                }
            }
        }
        $this->db->insert($main_table, $main_data);
        $last_id = $this->db->insert_id();
        if (isset($sub_table_data) && !empty($sub_table_data)) {
            foreach ($sub_table_data as $key => $value) {
                $new_table = $key;
                foreach ($value as $key => $value) {
                    $value['ref_'.$main_table.'_id'] = $last_id;
                    $value['ref_user_id']    = $user_id;
                    $value['added_date'] = $date;
                    //$value['table_name'] = $main_table;
                    $new_data            = $value;
                    $this->db->insert($new_table, $new_data);
                }
            }
        }
        return $last_id;
    }
    
    function getDropdownList($table, $id = 0)
    {
        if ($table == 'district') {
            if ($id == 1503) {
                $query = $this->db->query("SELECT * FROM " . $table . " WHERE ref_state_id = '" . $id . "'  order by " . $table . "_name ASC");
            } else {
                $query = $this->db->query("SELECT * FROM " . $table . "  order by " . $table . "_name ASC");
            }
        } else if ($table == 'state') {
            $query = $this->db->query("SELECT * FROM " . $table . " WHERE ref_country_id = 99 order by " . $table . "_name ASC");
        } else {
            $query = $this->db->query("SELECT * FROM " . $table . "  order by " . $table . "_name ASC");
        }
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getListCount($main_table, $filter_data, $distinct_field = "")
    {
        //$main_table = 'lead';
        $filter_query  = array();
        $sql           = '';
        $filter_sql    = '';
        $join_query    = '';
        $select_fields = '';
        if (isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])) {
            foreach ($filter_data['filter_data'] as $data) {
                if ($data['value'] != '') {
                    if ($this->startsWith($data['field'], 'ref_')) {
                        $ref_field      = $data['field'];
                        $primary_field  = str_replace('ref_', '', $data['field']);
                        $table_name     = str_replace('_id', '', $primary_field);
                        $ref_data_field = $table_name . "_name";
                        $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                        $select_fields .= " , $table_name.$ref_data_field";
                        if ($data['operation'] == 'LIKE %...%') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $ref_data_field . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            } else {
                                $filter_query[] = $ref_data_field . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            }
                        } else {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $ref_data_field . " " . $data['operation'] . " '" . $data['value'] . "'";
                            } else {
                                $filter_query[] = $ref_data_field . " " . $data['operation'] . " '" . $data['value'] . "'";
                            }
                        }
                    } else {
                        if ($data['operation'] == 'LIKE %...%') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $data['field'] . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            } else {
                                $filter_query[] = $data['field'] . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            }
                        } else {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $data['field'] . " " . $data['operation'] . " '" . $data['value'] . "'";
                            } else {
                                $filter_query[] = $data['field'] . " " . $data['operation'] . " '" . $data['value'] . "'";
                            }
                        }
                    }
                }
            }
            if (isset($filter_query) && !empty($filter_query)) {
                $filter_sql .= " AND (";
                $filter_sql .= implode(" ", $filter_query);
                $filter_sql .= " ) ";
            }
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0";
        $sql .= $filter_sql;
        if (isset($distinct_field) && !empty($distinct_field)) {
            $primary_field = str_replace('ref_', '', $distinct_field);
            $table_name    = str_replace('_id', '', $primary_field);
            $sql .= " GROUP BY $main_table.$distinct_field ";
        }
        //echo $sql;				
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    function getList($main_table, $sort_data = '', $filter_data = '', $distinct_field = "")
    {
        //~ echo "<pre>";
        //~ print_r($sort_data);
        //~ echo "</pre>";
        $table_fields      = $this->getTableColumn($main_table);
        //print_r($table_fields);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        if (isset($filter_data['filter_data']) && !empty($filter_data['filter_data'])) {
            foreach ($filter_data['filter_data'] as $data) {
                if ($data['value'] != '') {
                    $filter_data_field[] = $data['field'];
                    if ($this->startsWith($data['field'], 'ref_')) {
                        $ref_field      = $data['field'];
                        $primary_field  = str_replace('ref_', '', $data['field']);
                        $table_name     = str_replace('_id', '', $primary_field);
                        $ref_data_field = $table_name . "_name";
                        $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                        $select_fields .= " , $table_name.$ref_data_field";
                        if ($data['operation'] == 'LIKE %...%') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $ref_data_field . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            } else {
                                $filter_query[] = $ref_data_field . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            }
                        } else {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $ref_data_field . " " . $data['operation'] . " '" . $data['value'] . "'";
                            } else {
                                $filter_query[] = $ref_data_field . " " . $data['operation'] . " '" . $data['value'] . "'";
                            }
                        }
                    } else {
                        if ($data['operation'] == 'LIKE %...%') {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $data['field'] . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            } else {
                                $filter_query[] = $data['field'] . " " . str_replace('%...%', "'%" . $data['value'] . "%'", $data['operation']) . "";
                            }
                        } else {
                            if (isset($data['filter_type'])) {
                                $filter_query[] = $data['filter_type'] . " " . $data['field'] . " " . $data['operation'] . " '" . $data['value'] . "'";
                            } else {
                                $filter_query[] = $data['field'] . " " . $data['operation'] . " '" . $data['value'] . "'";
                            }
                        }
                    }
                }
            }
            if (isset($filter_query) && !empty($filter_query)) {
                $filter_sql .= " AND (";
                $filter_sql .= implode(" ", $filter_query);
                $filter_sql .= " )";
            }
        }
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                if (isset($filter_data_field) && !empty($filter_data_field)) {
                    if (!in_array($data, $filter_data_field)) {
                        $ref_field      = $data;
                        $primary_field  = str_replace('ref_', '', $data);
                        $table_name     = str_replace('_id', '', $primary_field);
                        $ref_data_field = $table_name . "_name";
                        $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                        $select_fields .= " , $table_name.$ref_data_field";
                    }
                } else {
                    if ($this->startsWith($data, 'ref_')) {
                        $ref_field      = $data;
                        $primary_field  = str_replace('ref_', '', $data);
                        $table_name     = str_replace('_id', '', $primary_field);
                        $ref_data_field = $table_name . "_name";
                        $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                        $select_fields .= " , $table_name.$ref_data_field";
                    }
                }
            }
        }
        
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0";
        $sql .= $filter_sql;
        if (isset($distinct_field) && !empty($distinct_field)) {
            $primary_field = str_replace('ref_', '', $distinct_field);
            $table_name    = str_replace('_id', '', $primary_field);
            $sql .= " GROUP BY $table_name.$primary_field ";
        }
        if (isset($sort_data['sort']) && !empty($sort_data['sort'])) {
            $sql .= " ORDER BY " . $main_table . "." . $sort_data['sort'] . " " . $sort_data['order'] . "";
        }
        if (isset($sort_data['start'])) {
            $sql .= " LIMIT " . $sort_data['start'] . "," . RPP . "";
        }
        echo $sql;
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function getTableColumn($table)
    {
        if ($this->session->userdata('user_group') == 1) {
            $query = $this->db->query("SELECT DISTINCT COLUMN_NAME
									FROM INFORMATION_SCHEMA.COLUMNS
									WHERE TABLE_NAME= '" . $table . "' AND COLUMN_NAME != '" . $table . "_id' AND COLUMN_NAME != 'code' AND COLUMN_NAME != 'status'  AND COLUMN_NAME != 'iso_code_2' AND COLUMN_NAME != 'iso_code_3' ORDER BY ORDINAL_POSITION");
        } else {
            $query = $this->db->query("SELECT DISTINCT COLUMN_NAME
									FROM INFORMATION_SCHEMA.COLUMNS
									WHERE TABLE_NAME= '" . $table . "' AND COLUMN_NAME != '" . $table . "_id' AND COLUMN_NAME != 'delete_status' AND COLUMN_NAME != 'user_id' AND COLUMN_NAME != 'transaction_id' AND COLUMN_NAME != 'added_date' AND COLUMN_NAME != 'code' AND COLUMN_NAME != 'status'  AND COLUMN_NAME != 'iso_code_2' AND COLUMN_NAME != 'iso_code_3' ORDER BY ORDINAL_POSITION");
        }
        $result = array();
        foreach ($query->result() as $data) {
            $result[] = $data->COLUMN_NAME;
        }
        foreach ($result as $results) {
            if ($this->startsWith($results, 'ref_')) {
                $ref_field      = $results;
                $primary_field  = str_replace('ref_', '', $results);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $result[] .= "$ref_data_field";
            }
        }
        if ($query->num_rows() >= 1) {
            //print_r($result);
            return $result;
        } else {
            return false;
        }
    }
    function getDetails($main_table, $id_field, $id, $sort_field = "", $sort_data = "")
    {
        $table_fields      = $this->getTableColumn($main_table);
        $filter_query      = array();
        $sql               = '';
        $filter_sql        = '';
        $join_query        = '';
        $select_fields     = '';
        $filter_data_field = array();
        foreach ($table_fields as $data) {
            if ($this->startsWith($data, 'ref_')) {
                $ref_field      = $data;
                $primary_field  = str_replace('ref_', '', $data);
                $table_name     = str_replace('_id', '', $primary_field);
                $ref_data_field = $table_name . "_name";
                $join_query .= " LEFT JOIN $table_name ON $table_name.$primary_field = $main_table.$ref_field ";
                $select_fields .= " , $table_name.$ref_data_field";
            }
        }
        $sql .= "SELECT $main_table.*";
        if (isset($select_fields) && !empty($select_fields)) {
            $sql .= " $select_fields ";
        }
        $sql .= " FROM $main_table ";
        if (isset($join_query) && !empty($join_query)) {
            $sql .= $join_query;
        }
        $sql .= " WHERE ";
        $sql .= " $main_table.transaction_id = 0 AND ";
        $sql .= " $main_table.delete_status = 0 AND ";
        $sql .= " $id_field = '$id'";
        //echo $sql;
        if (!empty($sort_field) && !empty($sort_data)) {
            $sql .= " ORDER BY $sort_field $sort_data";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
/*
    function update($table, $data, $id)
    {
        $this->db->where($table . '_id', $id);
        $this->db->update($table, $data);
        //$this->db->last_query();
        return true;
    }
*/
    
    function update($main_table, $data, $id ) { 
        $user_id = $this->session->userdata(SESSION_LOGIN . 'user_id');
        $date = date('Y-m-d H:i:s');
        foreach ($data as $key => $value) {
            if ($this->Common_model->startsWith($key, 'tbl_')) {
                $table_new                  = str_replace('tbl_', '', $key);
                $sub_table_data[$table_new] = $value;
            } else {
                if (strpos($key, '_date') !== false) {
                    $date_field      = date("Y-m-d H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                }elseif (strpos($key, '_time') !== false) {
                    $date_field      = date("H:i:s", strtotime($data[$key]));
                    $main_data[$key] = $date_field;
                }
                else {
                    $main_data[$key]         = $value;
                    $main_data['ref_user_id'] = $user_id;
                    $main_data['added_date'] = $date;
                }
            }
        }
        
        $primary_field = $main_table.'_id';
        $res_record   = $this->Common_model->getRecord($main_table, $primary_field, $id);
        $audit_record = $res_record[0];
        unset($audit_record->$primary_field);
        $audit_record_final = array();
        foreach ($audit_record as $key => $val) {
            $audit_record_final[$key] = $val;
            if (strpos($key, '_date') !== false) {
                if ($val != '00-00-0000 00:00:00' && $val != '') {
                    $date_field               = date("Y-m-d H:i:s", strtotime($val));
                    $audit_record_final[$key] = $date_field;
                }
            }
        }
		
        
        //update Current record 
        $this->db->where($main_table.'_id', $id);
        $this->db->update($main_table, $main_data);
		

		return $id;
        
    }
    
    
    function removeRecord($main_table, $id_field, $id)
    {
        $data                  = array();
        $data['delete_status'] = '1';
        $this->db->where($id_field, $id);
        $this->db->update($main_table, $data);
        //$this->db->last_query();
        return $id;
    }
    function startsWith($string, $key)
    {
        // search backwards starting from haystack length characters from the end
        return $key === "" || strrpos($string, $key, -strlen($string)) !== FALSE;
    }
    function getTableFields($table)
    {
        $sql = "SELECT DISTINCT COLUMN_NAME, COLUMN_COMMENT
										FROM INFORMATION_SCHEMA.COLUMNS
										WHERE TABLE_NAME= '" . $table . "' AND COLUMN_COMMENT !=''";
        if ($this->session->userdata('user_group') != 1) {
            $sql .= " AND COLUMN_COMMENT !='Status' AND COLUMN_COMMENT !='User' AND COLUMN_COMMENT ";
        }
        $sql .= " ORDER BY ORDINAL_POSITION ";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function parentCheck($table,$cat_id)
    {
        $sql   = "select ".$table."_parent_id from $table where ".$table."_id=$cat_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            $res = $query->result();
            //echo $res[0]->product_parent_id;
            $id = $table.'_parent_id';
            return $res[0]->$id;
        } else {
            return false;
        }
    }
    function hasParent($table,$cat_id)
    {
        $rec_count = 1;
        do {
            $result = $this->parentCheck($table,$cat_id);
            $rec_count++;
            $cat_id = $result;
        } while ($result);
        return $rec_count;
    }
    function render_menu($table,$parent_id,$item_id)
    {
		//echo $item_id;
        $sql   = "select * from $table where ".$table."_parent_id=$parent_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            foreach ($query->result() as $key => $val) {
				$id = $table.'_id';
				$name = $table.'_name';
                if ($parent_id == 0)
                    $this->menu_html .= "<option value='" . $val->$id . "'>" . $val->$name . "</option>";
                else {
                    $rec_count = $this->hasParent($table,$val->$id);
                    $space     = '';
                    for ($i = 0; $i < $rec_count; $i++) {
                        $space .= '&nbsp;&nbsp;';
                    }
                   
                    if($val->$id == $item_id){
						 $this->menu_html .= "<option value='" . $val->$id . "' selected>" . $space . "--" . $val->$name . "</option>";
						//$this->menu_html.="<option value='".$val->product_id."' selected>".$space."--".$val->product_name."</option>";
					}else{
						 $this->menu_html .= "<option value='" . $val->$id . "'>" . $space . "--" . $val->$name . "</option>";
						//$this->menu_html.="<option value='".$val->product_id."'>".$space."--".$val->product_name."</option>";
					}
						
                   // $this->menu_html .= "<option value='" . $val->$id . "'>" . $space . "--" . $val->$name . "</option>";
                    $space = '';
                }
                $this->render_menu($table,$val->$id,$item_id);
                $this->menu_html .= "</option>";
            }
            return $this->menu_html;
        } else {
            return false;
        }
    }
    function getCategoryList($table,$item_id=0)
    {
		//echo $item_id;
       $category = $this->render_menu($table,0,$item_id);
        //exit;
        return $category;
    }
}
?>
