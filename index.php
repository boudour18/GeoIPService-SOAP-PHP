<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geo IP Application</title>
    <link rel="stylesheet" href="css/boudour_style.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="css/sweetalert.css">
</head>
<body>
   <div class="container">
       <div class="form_block">
        <div id="description">
          <marquee><span>With "Find my IP Address" you can quickly retrieve your IP Address both country name location and country code, All Right Reserved, Boudour.</span></marquee> 
           <img src="images/logo.gif" alt="Find My IP" width="100" height="100">
        </div>
           <form action="" method="post" class="form_geoip">
               <input type="text" id="ipaddress" name="ipaddress" placeholder="Ex : 200.192.10.1" required><br>
                <input type="submit" value="Find Location" id="submit" name="submit">
            </form>
       </div>
   </div>
    <?php
    if(isset($_POST['submit'])){
        $ipaddress = $_POST['ipaddress'];
        getLocation($ipaddress);
    }
    
    function getLocation($ip){
        
        $url = "http://www.webservicex.net/geoipservice.asmx?WSDL";

        $client = new SoapClient($url);

        if(isset($client)){
    
        $res = $client->GetGeoIP(array('IPAddress' => $ip));

        //print_r($res);
    
        $array = json_decode(json_encode($res->GetGeoIPResult), True);
    
        $ID = $array['ReturnCode'];
        $IP = $array['IP'];
        $ReturnCodeDetails = $array['ReturnCodeDetails'];
        $CountryName = $array['CountryName'];
        $CountryCode = $array['CountryCode'];
    
        //echo "Country Name : ".$CountryName."</br>";
    
        ?>
        <script>swal("<?php echo $ReturnCodeDetails; ?>", "<?php
        echo $IP." ";
        echo $CountryName." ";
        echo $CountryCode;
        ?>", "success")</script>
        <?php
            
        //echo date("d M Y", mktime()); 
    
        }
    }

    ?>
</body>
</html>