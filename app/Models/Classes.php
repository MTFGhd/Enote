<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    
    protected $table = 'Classes';
    protected $primaryKey = 'CodeC';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['CodeC', 'CodeD', 'Libelle'];

    /**
     * Get the departement that owns this classe.
     */
    public function departement()
    {
        return $this->belongsTo(Departements::class, 'CodeD', 'CodeD');
    }

    /**
     * Get the cours for this classe.
     */
    public function cours()
    {
        return $this->hasMany(Cours::class, 'CodeC', 'CodeC');
    }

    /**
     * Get the avancements for this classe.
     */
    public function avancements()
    {
        return $this->hasMany(Avancement::class, 'CodeC', 'CodeC');
    }

    /**
     * Get the etudiants for this classe.
     */
    public function etudiants()
    {
        return $this->hasMany(Etudiants::class, 'CodeC', 'CodeC');
    }
}
