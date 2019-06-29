<?php
/**
 * *************************************
 * Author: 大鱼
 * E_mail: yc_1224@163.com
 * Date  : 2019/4/16 0016
 * *************************************
 */

function setconfig($pat, $rep,$filename,$array=[])
{
    $fileurl = base_path() .'/config/'. $filename.".php";
    $string = file_get_contents($fileurl); //加载配置文件
    if (is_array($pat) and is_array($rep)) {
        $pats = [];
        $reps = [];
        for ($i = 0; $i < count($pat); $i++) {
            if (in_array($pat[$i],$array)){
                $pats[$i] = '/\'' . $pat[$i] . '\'=>array (?:\()[\s\S]*\),/';
                $reps[$i] = "'". $pat[$i]. "'". "=>" . $rep[$i] .",";
            }else{
                $pats[$i] = '/\'' . $pat[$i] . '\'(.*?),/';
                $reps[$i] = "'". $pat[$i]. "'". "=>" . "'".$rep[$i] ."',";
            }
        }

        $string = preg_replace($pats, $reps, $string); // 正则查找然后替换
        file_put_contents($fileurl, $string); // 写入配置文件
        return true;
    } else {
        return false;
    }
}
