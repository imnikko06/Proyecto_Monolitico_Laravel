<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $table = 'files';
    protected $fillable = ['name', 'file_path', 'petition_id'];

    /*
     * Relacion 1 a x a Petition Model
     */
    public function petition(){
        return $this->belongsTo(Petition::class, 'petition_id');
    }
}
