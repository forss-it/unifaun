<?php
namespace Dialect\Unifaun\Types;

use Dialect\Unifaun\RequestHandler;
use Dialect\Unifaun\Unifaun;

class UnifaunShipmentObject
{

    public function __construct($data = null)
    {
        if ($data) {
            foreach ($data as $key => $val) {
                $this->$key = $val;
            }
        }
    }

    public function getLabelPDF(){
        foreach($this->pdfs as $pdf)
        {
            if($pdf->description == "Label")
            {
                return Unifaun::getPDF($this->id, $pdf->id);
            }
        }
        return null;
    }

}
