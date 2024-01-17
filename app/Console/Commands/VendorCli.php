<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VendorCli extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:cli
                                    {--path_csv_file=./storage/app/public/Mobile_Food_Facility_Permit.csv : path to csv file }
                                    {--head_fields=Applicant :  The field of table head that name is case insensitive. `*` represents all}
                                    {--applicant= : The applicant of vendor}
                                    {--facility_type= : Facility type}
                                    {--status= : The Vendor status}
                                    {--food_name= : food which the vendor supply}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tool of support for vendor';

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
     * get csv data
     * @param String $path_to_csv_file
     * @return Array
     */
    protected function getCsvData($path_to_csv_file): Array{
        $row = 1;
        $header = [];
        $list  = [];
        if (($handle = fopen($path_to_csv_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if($row++==1){
                    $header = $data;
                }else{
                    array_push($list,$data);
                }
            }
            fclose($handle);
        }
        return compact('header','list');
    }

    /**
     * filter conditions
     */
    protected function filterCondition(){
        return [
            'applicant'=>$this->option('applicant'),
            'facility_type'=>$this->option('facility_type'),
            'status'=>$this->option('status'),
            'food_name'=>$this->option('food_name'),
        ];
    }

    /**
     * if only applicant exist
     */
    protected function onlyApplicant($filter_condition){
        $filter = [];
        foreach($filter_condition as $k=>$v){
            if(!empty($v)){
                $filter[] = $v;
            }
        }

        if(count($filter)<=1 || in_array('applicant',$filter)){
            return true;
        }
        return false;
    }

    /**
     * apply filter condition
     */
    protected function applyFilterCondition(Array $data,Array $show_heads){
        $filter_condition = $this->filterCondition();

        $show_heads_flg = collect($data['header'])->reject(function($item) use($show_heads){
            foreach($show_heads as $v){
                if(strtoupper($v) == strtoupper($item)){
                    return false;
                }
            }
            return true;
        });
        
        $data['list'] = collect($data['list'])->transform(
                                    function($item , $key) use($show_heads_flg){
                                        $new_item = [];
                                        foreach($show_heads_flg as $k=>$v){
                                            $new_item[strtoupper($v)] = $item[$k];
                                        }
                                        return $new_item;
                                    }
                                )
                              ->when($this->onlyApplicant($filter_condition),function ($collection, $value) {
                                    return $collection->unique();
                                })
                              ->sortBy('APPLICANT');
        return $data;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path_csv_file = $this->option('path_csv_file');
        if(empty($path_csv_file) || !file_exists($path_csv_file)){
            $this->error('option `path_csv_file` is required');
            return;
        }

        $data = $this->getCsvData($path_csv_file);
        $this->showInTable($data);
    }

    /**
     * show data in table format
     * @param Array $data csv data
     */
    protected function showInTable(Array $data){
        $show_heads = $this->option('head_fields');

        if($show_heads!='*'){
            $show_heads = explode(',',$show_heads);
            $data = $this->applyFilterCondition($data,$show_heads);
        }else{
            $show_heads = $data['header'];
        }

        $this->table(
            $show_heads,
            $data['list']
        );
    }
}
