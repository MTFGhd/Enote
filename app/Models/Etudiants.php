<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiants extends Model
{
    use HasFactory;
    
    protected $table = 'Etudiants';
    protected $primaryKey = 'CodeE';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['CodeE', 'Nom', 'Prenom', 'email', 'CodeC'];

    /**
     * Get the classe that owns this etudiant.
     */
    public function classe()
    {
        return $this->belongsTo(Classes::class, 'CodeC', 'CodeC');
    }

    /**
     * Get the absences for this etudiant.
     */
    public function absences()
    {
        return $this->hasMany(Absence::class, 'CodeE', 'CodeE');
    }
}
