<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
     * relacion 1 a M a petitions, un usuario puede tener muchas petitions creadas
     */
    public function petitionsCreated()
    {
        return $this->hasMany(Petition::class, 'user_id');
    }
    /*
     * relacion a petitions, un usuario puede firmar muchas petitions
     */
    public function signedPetitions()
    {
        return $this->belongsToMany(Petition::class, 'petition_user', 'user_id', 'petition_id')
            ->withTimestamps();
    }

}
