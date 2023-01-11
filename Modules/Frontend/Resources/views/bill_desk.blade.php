<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="index_folder/favicon.ico">
    <title>Billdesk SDK</title>

</head>

<body>
    <div class="container">
        <div class="jumbotron mt-3">
            <h1>BillDesk SDK</h1>
            <a class="btn btn-lg btn-primary" href="#" onclick="loadXMLDoc()" role="button">Launch SDK »</a>
        </div>
        <div id="spinner" style="display: none;" class="mt-3 text-center">
            <div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div id="result" class="jumbotron mt-3">
        </div>
    </div>
    
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
    integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous">
    </script>
     
    <script type="module" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
    <script nomodule src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
    <link href="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
    <script type="text/javascript">
    function hideSpinner() {
        document.getElementById('spinner').style.display = 'none';
    }

    function showSpinner() {
        document.getElementById('spinner').style.display = 'block';
    }
    
    var flow_config = {
        merchantId: "BDMONITOR",
        bdOrderId: "OA3019XTRL4E63",
        returnUrl:"https://www.merchant.com/abcpag",
        authToken: "OToken 04F9331CA9C54FC60E5EFD6B12EBC098803A4C2FAA99F60A90C4AE38099A92AC947FBFBC966554B701CF535B1E34D7639671C395910335000C8F45AF2095B7000CA634B68E16A15C82756994BB362630B8098D7B9E736DDEAE72447A9A529F67700FB1A38217995C3309A1533D4163F9F8352E38923D58A6E3F29E554B5A3EA130E9EEFB20594FC96DD1CAB94376387080CF07C82D1807D2DB.4145535F55415431",
        childWindow: false
        
    };
    var config = {
        merchantLogo: "",
        flowConfig: flow_config,
        flowType: "payments"
    };

    function loadXMLDoc() { 
        showSpinner();
        document.getElementById("result").innerHTML = "";
        var xmlhttp = new XMLHttpRequest();
        var jsonObj = "";
        
        {
        
            window.loadBillDeskSdk(config); 
                
        };
    }
    </script>
</body>

</html>