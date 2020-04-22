<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_pribadi extends Model
{
    public $timestamps = false;
    protected $table = "data_pribadi";
    protected $fillable = ['nama','jabatan','umur','alamat','foto'];
}
