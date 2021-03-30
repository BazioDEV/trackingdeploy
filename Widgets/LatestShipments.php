<?php

namespace App\Widgets;

use App\Shipment;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;

class LatestShipments extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        
        $json_array = json_decode($this->config['container_widget']['value'],true);
        $query = new Shipment();
        if(isset($json_array['limit']))
        {
            $query = $query->limit($json_array['limit']);
        }
        if($json_array['operation'] == "latest")
        {
            $query = $query->orderBy('id','desc');
        }
        $shipments = $query->get();
        $this->config['container_widget']['value'] = $query;
        return view('widgets.addons.latest_shipments', [
            'config' => $this->config,
            'shipments' => $shipments,
        ]);
    }
}
