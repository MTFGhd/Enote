<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departements extends Model
{
    use HasFactory;
    
    protected $table = 'Departements';
    protected $primaryKey = 'CodeD';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['CodeD', 'Libelle'];

    /**
     * Get the classes for this departement.
     */
    public function classes()
    {
        return $this->hasMany(Classes::class, 'CodeD', 'CodeD');
    }

    /**
     * Get the matieres for this departement.
     */
    public function matieres()
    {
        return $this->hasMany(Matieres::class, 'CodeD', 'CodeD');
    }
}
