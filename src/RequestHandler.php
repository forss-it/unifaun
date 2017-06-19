<?php
namespace Dialect\Unifaun;
use Exception;
class RequestHandler
{

    public static function Request($resource, $type = '', $data = null)
    {
        $res = null;
        if ($type && strtoupper($type) !== "GET") {
            $res = Self::PostRequest($resource, $type, $data);
        } else {
            $res = Self::GetRequest($resource, $data);
        }

        return $res;
    }

    private static function GetRequest($resource, $data)
    {

        $curl = curl_init(config('unifaun.url').$resource);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [Self::getAuthHeader()]);
        $res = curl_exec($curl);
        $info = curl_getinfo($curl);
        if (curl_error($curl) || ($info["http_code"] != 200 && $info["http_code"] != 201)) {

            throw new Exception("Could not curl to url (code: ".$info["http_code"]."): ".config('unifaun.url').$resource."\nMessage: ".$res, 500);

        }
        $result = json_decode($res);
        if (json_last_error()) {
            throw new Exception("Could not parse json response: ".$res);
        }
        return $result;
    }

    private static function PostRequest($resource, $type, $data)
    {

        if (strtolower($type) == 'file') {
            $type = "POST";
            $contenttype = "Content-Type: multipart/form-data";
        } else {
            $contenttype = 'Content-Type: application/json';
        }

        $curl = curl_init(config('unifaun.url').$resource);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json", Self::getAuthHeader()]);
        $res = curl_exec($curl);
        $info = curl_getinfo($curl);
        if (curl_error($curl) || ($info["http_code"] != 200 && $info["http_code"] != 201)) {

            throw new Exception("Could not curl to url (code: ".$info["http_code"]."): ".config('unifaun.url').$resource."\nMessage: ".$res, 500);
        }
        $result = json_decode($res);
        if (json_last_error()) {
            throw new Exception("Could not parse json response: ".$res, 500);
        }

        return $result;
    }

    private static function getAuthHeader()
    {
        if(strtolower(config('unifaun.authentication')) == "oauth2")
        {
            return "Authorization: Bearer ".config('unifaun.id')."-".config('unifaun.secret');
        }
        else
        {
            return "Authorization: Basic ". base64_encode(config('unifaun.id').":".config('unifaun.secret'));
        }

    }
}