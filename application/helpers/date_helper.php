<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_day_name_by_date')) {
    function get_day_name_by_date($date) {

        $day = date('D', strtotime($date));
        $day_list = array(
            "Mon" => "SENIN",
            "Tue" => "SELASA",
            "Wed" => "RABU",
            "Thu" => "KAMIS",
            "Fri" => "JUMAT",
            "Sat" => "SABTU",
            "Sun" => "MINGGU"
        );
        return $day_list[$day];
    }
}

if(!function_exists('change_format_date')) {
    function change_format_date($date, $format) {

        return date($format, strtotime($date));
    }
}

if(!function_exists('get_date')) {
    function get_date($format = 'Y-m-d') {
        date_default_timezone_set("Asia/Jakarta");
        return date($format);
    }
}

if(!function_exists('get_time')) {
    function get_time($format = 'H:i:s') {
        date_default_timezone_set("Asia/Jakarta");
        return date($format);
    }
}

if(!function_exists('get_cur_datetime')) {
    function get_cur_datetime($format = 'Y-m-d H:i:s') {
        date_default_timezone_set("Asia/Jakarta");
        return date($format);
    }
}

if(!function_exists('to_timestamp')) {
    function to_timestamp($datetime) {
        date_default_timezone_set("Asia/Jakarta");
        return (new DateTime($datetime))->getTimestamp();
    }
}

if(!function_exists('to_datetime')) {
    function to_datetime($timestamp) {
        date_default_timezone_set("Asia/Jakarta");
        $datetime =  new DateTime();
        $datetime->setTimestamp($timestamp);
        return $datetime->format('Y-m-d H:i:s');
    }
}

if(!function_exists('validangka')) {
    function validangka($angka){
        if (isset($angka)) {
            if(!is_numeric($angka)) {
                return 0;
            }else{
                return $angka;
            }
        }else{
            return 0;
        }
    }
}
?>