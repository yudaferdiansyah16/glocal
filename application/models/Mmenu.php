<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmenu extends CI_Model
{
    /*
    function getMenu($app, $level){
        $sql1 = "select idapps, apps, idx, nmenu, parent, tipe, icon, controller, method, link from app_menu natural join app_smartone where parent=0 order by idapps, idx";
        $res1 = $this->db->query($sql1);
        $data1 = array();
        foreach ($res1->result() as $r1){
            if($r1->tipe == 3){
                $sql2 = "select * from (select ta.idapps, ta.idx, ta.nmenu, ta.parent, ta.tipe, ta.icon, ta.controller, ta.method, ta.link, tb.v$level as visible, tb.a$level as auth from app_menu ta, app_access_list tb where ta.idapps=tb.idapps and ta.idx=tb.idx and tb.userapp=$app and ta.idapps=$r1->idapps and ta.idx=$r1->idx and tipe=3) pa where visible=1 order by idapps, idx";
                $res2 = $this->db->query($sql2);
                $num2 = $res2->num_rows();
                if($num2>0){
                    foreach ($res2->result() as $r2){
                        $r2->apps = $r1->apps;
                        $data1[] = $r2;
                    }
                }
            } else {
                $sql2 = "select * from (select ta.idapps, ta.idx, ta.nmenu, ta.parent, ta.tipe, ta.icon, ta.controller, ta.method, ta.link, tb.v$level as visible, tb.a$level as auth from app_menu ta, app_access_list tb where ta.idapps=tb.idapps and ta.idx=tb.idx and tb.userapp=$app and ta.idapps=$r1->idapps and ta.parent=$r1->idx and ta.tipe=1) pa where visible=1 order by idapps, idx";
                $res2 = $this->db->query($sql2);
                $num2 = $res2->num_rows();
                if($num2>0){
                    $data1[] = $r1;
                    foreach ($res2->result() as $r2){
                        $data1[] = $r2;
                    }
                }
            }
        }
        return $data1;
    }*/

    function getMenu($app, $level)
    {
        $sql1 = "select * from app_smartone order by idapps";
        $res1 = $this->db->query($sql1);
        $data1 = array();
        foreach ($res1->result() as $r1){
            $sql2 = "select ta.*, tb.a$level access from app_menu ta, app_access_list tb where tb.userapp=$app and ta.idapps=$r1->idapps and ta.idapps=tb.idapps and ta.idx=tb.idx and tb.v$level=1 and parent=0 order by ta.idapps, ta.idx";
            $res2 = $this->db->query($sql2);
            $num2 = $res2->num_rows();

            if($num2>0){
                $data2 = array();
                foreach ($res2->result() as $r2){
                    //$sql3 = "select ta.*, tb.a$level, tb.v$level from app_menu ta, app_access_list tb where idapps=$r2->idapps and parent=$r2->idx";
                    $sql3 = "select ta.*, tb.a$level access from app_menu ta, app_access_list tb where tb.userapp=$app and ta.idapps=$r2->idapps and parent=$r2->idx and ta.idapps=tb.idapps and ta.idx=tb.idx and tb.v$level=1 order by ta.idapps, ta.idx";
                    $res3 = $this->db->query($sql3);
                    $num3 = $res3->num_rows();

                    if($num3>0){
                        $data3 = array();
                        foreach ($res3->result() as $r3){
                            $data3[] = $r3;
                        }
                        $r2->child = $data3;
                    }
                    $data2[] = $r2;
                }
                $r1->parent = $data2;
            }
            $data1[] = $r1;
        }

        $s = new stdClass();
        $s->group = $data1;

        printJSON($s);
    }

    function getMenuAccess($app, $level, $c, $m){
        $sql = "select a$level as auth from app_menu ta, app_access_list tb where ta.idapps=tb.idapps and ta.idx=tb.idx and tb.userapp=$app and ta.controller='$c' and ta.method='$m' and ta.link is null";
        $res = $this->db->query($sql);
        $num = $res->num_rows();
        $auth = 0;
        if($num>0){
            $row = $res->row();
            $auth = $row->auth;
        }

        return $auth;
    }

    function getActivityAccess($app, $level, $c, $m, $l=""){
        if(empty($l)) $sql = "select ta.link, a$level as auth from app_menu ta, app_access_list tb where ta.idapps=tb.idapps and ta.idx=tb.idx and tb.userapp=$app and ta.controller='$c' and ta.method='$m' and ta.link is not null";
        else $sql = "select ta.link, a$level as auth from app_menu ta, app_access_list tb where ta.idapps=tb.idapps and ta.idx=tb.idx and tb.userapp=$app and ta.controller='$c' and ta.method='$m' and ta.link='$l'";
        $res = $this->db->query($sql);
        $num = $res->num_rows();
        $data = array();
        if($num>0){
            foreach ($res->result() as $r){
                $data[$r->link] = $r->auth;
            }
        }
        return $data;
    }
}