<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cours extends Model
{
    use HasFactory;
    
    protected $table = 'Cours';
    protected $primaryKey = 'NumC';
    public $timestamps = false;
    
    protected $fillable = [
        'NumC', 'CodeE', 'CodeC', 'CodeM', 'Type', 
        'Jour', 'HeureDebut', 'HeureFin', 'Duree', 'NbAbsent', 'Valide'
    ];

    protected $casts = [
        'Jour' => 'date',
        'Valide' => 'boolean',
    ];

    protected $attributes = [
        'Valide' => false,
    ];

    /**
     * Boot method to handle automatic calculations
     */
    protected static function boot()
    {
        parent::boot();

        // Calculate Duree automatically before creating or updating
        static::saving(function ($cours) {
            if ($cours->HeureDebut && $cours->HeureFin) {
                $debut = Carbon::parse($cours->HeureDebut);
                $fin = Carbon::parse($cours->HeureFin);
                $cours->Duree = $fin->diffInHours($debut, true);
            }
        });
    }

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
