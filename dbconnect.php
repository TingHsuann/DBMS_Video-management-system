<?php    
    
    $link = @mysqli_connect( 
        'localhost',  // MySQL主機名稱 
        'A1093361',       // 使用者名稱 
        'A1093361',  // 密碼
        'A1093361');
        $link->query("SET NAMES utf8");
        $link->set_charset("utf8_unicode_ci");
?>