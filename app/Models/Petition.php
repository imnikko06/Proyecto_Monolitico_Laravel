<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    public $table = 'petitions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'destinatary',
        'signers',
        'status',
        'user_id',
        'category_id'
    ];

    /*
     * Relacion de creador de la peticion, una peticion es de 1 usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
     * Relacion con categoria 1a peticion es de 1 tipo de categoria
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    /*
     * Relacion a firmantes, una peticion puede tener muchos firmantes
     */
    public function signers()
    {
        return $this->belongsToMany(User::class, 'petition_user', 'petition_id', 'user_id')
            ->withTimestamps();
    }

    /*
     * Relacion a files una peticion puede tener muchas fotos, una foto solo puede ser de
     * una petition
     */
    public function files(){
        return $this->hasMany(File::class, 'petition_id', 'id');
    }
}
