<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires:0");

require_once("./config_paytm.php");
require_once("./encdec_paytm.php");

$paytmChecksum = "";
$CHECKSUMSTATUS="";
$TRANSACTIONSTATUS="";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; 


$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 
 echo "<center><h1>Please wait to be transfered to a different page...</h1></center>" . "<br/>"; 
 if (isset($_POST) && count($_POST)>0 ){ 
     
     $TRANSACTIONSTATUS = $_POST["STATUS"];
     
      if($isValidChecksum == "TRUE") { 
        $CHECKSUMSTATUS = "true";
      }
      else {
     $CHECKSUMSTATUS = "false";
     }
     
    }

?>

 <script type="text/javascript">
 var checksumvaluestatus = "<?php echo $CHECKSUMSTATUS; ?>" ;
 var transactionvaluestatus = "<?php echo $TRANSACTIONSTATUS; ?>" 
 messageHandler.postMessage(checksumvaluestatus);
 messageHandler1.postMessage(transactionvaluestatus);
 </script>
