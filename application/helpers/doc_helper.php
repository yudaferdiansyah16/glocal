<?php

function docProcess($app, $jenis, $data){
    switch ($jenis){
        case 'SO':
            docSO($app, $data);
            break;
        case 'BOM':
            docBOM($app, $data);
            break;
        case 'Job':
            docJob($app, $data);
            break;
        case 'PO':
            docPO($app, $data);
            break;
        case 'DN':
            docDN($app, $data);
            break;
        case 'BCIn':
            docBCIn($app, $data);
            break;
        case 'WH':
            docWH($app, $data);
            break;
        case 'Request':
            docRequestProduction($app, $data);
            break;
        case 'Realisasi':
            docRealisasiProduction($app, $data);
            break;
        case 'Return':
            docReturProduction($app, $data);
            break;
        case 'Packing':
            docPacking($app, $data);
            break;
        case 'Stuffing':
            docStuffing($app, $data);
            break;
        case 'Invoice':
            docInvoice($app, $data);
            break;
        case 'BCOut':
            docBCOut($app, $data);
            break;
    }
}

function docSO($app, $d){
    $doc = new stdClass();
    $doc->id_po = $d->id;
    $doc->id_doc = $d->id;
    $doc->nomor = $d->kode_po;
    $doc->jenis = 'SO';
    docInsert($app, $doc);
}

function docBOM($app, $d){
    //get id so
    $sql = "select ta.id_po from t_po ta, t_detail_po tb where ta.id_po=tb.id_po and tb.id_detail_po=$d->id_detail_po";
    $res = $app->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $d->id;
    $doc->nomor = $d->kode_bom;
    $doc->jenis = 'BOM';
    docInsert($app, $doc);
}

function docJob($app, $d){
    $sql = "select ta.id_po from t_po ta, t_detail_po tb, t_bom tc where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=$d->id";
    $res = $app->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $d->id;
    $doc->nomor = $d->nomor;
    $doc->jenis = 'Job';
    docInsert($app, $doc);
}

function docPO($app, $d){
    $sql = "select ta.id_po, ti.id_po id_po2, ti.kode_po from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=$d->id";
    $res = $app->db->query($sql);
    $num = $res->num_rows();

    if($num>0){
        $row = $res->row();
        $doc = new stdClass();
        $doc->id_po = $row->id_po;
        $doc->id_doc = $row->id_po2;
        $doc->nomor = $row->kode_po;
        $doc->jenis = 'PO';
    } else {
        $sql = "select ti.id_po, ti.id_po id_po2, ti.kode_po from t_po ti, t_detail_po tj where ti.id_po=tj.id_po and tj.id_detail_po=$d->id";
        $res = $app->db->query($sql);
        $row = $res->row();

        $doc = new stdClass();
        $doc->id_po = $row->id_po;
        $doc->id_doc = $row->id_po2;
        $doc->is_rutin = 0;
        $doc->nomor = $row->kode_po;
        $doc->jenis = 'PO';
    }
    docInsert($app, $doc);
}

function docDN($app, $d){
    $sql = "select ta.id_po, tk.id_dn, tk.kode_dn, tl.no_sj from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=$d->id";
    $res = $app->db->query($sql);
    $num = $res->num_rows();

    if($num>0){
        $row = $res->row();

        $doc = new stdClass();
        $doc->id_po = $row->id_po;
        $doc->id_doc = $row->id_dn;
        $doc->is_rutin = 1;
        $doc->nomor = $row->kode_dn;
        $doc->jenis = 'DN';
        docInsert($app, $doc);
        //docDNItem($app, $d, $doc, $row->no_sj);
    } else {
        $sql = "select ti.id_po, tk.id_dn, tk.kode_dn, tl.no_sj from t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl where ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=$d->id";
        $res = $app->db->query($sql);
        $row = $res->row();

        $doc = new stdClass();
        $doc->id_po = $row->id_po;
        $doc->id_doc = $row->id_dn;
        $doc->is_rutin = 0;
        $doc->nomor = $row->kode_dn;
        $doc->jenis = 'DN';
        docInsert($app, $doc);
        //docDNItem($app, $d, $doc, $row->sj);
    }
}

/*
function docDNItem($app, $d, $docs, $sj){
    //doc repo
    $doc = new stdClass();
    $doc->id_po = $docs->id_po;
    $doc->id_doc = $d->id;
    $doc->is_rutin = $docs->is_rutin;
    $doc->nomor = $sj;
    $doc->jenis = 'DNItem';
    docInsert($app, $doc);
}
/**/

function docBCIn($app, $d){
    $sql1 = "select id_dn from t_dn where ID_HEADER=$d->id";
    $res1 = $app->db->query($sql1);
    $row1 = $res1->row();

    $sql2 = "select * from docs_repo where id_doc=$row1->id_dn and jenis='DN'";
    $res2 = $app->db->query($sql2);
    $row2 = $res2->row();

    $sql3 = "select NOMOR_AJU from smartone_tpb_dps1.tpb_header where ID='$d->id'";
    $res3 = $app->db->query($sql3);
    $row3 = $res3->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row2->id_po;
    $doc->id_doc = $row1->id_dn;
    $doc->is_rutin = $row2->is_rutin;
    $doc->nomor = $row3->NOMOR_AJU;
    $doc->jenis = 'BCIn';
    docInsert($app, $doc);
}

function docWH($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tk.id_dn, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$d->id";
    $res = $app->db->query($sql);
    $num = $res->num_rows();

    if($num>0){
        $row = $res->row();
    } else {
        $sql = "select ti.id_po, tm.id_wh, tk.id_dn, tm.kode_mutasi from t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$d->id";
        $res = $app->db->query($sql);
        $row = $res->row();
    }

    $sql2 = "select * from docs_repo where id_doc=$row->id_dn and jenis='DN'";
    $res2 = $app->db->query($sql2);
    $row2 = $res2->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_wh;
    $doc->is_rutin = $row2->is_rutin;
    $doc->nomor = $row->kode_mutasi;
    $doc->jenis = 'WH';
    docInsert($app, $doc);
}

function docRequestProduction($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docRealisasiProduction($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docReturProduction($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docPacking($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docStuffing($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docInvoice($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docBCOut($app, $d){
    $sql = "select ta.id_po, tm.id_wh, tm.kode_mutasi from t_po ta, t_detail_po tb, t_bom tc, t_bom_detail td, t_job te, t_detail_job tf, t_pp tg, t_detail_pp th, t_po ti, t_detail_po tj, t_dn tk, t_detail_dn tl, t_wh tm, t_wh_detail tn where ta.id_po=tb.id_po and tb.id_detail_po=tc.id_detail_po and tc.id_bom=td.id_bom and td.id_bom_detail=tf.id_bom_detail and te.id_job=tf.id_job and tf.id_detail_job=th.id_detail_job and tg.id_pp=th.id_pp and th.id_detail_pp=tj.id_detail_pp and ti.id_po=tj.id_po and tj.id_detail_po=tl.id_detail_po and tk.id_dn=tl.id_dn and tl.id_detail_dn=tn.id_detail_dn and tm.id_wh=tn.id_wh and tn.id_wh_detail=$id";
    $res = $this->db->query($sql);
    $row = $res->row();

    //doc repo
    $doc = new stdClass();
    $doc->id_po = $row->id_po;
    $doc->id_doc = $row->id_dn;
    $doc->nomor = $row->kode_dn;
    $doc->jenis = 'LPB';
    docInsert($app, $doc);
}

function docInsert($app, $d){
    $insert_query = $app->db->insert_string('docs_repo', $d);
    $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
    $app->db->query($insert_query);
}