<?php
/**
 * Mobile Detect Library
 * =====================
 *
 * Motto: "Every business should have a mobile detection script to detect mobile readers"
 *
 * Mobile_Detect is a lightweight PHP class for detecting mobile devices (including tablets).
 * It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.
 *
 * @author      Current authors: Serban Ghita <serbanghita@gmail.com>
 *                               Nick Ilyin <nick.ilyin@gmail.com>
 *
 *              Original author: Victor Stanciu <vic.stanciu@gmail.com>
 *
 * @license     Code and contributions have 'MIT License'
 *              More details: https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 *
 * @link        Homepage:     http://mobiledetect.net
 *              GitHub Repo:  https://github.com/serbanghita/Mobile-Detect
 *              Google Code:  http://code.google.com/p/php-mobile-detect/
 *              README:       https://github.com/serbanghita/Mobile-Detect/blob/master/README.md
 *              HOWTO:        https://github.com/serbanghita/Mobile-Detect/wiki/Code-examples
 *
 * @version     2.8.22
 */

class Ipapi {
    static $fields = 65535;     // refer to http://ip-api.com/docs/api:returned_values#field_generator
    static $use_xcache = true;  // set this to false unless you have XCache installed (http://xcache.lighttpd.net/)
    static $api = "http://ip-api.com/php/";
 
    public $status, $country, $countryCode, $region, $regionName, $city, $zip, $lat, $lon, $timezone, $isp, $org, $as, $reverse, $query, $message;
 
    public static function query($q) {
        $data = self::communicate($q);
        $result = new static;
        foreach($data as $key => $val) {
            $result->$key = $val;
        }
        return $result;
    }

    public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
 
    public static function communicate($q) {
        $q_hash = md5('ipapi'.$q);
        if(is_callable('curl_init')) {
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, self::$api.$q.'?fields='.self::$fields);
            curl_setopt($c, CURLOPT_HEADER, false);
            curl_setopt($c, CURLOPT_TIMEOUT, 30);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            $result_array = unserialize(curl_exec($c));
            curl_close($c);
        } else {
            $result_array = unserialize(file_get_contents(self::$api.$q.'?fields='.self::$fields));
        }
        return $result_array;
    }
}
 