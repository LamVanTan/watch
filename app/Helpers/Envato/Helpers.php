<?php
if (!function_exists('data_tree')) {
    function data_tree($data, $parent_id = 0, $level = 0 )
	{
	    $result = [];
	    foreach ($data as $item) {
	    	
	        if ($item->cat_parent_id == $parent_id) {
	            $item->level = $level;
	            //$item->parent_cha = $parent_cha;
	            $result[] = $item;
	            //unset($data[$item->cat_id]);
	            $child = data_tree($data, $item->cat_id, $level + 1);
	            $result = array_merge($result, $child);
	        }
	    }
	    return $result;
	}	
}

if (!function_exists('category')) {
	function category($data, $parent_id = 0, $char = ' ')
      {    
          foreach ($data as $key=>$item) {
              if ($item->cat_parent_id == $parent_id) {
                  echo '<option  value="'.$item->cat_id.'">'.$char.$item->cat_name.'</option>';
                  unset($data[$key]);
                  //tiep tuc de quy tim danh muc con
                  category($data,$item->cat_id, $char.' --> ');   
              }
          }
      }
}

