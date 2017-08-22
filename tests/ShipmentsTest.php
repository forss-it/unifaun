<?php
use Dialect\Unifaun\Unifaun;
use Tests\TestCase;
class ShipmentsTest extends TestCase
{

    public function setUp(){
        Parent::setUp();
        config(['unifaun.url' => "https://api.unifaun.com/rs-extapi/v1"]);
        config(['unifaun.id' => "IA77GBVZAPSRLHII"]);
        config(['unifaun.secret' => "7Y2DN2IYQDNWWPL2KIULOCLA"]);
        config(['unifaun.authentication' => "basic"]);
    }

    /** @test */
    public function shipment_can_be_converted_to_array(){
        $shipment = Unifaun::shipment()->toArray();
        $this->assertTrue(is_array($shipment));
    }
    /** @test */
    public function shipment_can_have_multiple_parcels(){

        $shipment = Unifaun::shipment()->addParcel("Shipment1", 1, 1)->addParcel("Shipment2",1,1);
        $this->assertCount(2, $shipment->toArray()["shipment"]["parcels"]);

    }

    /** @test */
    public function shipment_can_be_stored(){
        $shipment = Unifaun::shipment()
            ->pdfConfig("laser-a4", 0, 0)
            ->sender("Markus Strömgren", "Torpvägen 12", 64134, "Katrineholm", "SE", "+46709459777", "markus.stromgren@dialect.se")
            ->receiver("Andreas Strömgren", "Köpmangatan 5", 64130, "Katrineholm", "SE", "+46709459777", "andreas.stromgren@dialect.se")
            ->addSenderPartners("PLAB", "0000000000")
            ->senderReference("Thomas Söderlind")
            ->receiverReference("Fredrik Bentzer")
            ->orderNo("1337")
            ->addParcel("Shipment1", 1, 1)
            ->addParcel("Shipment2",1,1)
            ->service("P15")
            ->store();
        $this->assertNotNull($shipment);
        $this->assertTrue($shipment->status === "READY");

    }

    /** @test */
    public function shipment_can_be_created(){
        $shipment = Unifaun::shipment()
            ->pdfConfig("laser-a4", 0, 0)
            ->sender("Markus Strömgren", "Torpvägen 12", 64134, "Katrineholm", "SE", "+46709459777", "markus.stromgren@dialect.se")
            ->receiver("Andreas Strömgren", "Köpmangatan 5", 64130, "Katrineholm", "SE", "+46709459777", "andreas.stromgren@dialect.se")
            ->addSenderPartners("PLAB", "0000000000")
            ->senderReference("Thomas Söderlind")
            ->receiverReference("Fredrik Bentzer")
            ->orderNo("1337")
            ->addParcel("Shipment1", 1, 1)
            ->addParcel("Shipment2",1,1)
            ->service("P15")
            ->create();
        $this->assertNotNull($shipment);
        $this->assertTrue($shipment->status === "PRINTED");

    }

    /** @test */
    public function can_get_pdf_for_shipment(){
        $shipment = Unifaun::shipment()
            ->pdfConfig("laser-a4", 0, 0)
            ->sender("Markus Strömgren", "Torpvägen 12", 64134, "Katrineholm", "SE", "+46709459777", "markus.stromgren@dialect.se")
            ->receiver("Andreas Strömgren", "Köpmangatan 5", 64130, "Katrineholm", "SE", "+46709459777", "andreas.stromgren@dialect.se")
            ->addSenderPartners("PLAB", "0000000000")
            ->senderReference("Thomas Söderlind")
            ->receiverReference("Fredrik Bentzer")
            ->orderNo("1337")
            ->addParcel("Shipment1", 1, 1)
            ->addParcel("Shipment2",1,1)
            ->service("P15")
            ->create();

        $pdf = $shipment->getLabelPDF();
        $this->assertNotNull($pdf);

    }



}