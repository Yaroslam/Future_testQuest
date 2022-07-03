<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class notebook extends Model
{
    use HasFactory;


    protected $table = 'notebook';

    protected $fillable = [
        'FCs', 'mob_phone', 'birthdate', 'email', 'company_id', 'photo_path'
    ];

    /**
     * @var mixed
     */
    public function WorkOn(){
        return $this->belongsTo('App\company');
    }
}
