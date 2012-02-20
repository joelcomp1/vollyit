<?php
    require_once("xmlparser.php");

    class upsaddress
    {
        var $accessKey;
        var $userId;
        var $password;
        var $url;
        
        var $city;
        var $state;
        var $zip;
        
        var $statuscode;
        var $statusdescription;
        var $error;
        var $list = array();
        
        function upsaddress($key, $user, $password, $url = "https://wwwcie.ups.com/ups.app/xml/AV")
        {
            $this->accessKey = $key;
            $this->userId    = $user;
            $this->password  = $password;
            $this->url       = $url;

        }

        function setCity($city)
        {
            $this->city = $city;
        }

        function setState($state)
        {
            $this->state = $state;
        }

        function setZip($zip)
        {
            $this->zip = $zip;
        }

        function getResponse()
        {
            $request =  "<?xml version=\"1.0\"?>\n".
                        "<AccessRequest>\n".
                        "   <AccessLicenseNumber>".$this->accessKey."</AccessLicenseNumber>\n".
                        "   <UserId>".$this->userId."</UserId>\n".
                        "   <Password>".$this->password."</Password>\n".
                        "</AccessRequest>\n".
                        "<?xml version=\"1.0\"?>\n".
                        "<AddressValidationRequest xml:lang=\"en-US\">\n".
                        "   <Request>\n".
                        "       <TransactionReference>\n".
                        "           <CustomerContext>Smart-Shop custommer</CustomerContext>\n".
                        "           <XpciVersion>1.0001</XpciVersion>\n".
                        "       </TransactionReference>\n".
                        "       <RequestAction>AV</RequestAction>\n".
                        "   </Request>\n".
                        "   <Address>\n";
            if(!empty($this->city)) $request  .= "       <City>".$this->city."</City>\n";
            if(!empty($this->state)) $request .= "       <StateProvinceCode>".$this->state."</StateProvinceCode>\n";
            if(!empty($this->zip)) $request   .= "       <PostalCode>".$this->zip."</PostalCode>\n";
            $request .= "   </Address>\n".
                        "</AddressValidationRequest>";
            
            $header[] = "Host: www.smart-shop.com";
            $header[] = "MIME-Version: 1.0";
            $header[] = "Content-type: multipart/mixed; boundary=----doc";
            $header[] = "Accept: text/xml";
            $header[] = "Content-length: ".strlen($request);
            $header[] = "Cache-Control: no-cache";
            $header[] = "Connection: close \r\n";
            $header[] = $request;

            $ch = curl_init();
            //Disable certificate check.
            // uncomment the next line if you get curl error 60: error setting certificate verify locations
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // uncommenting the next line is most likely not necessary in case of error 60
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            //-------------------------
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            //curl_setopt($ch, CURLOPT_CAINFO, "c:/ca-bundle.crt");
            //-------------------------
            curl_setopt($ch, CURLOPT_URL,$this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            
            $data = curl_exec($ch);        
            if (curl_errno($ch)) {
                print curl_error($ch);
            } else {
                $xmlParser = new xmlparser();
                $array = $xmlParser->GetXMLTree($data);
                
                $this->statuscode = $array['ADDRESSVALIDATIONRESPONSE'][0]['RESPONSE'][0]['RESPONSESTATUSCODE'][0]['VALUE'];
                $this->statusdescription = $array['ADDRESSVALIDATIONRESPONSE'][0]['RESPONSE'][0]['RESPONSESTATUSDESCRIPTION'][0]['VALUE'];
                if(count($array['ADDRESSVALIDATIONRESPONSE'][0]['RESPONSE'][0]['ERROR']))
                {
                    $error_array = $array['ADDRESSVALIDATIONRESPONSE'][0]['RESPONSE'][0]['ERROR'][0];
                    $error = new error();
                    $error->serverity = $error_array['ERRORSEVERITY'][0]['VALUE'];
                    $error->code = $error_array['ERRORCODE'][0]['VALUE'];
                    $error->description = $error_array['ERRORDESCRIPTION'][0]['VALUE'];
                    $this->error = $error;
                }
                if(count($array['ADDRESSVALIDATIONRESPONSE'][0]['ADDRESSVALIDATIONRESULT']))
                {
                    foreach($array['ADDRESSVALIDATIONRESPONSE'][0]['ADDRESSVALIDATIONRESULT'] as $key1 => $result)
                    {
                        $address = new address();
                        $address->rank = $result['RANK'][0]['VALUE'];
                        $address->quality = $result['QUALITY'][0]['VALUE'];
                        $address->city = $result['ADDRESS'][0]['CITY'][0]['VALUE'];
                        $address->state = $result['ADDRESS'][0]['STATEPROVINCECODE'][0]['VALUE'];
                        $address->zipLow = $result['POSTALCODELOWEND'][0]['VALUE'];
                        $address->zipHigh = $result['POSTALCODEHIGHEND'][0]['VALUE'];
                        $this->list[] = $address;
                    }
                }
                return $this;
            }
        }

    }

    class error
    {
        var $serverity;
        var $code;
        var $description;
    }
    class address
    {
        var $rank;
        var $quality;
        var $city;
        var $state;
        var $zipLow;
        var $zipHigh;
    }
?>
