<?php
namespace App\Http\Controllers\Components\Gen;

class TextGen
{

  /* GENERATE RANDOM TEXT TO FILL CARDS */
private static function digitCorrector($start, $last) { return rand($start, $last);}
public static function generateRandomString($length = 100) {  
 $characters = "eatoinhsrdlwmguycfpbkvxjzq"; $vowels = "eaoiuy"; $consonants = "tinhsrdlwmgcfpbkvxjzq";            $capchars = 'EATOINHSRDLWMGUYCFPBKVXJZQ';
 $gaps = [" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", ", ", ", ", ", ", ", ", ", ", ", ", ", ", " - ", "'", ": ", "; ", " — " ];
 $capitalgaps = [".", ".", ".", ".",".", ".",".", ".", ".", ".", ".", "?", "!", "!?", "..." ];
 $charactersLength = strlen($characters); $capcharsLength = strlen($capchars); $randomString = ''; $boycounter = 0; $lettrcounter = 0; $entercounter = 0; $lactCapafter = ''; $lastCharAfter = ''; $VC_POSITION = 0; $startcounter = 0;
 for ($i = 0; $i < $length; $i++) {
     if ($boycounter == 0) { $worcounts = rand(19, 73);}
     if ($entercounter == 0) {  $entercounts = rand(3, 13);}
     for ($w = 0; $w< rand(1, 12); $w++ ) {
         if ((($boycounter == 1) && ($lettrcounter == 0)) || !$startcounter ) {
           $startcounter++;
         $randomString .= $capchars[rand(0, self::digitCorrector( 0, $capcharsLength - 1))];
         $lettrcounter++;} else {  if ($VC_POSITION == 0){
                   $characters = $vowels;
                   $charactersLength = strlen($vowels);
                   $VC_POSITION = 1;
                  } else {
                   $characters = $consonants;
                   $charactersLength = strlen($consonants);
                   $VC_POSITION = 0;};
             $lastcharBefore = $characters[rand(0, self::digitCorrector( 0, $charactersLength - 1))];
           if ($lastcharBefore != $lastCharAfter){
               $randomString .= $lastcharBefore;
               $lastCharAfter = $lastcharBefore;
           } else { $randomString .= $characters[rand(0, self::digitCorrector( 0, $charactersLength - 1))]; }
           $lettrcounter++;}}
     if ($boycounter == $worcounts) {
         $capitalpoint = $capitalgaps[(rand(0, count($capitalgaps) - 1))];
         $randomString = $randomString . $capitalpoint . '<br>';
         $boycounter = 0; $lettrcounter = 0; $entercounter++;
         if ($entercounter == $entercounts) {
             $randomString = $randomString . '<br>';
             $entercounter = 0; }
     } else {
       $gap = $gaps[(rand(0, count($gaps) - 1))];
       $randomString = $randomString . $gap; }
     $boycounter++; }
 return trim($randomString);}
/* GENERATE RANDOM TEXT TO FILL CARDS */

}
