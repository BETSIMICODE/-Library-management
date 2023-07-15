<?php
//calcul of date difference

function diffDate($dateStart,$dateEnd){
    try {
        $dateStartArray=explode("-",$dateStart);
        $dateEndArray=explode("-",$dateEnd);
        //years
        $yearsStart=(int)$dateStartArray[0];
        $yearsEnd=(int)$dateEndArray[0];
        //month
        $monthStart=(int)$dateStartArray[1];
        $monthEnd=(int)$dateEndArray[1];
        //days
        $daysStart=(int)$dateStartArray[2];
        $daysEnd=(int)$dateEndArray[2];

        //calcul days date difference
        $diffDate=(($yearsEnd*366)+($monthEnd*12)+$daysEnd)-(($yearsStart*366)+($monthStart*12)+$daysStart);
        return $diffDate;
    } catch (Exception  $th) {
        return 0;
    }

}
function isDateFormat($str) {
    //true if the date has form date/month/years
    $regex = '/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/';
    return preg_match($regex, $str);
}
function convertDate($dateString) {
    //return date form years/month/date if the date has form date/month/years
    if (isDateFormat($dateString)){
        $date = DateTime::createFromFormat('d/m/Y', $dateString);
        return $date->format('Y/m/d');
    }else{
        return $dateString;
    };
    
}

?>