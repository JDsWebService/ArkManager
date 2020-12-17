<?php

namespace App\Models\Dino;

use Illuminate\Database\Eloquent\Model;

class UserDinoColor extends Model
{
    /**
     * The database table to be used by the model
     *
     * @var string
     */
    protected $table = 'user_dino_colors';

    /**
     * Defines the relationship between model and dino meta info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metaInfo() {
        return $this->belongsTo('App\Models\Ark\ArkDinoMetaInfo', 'ark_dino_id');
    }

    /**
     * Defines the relationship between model and user tribe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tribe() {
        return $this->belongsTo('App\Models\Tribe\Tribe');
    }

    /**
     * Defines the relationship between model and user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\Auth\User');
    }

    /**
     * Returns the associated color for region zero
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorZero() {
        return $this->belongsTo('App\Models\Ark\ArkDinoColor', 'region_zero_id');
    }

    /**
     * Returns the associated color for region one
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorOne() {
        return $this->belongsTo('App\Models\Ark\ArkDinoColor', 'region_one_id');
    }

    /**
     * Returns the associated color for region two
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorTwo() {
        return $this->belongsTo('App\Models\Ark\ArkDinoColor', 'region_two_id');
    }

    /**
     * Returns the associated color for region three
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorThree() {
        return $this->belongsTo('App\Models\Ark\ArkDinoColor', 'region_three_id');
    }

    /**
     * Returns the associated color for region four
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorFour() {
        return $this->belongsTo('App\Models\Ark\ArkDinoColor', 'region_four_id');
    }

    /**
     * Returns the associated color for region five
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function colorFive() {
        return $this->belongsTo('App\Models\Ark\ArkDinoColor', 'region_five_id');
    }
}
