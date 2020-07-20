<?php

namespace Evention\Console;

use Evention\Facades\Evention;
use Illuminate\Console\Command;

class Version extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evention:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evention Shop CMS version';

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
     * @return mixed
     */
    public function handle()
    {
        $message = "Evention Shop CMS <info>" . Evention::version() . "</info>";

        $this->line($message);
    }
}
