<?php

namespace App\Console\Commands;

use App\ApartmentView;
use App\Session;
use Illuminate\Console\Command;

class ResetUserSession extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the IP session daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ApartmentView::truncate();
        Session::truncate();
    }
}
