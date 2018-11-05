<?php

    function e($val){
        if(true){
            echo $val;
        }
    }


    function v($val,$var_name){
        if(true){
            echo '<pre>';
            echo $var_name . ' = ';
            var_dump($val);
            echo '</pre>';
        }
    }

    function h($val){
        return htmlspecialchars($val);
    }

    function result($result,$result_name){
      if ($result=="") {
        return $result=$result_name.'を入力してください。';
      }else{
        return $result=$result;
      }
    }

?>