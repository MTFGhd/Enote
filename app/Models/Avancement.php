<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avancement extends Model
{
    use HasFactory;
    
    protected $table = 'Avancement';
    public $timestamps = false;
    public $incrementing = false;
    
    // Composite primary key
    protected $primaryKey = ['CodeE', 'CodeC', 'CodeM'];
    
    protected $fillable = ['CodeE', 'CodeC', 'CodeM', 'MHRealise'];

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    /**
     * Get the enseignant that owns this avancement.
     */
    public function enseignant()
    {
        return $this->belongsTo(Enseignants::class, 'CodeE', 'CodeE');
    }

    /**
     * Get the classe that owns this avancement.
     */
    public function classe()
    {
        return $this->belongsTo(Classes::class, 'CodeC', 'CodeC');
    }

    /**
     * Get the matiere that owns this avancement.
     */
    public function matiere()
    {
        return $this->belongsTo(Matieres::class, 'CodeM', 'CodeM');
    }
}
