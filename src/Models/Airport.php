<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/16/19
 * Time: 5:14 PM
 */

namespace Adlino\Charter724\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    /**
     * TODO:
     * Some Description About This
     */
    protected $guarded = ['id'];

    /**
     * TODO:
     * Some Description About This
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('charter724.table_names.airports'));
    }
}