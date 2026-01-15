<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignants extends Model
{
    use HasFactory;
    
    protected $table = 'Enseignants';
    protected $primaryKey = 'CodeE';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['CodeE', 'Libelle'];

    /**
     * Get the cours for this enseignant.
     */
    public function cours()
    {
        return $this->hasMany(Cours::class, 'CodeE', 'CodeE');
    }

    /**
     * Get the avancements for this enseignant.
     */
    public function avancements()
    {
        return $this->hasMany(Avancement::class, 'CodeE', 'CodeE');
    }
}
