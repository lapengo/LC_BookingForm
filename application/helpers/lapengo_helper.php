<?php

function _log($action){
    $ci = get_instance();
    $table = 'ms_log';
    if ($ci->agent->is_browser()){
        $agent = $ci->agent->browser().' '.$ci->agent->version();
    }elseif ($ci->agent->is_mobile()){
        $agent = $ci->agent->mobile();
    }else{
        $agent = 'Data user gagal di dapatkan';
    }
    $id_user = ($ci->session->userdata('id')!=NULL)?$ci->session->userdata('id'):0;
    $data = array(
        'ip_address' => $ci->input->ip_address(),
        'browser' => $agent,
        'os' => $ci->agent->platform(),
        'action' => $action,
        'id_user' => $id_user,
    );
    $x = $ci->db->insert($table, $data);
    return $x;
}

function cmb_dinamis($name,$table,$field,$pk,$selected='',$active='',$class=''){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    if ($active!='') {
        $data = $ci->db->get_where($table, array($active => 'Y'))->result();
    }
    $cmb .= '<option value="">-- Pilih --</option>';
    foreach ($data as $d){
        $cmb .= "<option value='".$d->$pk."'";
        $cmb .= "class='".$pk."'";
        if($class!=''){
            $cmb .= " ".$d->$class."'";            
        }
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .= ">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}
//fungsi mengubah tanggal menjadi format indonesia 1
function tgl_ina($parameter){ //ini untuk mengubah format 2015-06-15 menjadi 15 Juni 2015
    $thn = substr($parameter, 0, 4); //mengambil 4 digit dari kiri, 0 adalah index pertama dari tahun (angka 2 dari 2015), 4 banyaknya digit yang diambil
    $b=substr($parameter, 5, 2); //mengambil 2 digit, index 5 adalah angka 0 dari 06
    $tgl=substr($parameter, -2); //mengambil 2 digit dari kanan
        if ($b==1){ $bln="Januari";}
        else if ($b==2){ $bln="Februari"; }
        else if ($b==3){ $bln="Maret"; }
        else if ($b==4){ $bln="April"; }
        else if ($b==5){ $bln="Mei"; }
        else if ($b==6){ $bln="Juni"; }
        else if ($b==7){ $bln="Juli"; }
        else if ($b==8){ $bln="Agustus"; }
        else if ($b==9){ $bln="Spetember"; }
        else if ($b==10){ $bln="Oktober"; }
        else if ($b==11){ $bln="November"; }
        else if ($b==12){ $bln="Desember"; }
    $tanggal=$tgl."-".$bln."-".$thn;
    return $tanggal;
}

function rupiah($parameter){
  $rupiah=number_format($parameter,0,',','.');
  return $rupiah;
}

function hitung_sisa_hari($tgl){
    
    $waktusekarang=date("Y-m-d");
    $datetime1 = new DateTime($waktusekarang); //penggunaan class Datetime yg sudah ada di php
    $datetime2 = new DateTime($tgl);
    $interval = $datetime1->diff($datetime2);
    $selisih_bulan= $interval->m;
    $selisih_hari= $interval->d;
    $selisih = $selisih_bulan." bulan ".$selisih_hari." hari";
    return $selisih; //mengubah nilai parameter menjadi nilai selisih
    
    //return date('Y-m-d')->diff(date('Y-m-d', $tgl));
}


function msgbox($msg,$url){
    return "<script>window.alert('$msg');window.location=('$url');</script>";
}


function back() {
    return '<script>history.go(-1);</script>';
}

function validate($data) {
    return htmlentities(trim(strip_tags($data)));
}

function get_kodeunik($table,$field,$char,$awalan=NULL,$date=FALSE) { 
    $ci = get_instance();
    $q = $ci->db->query("SELECT MAX(RIGHT(".$field.",".$char.")) AS idmax FROM ".$table);
    $kd = ""; //kode awal
    if($q->num_rows()>0){ //jika data ada
        foreach($q->result() as $k){
            $kd = $tmp = ((int)$k->idmax)+1; //string kode diset ke integer dan ditambahkan 1 dari kode terakhir
            //$kd = sprintf($char, $tmp); //kode ambil 4 karakter terakhir
        }
    }else{ //jika data kosong diset ke kode awal
        $kd = "0001";
    }
    $kar = ($awalan!=NULL)?$awalan:""; //karakter depan kodenya
    //gabungkan string dengan kode yang telah dibuat tadi
    $date = ($date!=NULL)?date("Ymd"):"";
    return $kar.$date.$kd;//..$kd;
} 

$x='
<ol class="breadcrumb">
<?php $a = json_decode($breadcrumb); foreach ($a as $key => $value): ?>
    <li><a href="<?=$value->link?>"><i class="<?=$value->icon?>"></i> <?=$value->name?></a></li>
<?php endforeach ?>
</ol>
';
if (!function_exists('create_breadcrumb')) {
    function create_breadcrumb($initial_crumb = '', $initial_crumb_url = '') {
        $ci = &get_instance();
        $open_tag = '<ol class="breadcrumb">';
        $close_tag = '</ol>';
        $crumb_open_tag = '<li>';
        $active_crumb_open_tag = '<li class="active">';
        $crumb_close_tag = '</li>';
        $separator = '<span class="crumb-separator"></span>';
        $total_segments = $ci->uri->total_segments();
        $breadcrumbs = $open_tag;
        if ($initial_crumb != '') {
            $breadcrumbs .= $crumb_open_tag;
            $breadcrumbs .= create_crumb_href($initial_crumb, false, true) . $separator;
        }
        
        $segment = '';
        $crumb_href = '';
        
        for ($i = 1; $i <= $total_segments; $i++) {
            
            $segment = $ci->uri->segment($i);
            $crumb_href .= $ci->uri->segment($i) . '/';
            
            if ($total_segments > $i) {
                $breadcrumbs .= $crumb_open_tag;
                $breadcrumbs .= create_crumb_href($segment, $crumb_href);
                $breadcrumbs .= $separator;
            }else{
                $breadcrumbs .= $active_crumb_open_tag;
                $breadcrumbs .= create_crumb_href($segment, $crumb_href);
            }
            
            $breadcrumbs .= $crumb_close_tag;
        }
        $breadcrumbs .= $close_tag;
        return $breadcrumbs;
    }
}
if (!function_exists('create_crumb_href')) {
    function create_crumb_href($uri_segment, $crumb_href = false, $initial = false) {
        $ci = &get_instance();
        $base_url = $ci->config->base_url();
        
        $crumb_href = rtrim($crumb_href, '/');
        
        if($initial) {
            return '<a href="' . $base_url . '">' . ucwords(str_replace(array('-', '_'), ' ', $uri_segment)) . '</a>';
        }else{
            return '<a href="' . $base_url . $crumb_href . '">' . ucwords(str_replace(array('-', '_'), ' ', $uri_segment)) . '</a>';
        }
    }
}


if (!function_exists('template_email_murid_baru')) {
    function template_email_murid_baru($data=array()) {
        $ci = &get_instance();
        $base_url = $ci->config->base_url();
        
        $crumb_href = rtrim($crumb_href, '/');
        
        if($initial) {
            return '<a href="' . $base_url . '">' . ucwords(str_replace(array('-', '_'), ' ', $uri_segment)) . '</a>';
        }else{
            return '<a href="' . $base_url . $crumb_href . '">' . ucwords(str_replace(array('-', '_'), ' ', $uri_segment)) . '</a>';
        }
    }
}

