<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/16/19
 * Time: 2:34 PM
 */

namespace Adlino\Charter724;

use Adlino\Charter724\Models\Airport;
use Adlino\Charter724\Repositories\Charter724Repository;

class Charter724
{
    /**
     * TODO:
     * Some Description About This
     */
    private $repo;

    /**
     * TODO:
     * Some Description About This
     * @param Charter724Repository $repo
     */
    public function __construct(Charter724Repository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * TODO:
     * Some Description About This
     */
    public function getAirports()
    {
        $this->repo->getAirports();
    }

    /**
     * TODO:
     * Some Description About This
     */
    public function getAirportsFromDB()
    {
        Airport::all();
    }
}