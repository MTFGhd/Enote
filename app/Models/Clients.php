<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    protected $table = 'Clients';
    protected $fillable = [ 'Nom', 'Email', 'Adresse'];
    protected $primaryKey = 'IdClient';

    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;

    /**
     * Get the Commandes for this Client.
     *
     * - Foreign key on Commandes model: "IdClient"
     * - Local key on this model: "IdClient"
     */
    public function Commandes()
    {
        return $this->hasMany(Commandes::class, 'IdClient', 'IdClient');
    }
}
