<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*
     * Definicion de tabla
     */
    protected $table = 'categories';
    /*
     * Definicion de PK
     */
    protected $primaryKey = 'category_id';
    /*
     * Definicion campos fillable
     */
    protected $fillable = ['name'];
    /*
     * Relacion muchos a x a Petition Model
     */
    public function petitions()
    {
        return $this->hasMany(Petition::class, 'category_id');
    }


}
