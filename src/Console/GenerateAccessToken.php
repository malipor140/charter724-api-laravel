<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/16/19
 * Time: 6:47 PM
 */

namespace Adlino\Charter724\Console;

use Adlino\Charter724\Repositories\Charter724Repository;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class GenerateAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charter724:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Access Token';

    /**
     * TODO:
     * Some Description About This
     */
    private $details = [
        'username' => null,
        'password' => null,
    ];

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
     * @throws GuzzleException
     */
    public function handle()
    {
        $details = $this->getDetails();

        $accessToken = $this->repo->generateAccessToken($details);

        $this->display($accessToken);
    }

    /**
     * Ask for username and password details.
     *
     * @return array
     */
    private function getDetails() : array
    {
        $this->askUsername();
        $this->askPassword();

        return $this->details;
    }

    /**
     * Display generated access token.
     *
     * @param $accessToken
     * @return void
     */
    private function display($accessToken) : void
    {
        if (is_string($accessToken)) {

            $headers = ['Access Token'];

            $fields = [
                'access token' => $accessToken,
            ];

            $this->info('Access Token Generated');
            $this->table($headers, [$fields]);

        } else {

            $this->error('The username or password is incorrect.');
        }
    }

    /**
     * TODO:
     * Some Description About This
     */
    private function askUsername()
    {
        do {
            $username = $this->ask('Please enter username: ');

            if ($username == '') {
                $this->error('The username is invalid. Please try again.');
            }

            $this->details['username'] = $username;

        } while (!$username);
    }

    /**
     * TODO:
     * Some Description About This
     */
    private function askPassword()
    {
        do {
            $password = $this->secret('Please enter password: ');

            if ($password == '') {
                $this->error('The password is invalid. Please try again.');
            }

            $this->details['password'] = $password;

        } while (!$password);
    }
}