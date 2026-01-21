<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;
    
    protected $table = 'Absence';
    public $incrementing = false;
    public $timestamps = false;
    
    // Composite primary key
    protected $primaryKey = ['CodeE', 'NumC'];
    
    protected $fillable = ['CodeE', 'NumC', 'Jour', 'Duree'];

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the value of the model's primary key.
     *
     * @param  string  $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    /**
     * Get the etudiant that owns this absence.
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiants::class, 'CodeE', 'CodeE');
    }

    /**
     * Get the cours that owns this absence.
     */
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'NumC', 'NumC');
    }
}
