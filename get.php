<?php
if(isset($_POST['txt'])){
    $txt=$_POST['txt'];
    $txt=substr($txt,0,99);
    $txt=htmlspecialchars($txt);
    $txt=rawurlencode($txt);
    $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
    $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
    echo $player;
}

?>




