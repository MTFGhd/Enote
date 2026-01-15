<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    
    protected $table = 'Cours';
    protected $primaryKey = 'NumC';
    public $timestamps = false;
    
    protected $fillable = [
        'NumC', 'CodeE', 'CodeC', 'CodeM', 'Type', 
        'Jour', 'HeureDebut', 'HeureFin', 'Duree', 'NbAbsent'
    ];

    protected $casts = [
        'Jour' => 'date',
    ];

    /**
     * Get the enseignant that owns this cours.
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignants::class, 'CodeE', 'CodeE');
    }

    /**
     * Get the classe that owns this cours.
     */
    public function classe()
    {
        return $this->belongsTo(Classes::class, 'CodeC', 'CodeC');
    }

    /**
     * Get the matiere that owns this cours.
     */
    public function matiere()
    {
        return $this->belongsTo(Matieres::class, 'CodeM', 'CodeM');
    }
}
