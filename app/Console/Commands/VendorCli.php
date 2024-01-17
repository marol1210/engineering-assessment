<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class VendorCli extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:cli
                                    {--path_csv_file=./Mobile_Food_Facility_Permit.csv : path to csv file }
                                    {--head_fields=Applicant :  The field of table head that name is case insensitive. `*` represents all}
                                    {--applicant= : The applicant of vendor}
                                    {--facility_type= : Facility type}
                                    {--status= : The Vendor status}
                                    {--food_name= : the food which vendor supply}';

    const MAP_KEYS = [
        "applicant"=>"APPLICANT",
        "facility_type"=>"FACILITYTYPE",
        "status"=>"STATUS",
        "food_name"=>"FOODITEMS",
    ];
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
     * apply filter condition
     */
    protected function applyFilterCondition(Array $data,Array $show_heads){
        $filter_condition = $this->filterCondition();

        //if head exist in filter_condition , append
        $_heads = collect($filter_condition)->filter(function($item){
            return !empty($item);
        })->keys()->transform(function($item) {
            return VendorCli::MAP_KEYS[$item];
        })->all();
        

        if(count($_heads)>0){
            $_heads[]='Address';
            $_heads[]='status';
            $_heads[]='permit';
        }

        $show_heads = array_merge($show_heads,$_heads);
        $data['header'] = $show_heads_flg = collect($data['header'])->reject(function($item) use($show_heads){
                                                                        foreach($show_heads as $v){
                                                                            if(Str::upper($v) == Str::upper($item)){
                                                                                return false;
                                                                            }
                                                                        }
                                                                        
                                                                        return true;
                                                                    })
                                                                    ->unique()
                                                                    ->all();

        $data['list'] = collect($data['list'])
                                ->transform(
                                    function($item) use($show_heads_flg){
                                        $new_item = [];
                                        foreach($show_heads_flg as $k=>$v){
                                            $new_item[Str::upper($v)] = $item[$k];
                                        }
                                        return $new_item;
                                    }
                                )
                                ->when($this->onlyApplicant($filter_condition),function ($collection, $value) {
                                    return $collection->unique();
                                })
                                ->when(!empty($filter_condition['food_name']),function ($collection, $value) use($filter_condition){
                                    return $collection->filter( fn($item)=> Str::contains($item[Str::upper('FoodItems')],$filter_condition['food_name']) );
                                })
                                ->when(!empty($filter_condition['status']),function ($collection, $value) use($filter_condition){
                                    return $collection->filter( fn($item)=> Str::contains($item[Str::upper('status')],$filter_condition['status']) );
                                })
                                ->when(!empty($filter_condition['facility_type']),function ($collection, $value) use($filter_condition){
                                    return $collection->filter( fn($item)=> Str::contains($item[Str::upper('facilitytype')],$filter_condition['facility_type']) );
                                })
                                ->sortBy('APPLICANT')->all();
        return $data;
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

        if(
            (count($filter)<=0  ||  (count($filter)==1 && !empty($filter['applicant'])))
        )
        {
            return true;
        }
        return false;
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

        $data = getCsvData($path_csv_file);
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
        }
        $data['header'] = array_values($data['header']);
        $data['header'][0].= "     total: ".count($data['list']); 
        $this->table(
            $data['header'],
            $data['list']
        );
    }
}
