<?php

namespace App\Models\Dino;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class UserDino extends Model
{
    /**
     * Defines the database table name to be used by the model.
     *
     * @var string Database table name
     */
    protected $table = 'user_dinos';

    /**
     * Defines the relationship to the ArkDinoMetaInfo model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metaInfo() {
        return $this->belongsTo('App\Models\Ark\ArkDinoMetaInfo', 'dino_meta_info_id');
    }

    /**
     * Gets the title case of the mutation type attribute
     *
     * @param $value
     * @return string
     */
    public function getMutationTypeAttribute($value) {
        return Str::title($value);
    }

    /**
     * Returns the mutation count (# of dinos) of the line
     *
     * @return int
     */
    public function getLineMutationCountAttribute() {
        return $this->where('uuid', $this->uuid)->where('mutation_count', '>', 0)->count();
    }

    /**
     * Gets the next mutation count of the line
     *
     * @return int
     */
    public function getNextMutationCountAttribute() {
        $lastMutation = $this->where('uuid', $this->uuid)->orderBy('mutation_count', 'desc')->first()->mutation_count;
        return $lastMutation + 1;
    }
}
