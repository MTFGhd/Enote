<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    use HasFactory;
    protected $table = 'Commandes';
    protected $fillable = [ 'DateCmd', 'Montant', 'IdClient'];
    protected $primaryKey = 'IdCde';
    public $timestamps = false;

    
    public function Clients()
    {
        /**
         * Get the Clients that owns this Stagiaire.
         *
         * - Foreign key on this model: "IdClient"
         * - Owner (local) key on Clients model: "IdClient"
         
        */
        return $this->belongsTo(Clients::class, 'IdClient', 'IdClient');
    }

    public function Facture()
    {
        /**
         * Get the Facture associated with this Commande.
         *
         * - Foreign key on Factures model: "IdCde"
         * - Local key on this model: "IdCde"
         */
        return $this->hasOne(Factures::class, 'IdCde', 'IdCde');
    }
}
