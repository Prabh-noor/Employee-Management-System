<?php
class DateUtils{
    public static function formatDate($date){
        $dateObj= strtotime($date);
        return date('d M, Y', $dateObj);
    }
    public static function formatDateTime($dateTime){
        $dateObj = strtotime($dateTime);
        return date('d M, Y h:i a', $dateObj);
    }
}
?>