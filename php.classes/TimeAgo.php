<?php
function convertToTimeAgo($date)
{
    if(empty($date)) {
        return "No date provided";
    }
 
    $periods         = array("s", "min", "h", "d", "w", "M", "Y", "Decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
 
    $now             = time();
    $unix_date         = strtotime($date);
 
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }
 
    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
 
    } else {
        $difference     = $unix_date - $now;
        $tense         = "ago";
    }
 
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
 
    $difference = round($difference);
 
    if($difference != 1) {
        /*$periods[$j].= "s";*/
    }
 
    /*return "$difference$periods[$j] {$tense}";*/
    return "$difference$periods[$j]";
}
 
$date = "2009-03-04 17:45";
$result = convertToTimeAgo($date); // 2 days ago
 
?>