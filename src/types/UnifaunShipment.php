<?php

namespace Dialect\Unifaun\Types;

use Dialect\Unifaun\RequestHandler;

class UnifaunShipment
{
    private $id = null;
    private $pdfConfig;
    private $sender;
    private $receiver;
    private $parcels = [];
    private $orderNo;
    private $senderReference;
    private $service;
    private $receiverReference;
    private $options;
    private $senderPartners = [];


    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        // constructor body
    }

    /**
     * Add pdf config
     * @param $media
     * @param int $x_offset
     * @param int $y_offset
     * @return $this
     */
    public function pdfConfig($media, $x_offset = 0, $y_offset = 0)
    {
        $this->pdfConfig = [
            "target1XOffset" => 0,
            "target1YOffset" => 0,
            "target1Media" => "thermo-se",
            "target2XOffset" => 0,
            "target2YOffset" => 0,
            "target2Media" => "laser-ste",
            "target3XOffset" => 0,
            "target3YOffset" => 0,
            "target3Media" => null,
            "target4XOffset" => 0,
            "target4YOffset" => 0,
            "target4Media" => null,
        ];

        return $this;
    }

    /**
     * Add sender
     * @param $name
     * @param $address
     * @param $zipcode
     * @param $city
     * @param $country
     * @param string $phone
     * @param string $email
     * @return $this
     */
    public function sender($name, $address, $zipcode, $city, $country, $phone = "", $email = "")
    {
        $this->sender = [
            "name" => $name,
            "address1" => $address,
            "zipcode" => $zipcode,
            "city" => $city,
            "country" => $country,
            "phone" => $phone,
            "email" => $email,
        ];

        return $this;
    }

    /**
     * @param $orderno
     * @return $this
     */
    public function orderNo($orderno)
    {
        $this->orderNo = $orderno;

        return $this;
    }

    /**
     * Add receiver
     * @param $name
     * @param $address
     * @param $zipcode
     * @param $city
     * @param $country
     * @param string $phone
     * @param string $email
     * @return $this
     */
    public function receiver($name, $address, $zipcode, $city, $country, $phone = "", $email = "")
    {
        $this->receiver = [
            "name" => $name,
            "address1" => $address,
            "zipcode" => $zipcode,
            "city" => $city,
            "country" => $country,
            "phone" => $phone,
            "email" => $email,
        ];

        return $this;
    }

    /**
     * Add sender referance
     * @param $reference
     * @return $this
     */
    public function senderReference($reference){
        $this->senderReference = $reference;

        return $this;
    }

    /**
     * Add receiver referance
     * @param $reference
     * @return $this
     */
    public function receiverReference($reference){
        $this->receiverReference = $reference;

        return $this;
    }

    /**
     * Add a parcel
     * @param $contents
     * @param $weight (kg)
     * @param $copies
     * @param bool $valuePerParcel
     * @return $this
     */
    public function addParcel($contents, $weight, $copies, $valuePerParcel = true){
        $this->parcels[] = [
              "copies" => $copies,
              "weight" => $weight,
              "contents" => $contents,
              "valuePerParcel" => $valuePerParcel,
        ];

        return $this;

    }

    /**
     * Add service
     * @param $id
     * @return $this
     */
    public function service($id)
    {
        $this->service = [
            "id" => $id
        ];

        return $this;
    }

    public function addSenderPartners($id, $custNo){
        $this->senderPartners[] = [
            "id" => $id,
            "custNo" => $custNo
        ];

        return $this;
    }

    public function options($to, $from, $message, $languageCode, $id){
        $this->options = [
              "message" => $message,
              "to" => $to,
              "id" => $id,
              "languageCode" => $languageCode,
              "from" => $from
        ];

        return $this;

    }

    /**
     * Create shipment
     * @return UnifaunShipmentObject
     */
    public function create(){
        $data = RequestHandler::Request("/shipments", "POST", json_encode($this->toArray()));
        return new UnifaunShipmentObject($data[0]);
    }

    /**
     * Store shipment
     * @return UnifaunShipmentObject
     */
    public function store(){
        $data = RequestHandler::Request("/stored-shipments", "POST", json_encode($this->toArray()["shipment"]));
        return new UnifaunShipmentObject($data);
    }




    /**
     * Convert to array
     * @return array
     */
    public function toArray(){

        return [
            "pdfConfig" => $this->pdfConfig,
            "shipment" => [
                "sender" => $this->sender,
                "senderPartners" => $this->senderPartners,
                "receiver" => $this->receiver,
                "service" => $this->service,
                "parcels" => $this->parcels,
                "orderNo" => $this->orderNo,
                "senderReference" => $this->senderReference,
                "receiverReference" => $this->receiverReference,
                "options" => $this->options,
            ]
        ];

    }

















}
