<?php
function getmodeinfo($mode) {
    $scoretable='osu_scores';
    $userstatstable='osu_user_stats';
    $suffix='';
    switch ($mode) {
        case 0:
            $modename='osu!';
            break;
        case 1:
            $modename='Taiko';
            $suffix='_taiko';
            break;
        case 2:
            $modename='Catch The Beat';
            $suffix='_fruits';
            break;
        case 3:
            $modename='osu!mania';
            $suffix='_mania';
            break;
    }
    $scoretable.=$suffix;
    $userstatstable.=$suffix;
    $highscoretable="{$scoretable}_high";
    return array($modename,$scoretable,$highscoretable,$userstatstable);
}
function getShortModString($modVal,$hideNone) {
    $modList = "";
    if (($modVal & 1) > 0)
        $modList .= "NF,";
    if (($modVal & 2) > 0)
        $modList .= "EZ,";
    if (($modVal & 8) > 0)
        $modList .= "HD,";
    if (($modVal & 1048576) > 0)
        $modList .= "FI,";
    if (($modVal & 16) > 0)
        $modList .= "HR,";
    if (($modVal & 512) > 0)
        $modList .= "NC,";
    else if (($modVal & 64) > 0)
        $modList .= "DT,";
    if (($modVal & 128) > 0)
        $modList .= "Relax,";
    if (($modVal & 256) > 0)
        $modList .= "HT,";
    if (($modVal & 1024) > 0)
        $modList .= "FL,";
    if (($modVal & 4096) > 0)
        $modList .= "SO,";
    if (($modVal & 8192) > 0)
        $modList .= "AP,";
    if (($modVal & 16384) > 0)
        $modList .= "PF,";
    else if (($modVal & 32) > 0)
        $modList .= "SD,";

    if (($modVal & 32768) > 0)
        $modList .= "4K,";
    else if (($modVal & 65536) > 0)
        $modList .= "5K,";
    else if (($modVal & 131072) > 0)
        $modList .= "6K,";
    else if (($modVal & 262144) > 0)
        $modList .= "7K,";
    else if (($modVal & 524288) > 0)
        $modList .= "8K,";
    else if (($modVal & 16777216) > 0)
        $modList .= "9K,";

    if (strlen($modList) == 0 && !$hideNone)
        $modList = "None";

    if (strlen($modList) > 0)
        $modList = trim($modList,",");
    return $modList;
}
function gettime($type,$time) {
    global $lang,$clientlang;
    switch ($type) {
        case 0:
            $type=$lang['second'];
            break;
        case 1:
            $type=$lang['minute'];
            break;
        case 2:
            $type=$lang['hour'];
            break;
        case 3:
            $type=$lang['day'];
            break;
    }
    $msg="$time $type";
    if ($clientlang === 'en' && $time > 1) {
        $msg.='s';
    }
    return $msg;
}
function getminutesecond($minute) {
    return $minute*60;
}
function gethoursecond($hour) {
    return $hour*getminutesecond(60);
}
function getdaysecond($day) {
    return $day*gethoursecond(24);
}
function TranTime($time) {
    global $lang;
    date_default_timezone_set('Asia/Shanghai');
    //$time=strtotime($time);
    $nowTime=time();
    $seconds=$nowTime - $time;
    if ($seconds < getdaysecond(1)) {
        //一天内
        if ($seconds < gethoursecond(1)) {
            //一小时内
            if ($seconds < getminutesecond(1)) {
                //一分钟内
                /*
                if ($seconds < 10) {
                    $message=$lang['now'];
                } else {
                    $message=sprintf($lang['ago'],gettime(0,$seconds));
                }
                */
                $message=$lang['now'];
            } else {
                $message=sprintf($lang['ago'],gettime(1,intval($seconds / 60)));
            }
        } else {
            $hours=idate('H',$nowTime) - idate('H',$time);
            if (idate('d',$nowTime) != idate('d',$time)) {
                $hours+=24;
            }
            $message=sprintf($lang['ago'],gettime(2,$hours));
        }
    } elseif ($seconds < getdaysecond(2)) {
        $message=sprintf($lang['yesterday'],date('H:i',$time));
    } elseif ($seconds < getdaysecond(3)) {
        $message=sprintf($lang['the_day_before_yesterday'],date('H:i',$time));
    } elseif ($seconds < getdaysecond(90)) {
        $message=sprintf($lang['ago'],gettime(3,ceil($seconds/3600/24)));
    } else {
        $message=date('Y-m-d',$time);
    }
    return $message;
}
?>
