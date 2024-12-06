<?php

declare(strict_types=1);

use Illuminate\Support\Facades\App;

/**
 * Show a given value with a nice format, give info to debug better
 */

 function showNice(mixed $value, string $info = "")
 {
     echo "*******************************************************************<br />";
     echo "<br />VALUE TYPE - " . gettype($value) . "<br />";
     echo "<pre>";
     var_dump($value);
     echo "</pre>";
     echo "*******************************************************************<br />";
     dd($info);
 }

 /**
  * Helper Function, if $published true return yes if it's false return no
  */

 function publishedText(bool $published): string
 {
    $text = '';   
    
    $language = App::currentLocale();

    if($language == 'en') {
        $published ? $text = 'yes' : $text = 'no';
    }
    if($language == 'es') {
        $published ? $text = 'si' : $text = 'no';
    }
    if($language == 'ca') {
        $published ? $text = 'si' : $text = 'no';
    }

    return $text;
 }

 /**
  * Helper Function, if $published true return yes if it's false return no
  */

  function statusText(int $status): string
  {
     $text = '';   
     
     $language = App::currentLocale();
 
     if($language == 'en') {
         $status == 0 ? $text = 'done' : $text = 'in process';
     }
     if($language == 'es') {
        $status == 0 ? $text = 'acabado' : $text = 'en proceso';
     }
     if($language == 'ca') {
        $status == 0 ? $text = 'acabat' : $text = 'en proces';
     }
 
     return $text;
  }