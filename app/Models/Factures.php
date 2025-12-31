<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    use HasFactory;
    protected $table = 'Factures';
    protected $fillable = [ 'DateFact', 'IdCde'];
    protected $primaryKey = 'IdFact';
    public $timestamps = false;


    /**
     * Get the Commande that owns this Facture.
     *
     * - Foreign key on this model: "IdCde"
     * - Owner key on Commandes model: "IdCde"
     */
    public function Commande()
    {
        return $this->belongsTo(Commandes::class, 'IdCde', 'IdCde');
    }
}
