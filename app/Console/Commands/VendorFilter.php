<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VendorFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Vendor:filter 
                                    {--applicant= : The applicant of vendor}
                                    {--facility_type= : Facility type}
                                    {--status= : The Vendor status}
                                    {--food_name= : food which the vendor supply}';
                                    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to filter chuck by conditions';

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
        return 0;
    }
}
