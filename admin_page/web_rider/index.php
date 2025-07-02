
<script src="ht.js"></script>
<style>
  .result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  .row{
    display:flex;
  }
  input{
    width: 500px;
    height:200px
  }
  body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
    }

    .col {
      flex: 1 1 300px;
      max-width: 500px;
      margin: 10px;
    }

    #reader {
      width: 100%;
      height: auto;
      border: 1px solid #ccc;
      padding: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .result {
      background-color: green;
      color: #fff;
      padding: 20px;
      border-radius: 5px;
    }

    input {
      width: 100%;
      height: 100px;
      padding: 10px;
      font-size: 16px;
      margin-top: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    form {
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      .col {
        flex: 1 1 100%;
        max-width: 100%;
      }

      input {
        height: 40px;
      }
    }
</style>
<div class="row">
  <div class="col">
    <div style="width:500px;" id="reader"></div>
  </div><audio id="myAudio1">
  <source src="success.mp3" type="audio/ogg">
</audio>
<audio id="myAudio2">
  <source src="failes.mp3" type="audio/ogg">
</audio>
<script>
var x = document.getElementById("myAudio1");
var x2 = document.getElementById("myAudio2");      
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}

function playAudio() { 
  x.play(); 
} 


  </script>
  <div class="col" style="padding:30px;">
    <h4>SCAN RESULT</h4>
    <div>User Order</div><form action="">
    
     <p>Status: <span id="txtHint"></span></p>
     <input type="text" name="start" class="input" id="result" onkeyup="showHint(this.value)" placeholder="result here" readonly=""/></form>
  </div>
</div>
<script type="text/javascript">
function onScanSuccess(qrCodeMessage) {
    document.getElementById("result").value = qrCodeMessage;
    showHint(qrCodeMessage);
playAudio();

}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

</script>