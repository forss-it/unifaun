<?php
namespace Dialect\Unifaun\Types;

use Dialect\Unifaun\RequestHandler;
use Dialect\Unifaun\Unifaun;
use Illuminate\Http\Response;
class UnifaunPdfObject
{
    private $data;
    public function __construct($data = null)
    {
        $this->data = $data;

    }

    public function __destruct()
    {

    }

    /**
     * raw pdf data
     * @return mixed
     */
    public function rawData(){
        return $this->data;
    }

    /**
     * Return downloadable PDF
     * @param string $filename
     * @return Response
     */
    public function download($filename = "file.pdf"){
        return new Response($this->data, 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'attachment; filename="'.$filename.'"'
        ));
    }

    /**
     * Return inline PDF in browser
     * @param string $filename
     * @return Response
     */
    public function inline($filename = "file.pdf"){
        return new Response($this->data, 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="'.$filename.'"',
        ));
    }



}
