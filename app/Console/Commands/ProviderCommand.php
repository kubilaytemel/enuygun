<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Classes\Patterns\Provider1;
use App\Classes\Patterns\Provider2;

class ProviderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $providerCls1 = new Provider1();
        $p1= $providerCls1->getData();
        $providerCls2 = new Provider2();
        $p2= $providerCls2->getData();

        return 0;
    }
}
