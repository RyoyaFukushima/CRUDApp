<?php
// ファットコントローラー防止の際には処理を別ファイルに切り出す
namespace App\Services;

class CheckFormData{
    // 
    public static function checkgender($data){
        if($data->gender === 0){
            $gender = '男性';
        }elseif($data->gender === 1){
            $gender = '女性';
        }
        return $gender;
    }
    // 教材ではif文の連続でした
    public static function checkage($data){
        $agevalue = $data->age;

        switch($agevalue){
            case 1:
                $age ='~19歳';
            break;    
            case 2:
                $age ='20~29歳';
            break;
            case 3:
                $age ='30~39歳';
            break;
            case 4:
                $age ='40~49歳';
            break;
            case 5:
                $age ='50~59歳';
            break;
            case 6:
                $age ='60歳~';
            break;
        }
        return $age;
    }
}