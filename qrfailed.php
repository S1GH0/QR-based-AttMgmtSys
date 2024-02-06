<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="insert.php" method="post" class="form-horizontal">
    <div id="you-qr-result">
        
    </div>
    
    <h1> Scan qr html</h1>
    <input type="text" name="text" id="text" placeholder="Your Qr">
    <div style="display: flex; justify-content: center;">
        <div id="my-qr-reader" style="width: 500px;"></div>
    </div>
    </form>


    <!-- LOAD LIBRARY -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        //CHECK IF DOM IS READY
        function domReady(fn){
            if(document.readyState === "complete" || document.readyState === "interactive"){
                setTimeout(fn,1)
            }else{
                document.addEventListener("DOMContentLoaded",fn)
            }

        }
        domReady(function(){
            var myqr = document.getElementById('you-qr-result')
            var lastResult,countResults = 0;

            function onScanSuccess(decodeText,decodeResult){
                if(decodeText !== lastResult){
                    ++countResults;
                    lastResult = decodeText;

                    //Alert your qr here
                    alert("Your Qr is: " + decodeText,decodeResult )

                    myqr.innerHTML = ` your scan ${countResults} : ${decodeText}`
                    document.forms[0].submit();


                }
            }

            var htmlscanner = new Html5QrcodeScanner(
                "my-qr-reader",{fps: 10, qrbox: 250})
            
            htmlscanner.render(onScanSuccess)
        })

    </script>
    
</body>
</html>