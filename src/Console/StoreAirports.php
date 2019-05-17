<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/16/19
 * Time: 9:53 PM
 */

namespace Adlino\Charter724\Console;

use Adlino\Charter724\Repositories\Charter724Repository;
use Illuminate\Console\Command;

class StoreAirports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charter724:airports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store all of Airport Lists to Database';

    /**
     * TODO:
     * Some Description About This
     */
    private $repo;

    /**
     * Create a new command instance.
     *
     * @param Charter724Repository $repo
     */
    public function __construct(Charter724Repository $repo)
    {
        parent::__construct();

        $this->repo = $repo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $airports = $this->repo->storeAirports();

        $this->display($airports);
    }

    /**
     * Display generated access token.
     *
     * @param $airports
     * @return void
     */
    private function display($airports) : void
    {
        if ($airports->count() > 0) {

            $this->info("Airport lists has been Stored Successful.");
        } else {

            $this->error('Request was not Successful. Please try again.');
        }
    }
}