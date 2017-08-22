<?php

namespace Dialect\Unifaun;

use Dialect\Unifaun\Types\UnifaunPdfObject;
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

    /**
     * @param $shipmentId
     * @param $pdfId
     * @return UnifaunPdfObject
     */
    public static function getPDF($shipmentId, $pdfId){
        $data = RequestHandler::Request("/shipments/".$shipmentId."/pdfs/".$pdfId, "GET", null, true);

        return $data ? new UnifaunPdfObject($data) : null;
    }

}
