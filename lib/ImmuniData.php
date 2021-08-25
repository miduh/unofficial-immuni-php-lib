<?php

namespace Miduh;

class ImmuniData {

    /*  
    @* @var String $prefix The folder containing the JSON data
    */
    public $prefix = "https://raw.githubusercontent.com/immuni-app/immuni-dashboard-data/master/dati/";
    
    /*
    @* @param String $url Is the URL of the cURL Request.
    */
    private function PerformRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /*
    @* @param Boolean $statement check if the returned data is encoded in JSON or not
    @* @param String $req_url Is the URL of the cURL Request.
    */
    private function ReturnData($statement, $req_url)
    {
        $ImmuniData = new ImmuniData();
        $result = $ImmuniData->PerformRequest($req_url);
        if ($statement)
        {
            $r = json_decode($result, true);
        } else {
            $r = $result;
        }
        return $r;
    }

    /*
    @* @param Boolean $statement check if the returned data is encoded in JSON or not
    */
    public function GetNationalData($encoded = false) {
        $ImmuniData = new ImmuniData();
        $ImmuniData->ReturnData($encoded, $this->prefix."andamento-dati-nazionali.json");
    }

    /*
    @* @param Boolean $statement check if the returned data is encoded in JSON or not
    */
    public function GetDownloadsData($encoded = false) {
        $ImmuniData = new ImmuniData();
        $ImmuniData->ReturnData($encoded, $this->prefix."andamento-download.json");
    }

    /*
    @* @param Boolean $statement check if the returned data is encoded in JSON or not
    @* @param Boolean $latest Check whether to get recent data or not
    */
    public function GetMonthlyRegionalData($encoded = false, $latest = true) {
        $ImmuniData = new ImmuniData();
        if ($latest) 
        {
            $ImmuniData->ReturnData($encoded, $this->prefix."andamento-mensile-dati-regionali-latest.json");
        } else {
            $ImmuniData->ReturnData($encoded, $this->prefix."andamento-mensile-dati-regionali.json");
        }
        
    }

    /*
    @* @param Boolean $statement check if the returned data is encoded in JSON or not
    @* @param Boolean $latest Check whether to get recent data or not
    */
    public function GetWeeklyRegionalData($encoded = false, $latest = true) {
        $ImmuniData = new ImmuniData();
        if ($latest) 
        {
            $ImmuniData->ReturnData($encoded, $this->prefix."andamento-settimanale-dati-regionali-latest.json");
        } else {
            $ImmuniData->ReturnData($encoded, $this->prefix."andamento-settimanale-dati-regionali.json");
        }
        
    }
}
?>
