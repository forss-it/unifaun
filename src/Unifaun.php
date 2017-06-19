<?php

namespace Dialect\Unifaun;

use Dialect\Unifaun\Types\UnifaunShipment;

class Unifaun
{

    /**
     * Create new shipment
     * @return UnifaunShipment
     */
    public static function shipment(){
        return new UnifaunShipment;
    }
}
