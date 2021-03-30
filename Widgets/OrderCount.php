<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;

class OrderCount extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'container_widget'=> ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $json_array = json_decode($this->config['container_widget']['value'],true);
        $query = DB::table($json_array['table']);
        foreach($json_array['where'] as $column=>$value)
        {
            $query = $query->where($column,constant("\App\Shipment::$value"));
        }
        if($json_array['operation'] == "count")
        {
            $query = $query->count();
        }
        $this->config['container_widget']['value'] = $query;
        
        return view('widgets.addons.order_count', [
            'config' => $this->config,
        ]);
    }
}
