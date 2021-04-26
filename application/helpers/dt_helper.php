<?php

function dtInit($data){

}

function dtSort($par, $mapping = array()){
    $sql = "";
    $max = @count($par->order);
    if($max>0){
        $i = 0;
        foreach ($par->order as $o){
            $cols = $o['column'];
            $colname = $par->columns[$cols]['data'];
            if(in_array($colname, $mapping)) $sortby = $mapping[$colname];
            else $sortby = $colname;
            $sortdir = $o['dir'];
            if($i>0) $sql .= ", ".$sortby." ".$sortdir;
            else $sql .= " order by ".$sortby." ".$sortdir;
            $i++;
        }
    }
    return $sql;
}

function dtLimit($par){
    $sql = "";
    if($par->length>0) $sql = " limit ".$par->start.", ".$par->length;
    return $sql;
}

function dtLimitPG($par){
    $sql = "";
    if($par->length>0) $sql = " limit ".$par->length." offset ".$par->start;
    return $sql;
}

function dtSearch($app, $par, $mapping = array()){
    $sql = "";
    $keyword = strtolower($par->search['value']);
    if(!empty($keyword)){
        $where = " where (";
        foreach ($par->columns as $col){
            if($col['searchable'] === 'true'){
                $colname = $col['data'];
                if(in_array($colname, $mapping)) $field = $mapping[$colname];
                else $field = $colname;

                if(isset($field)){
                    if(is_array($field)){
                        foreach ($field as $f){
                            $where .= "LOWER(". $f . ") like '%" . $app->db->escape_str($keyword) . "%' or ";
                        }
                    } else {
                        $where .= "LOWER(". $field . ") like '%" . $app->db->escape_str($keyword) . "%' or ";
                    }
                    unset($field);
                }
            }
        }
        $where = substr_replace($where, "", -4);
        $sql .= $where . ")";
    }
    return $sql;
}