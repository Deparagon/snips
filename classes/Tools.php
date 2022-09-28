<?php

/*
Collection of various function into collection class


*/

/**
 * 
 */
class Tools
{
    public static function redirect($url, $permanent = false)
    {
        ob_start();
        ob_get_clean();
        if (headers_sent() === false) {
            header('Location: '.$url, true, ($permanent === true) ? 301 : 302);
        }

        exit();
    }

    public static function displayPrice($price)
    {
        echo '₦'.number_format($price, 2);
    }

    public static function showPrice($price)
    {
        return 'N'.number_format($price, 2);
    }


     public static function n($price)
    {
        return round($price);
    }

    public static function displayNumber($num)
    {
        if ($num == '') {
            $num = 0;
        }
        echo number_format($num, 0);
    }

    public static function showNumber($num)
    {
        if ($num == '') {
            $num = 0;
        }

        return number_format($num, 0);
    }
    public static function codeGenerator($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = strlen($chars);

        for ($i = 0, $token = ''; $i < $length; ++$i) {
            $index = rand(0, $count - 1);
            $token .= substr($chars, $index, 1);
        }

        return $token;
    }

    public static function getValue($var)
    {
        if (isset($_GET)) {
            if (isset($_GET[$var])) {
                 if(is_array($_GET[$var])){
                    return $_GET[$var];
                 }
                return trim(htmlentities($_GET[$var]));
            }
        }

        if (isset($_POST)) {
            if (isset($_POST[$var])) {
                  if(is_array($_POST[$var])){
                    return $_POST[$var];
                 }
                return trim(htmlentities($_POST[$var]));
            }
        }

        return '';
    }

    public static function generateRandomNumber($length = '7')
    {
        $chars = '0123456789';
        $count = strlen($chars);

        for ($i = 0, $token = ''; $i < $length; ++$i) {
            $index = rand(0, $count - 1);
            $token .= substr($chars, $index, 1);
        }

        return $token;
    }
    public static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validURL($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);

        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function getIP()
    {
        return filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
    }

    public static function obuObject($var)
    {
        if (is_object($var)) {
            return true;
        } else {
            return false;
        }
    }

    public static function displayDate($date)
    {
        $tdate = strtotime($date);
        echo date('F j, Y, g:i a', $tdate);
    }


    public static function displayTime($date)
    {
        $tdate = strtotime($date);
        echo date('g:i a', $tdate);
    }

    public static function displayODate($date)
    {
        $tdate = strtotime($date);
        echo date('F j, Y', $tdate);
    }
 



    public static function showDate($date)
    {
        $tdate = strtotime($date);
        return date('F j, Y, g:i a', $tdate);
    }

       public static function getTextTime($ts) {
    if(!ctype_digit($ts)) {
        $ts = strtotime($ts);
    }
    $diff = time() - $ts;
    if($diff == 0) {
        return 'now';
    } elseif($diff > 0) {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0) {
            if($diff < 60) return 'just now';
            if($diff < 120) return '1 minute ago';
            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
            if($diff < 7200) return '1 hour ago';
            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if($day_diff == 1) { return 'Yesterday'; }
        if($day_diff < 7) { return $day_diff . ' days ago'; }
        if($day_diff < 31) { return ceil($day_diff / 7) . ' weeks ago'; }
        if($day_diff < 60) { return 'last month'; }
        return date('F Y', $ts);
    } else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0) {
            if($diff < 120) { return 'in a minute'; }
            if($diff < 3600) { return 'in ' . floor($diff / 60) . ' minutes'; }
            if($diff < 7200) { return 'in an hour'; }
            if($diff < 86400) { return 'in ' . floor($diff / 3600) . ' hours'; }
        }
        if($day_diff == 1) { return 'Tomorrow'; }
        if($day_diff < 4) { return date('l', $ts); }
        if($day_diff < 7 + (7 - date('w'))) { return 'next week'; }
        if(ceil($day_diff / 7) < 4) { return 'in ' . ceil($day_diff / 7) . ' weeks'; }
        if(date('n', $ts) == date('n') + 1) { return 'next month'; }
        return date('F Y', $ts);
    }
}

    public static function naError($e)
    {
        ?>
     <div class="alert alert-danger" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button><?php echo $e;
        ?> </div>
<?php

    }

    public static function naSuccess($s)
    {
        ?>
        <div class="alert alert-success" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button><?php echo $s;
        ?> </div> <?php

    }

    public static function naInfo($s)
    {
        ?>
    <div class="alert alert-info" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button><?php echo $s;
        ?> </div>
<?php

    }
}
