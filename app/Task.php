<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =[
        'type',
        'name',
        'detail',
        'status'
    ];

    public function getTypeName(){//แสดงType ที่เป็นตัวเลขให้เป็นชื่อตามที่เราตั้งไว้
        switch($this->type){
            case 1 :
                return "Support";
                break;
            case 2 :
                return "Maintain";
                break;
            case 3 :
                return "Change Requirement";
                break;
            default :
                return "Unknow";
                break;

        }
    }
}
