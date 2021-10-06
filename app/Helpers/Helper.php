<?php

namespace App\Helpers;
use DateTime;

use App\Models\TrainerCafeBooking;
use App\Models\MstSetting;

class Helper
{
    public static function checkUserBooking()
    {
        return "Booked";
    }

    public static function convert_seconds_to_time($seconds) 
	{
	 	$dt1 = new DateTime("@0");
	  	$dt2 = new DateTime("@$seconds");
	  	
	  	return $dt1->diff($dt2)->format('%H:%I');
	}

	public static function getSettings() 
	{
	 	$settings = MstSetting::first();
	 	return $settings;
	}

	/*****
        Returns a randomized string of chars/sybols/numbers for specified length
        @param $l = length (default=8)
        @param $s = use symbols? T/F
        @param $a = use alpha characters? T/F
        @param $n = use numbers? T/F
    *****/
    public static function random_chars($l=8,$s=1,$a=1,$n=1) {
          $string = ''; $chars = array();
          if ($s) $chars = array_merge($chars,array(
                             33,35,36,37,38,40,41,42,43,44,45,
                             46,47,58,59,60,61,62,63,64,91,93,
                             94,95,123,124,125,126
                             ));
          if ($a) $chars = array_merge($chars,array(
                             65,66,67,68,69,70,71,72,73,74,
                             75,76,77,78,79,80,81,82,83,84,
                             85,86,87,88,89,90,
                             97,98,99,100,101,102,103,104,105,106,
                             107,108,109,110,111,112,113,114,115,116,
                             117,118,119,120,121,122
                             ));
          if ($n) $chars = array_merge($chars,array(
                             48,49,50,51,52,53,54,55,56,57
                             ));
          for ($i=0;$i<$l;$i++) {shuffle($chars);$string.=chr(reset($chars));}
          return $string;
    }

    public static function hoursRange($lower = 0, $upper = 23, $step = 1, $format = NULL, $type=NULL) {

        if ($format === NULL) {
            $format = 'g:i A'; // 9:30pm
        }
        $times = array();
        foreach(range($lower, $upper, $step) as $increment) {
            $index = $increment;
            $increment = number_format($increment, 2);
            list($hour, $minutes) = explode('.', $increment);
            $date = new DateTime($hour . ':' . $minutes * .6);
            $dateValue = $date->format($format);

            $date1 = new DateTime($hour + 1 . ':' . $minutes * .6);
            $dateValue1 = $date1->format($format);


            if($type==1){
                $times[] = $dateValue;
            } else {
                $times[] = $dateValue.'-'.$dateValue1;
            }
            
        }

        return $times;
    }

}