<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matieres extends Model
{
    use HasFactory;
    
    protected $table = 'Matieres';
    protected $primaryKey = 'CodeM';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['CodeM', 'Libelle', 'CodeD', 'MH', 'Coef'];

    /**
     * Get the departement that owns this matiere.
     */
    public function departement()
    {
        return $this->belongsTo(Departements::class, 'CodeD', 'CodeD');
    }

    /**
     * Get the cours for this matiere.
     */
    public function cours()
    {
        return $this->hasMany(Cours::class, 'CodeM', 'CodeM');
    }

    /**
     * Get the avancements for this matiere.
     */
    public function avancements()
    {
        return $this->hasMany(Avancement::class, 'CodeM', 'CodeM');
    }
}
