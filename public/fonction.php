<?php
function newRandomMdp()
{
    $chaine = '@!#&';
    $random = rand(0, 3);
    for ($i = 0; $i < 1; $i++) {

        $newMdp = sha1($chaine[$random] . "Portezcevieuxwhiskyaujugeblondquifume");
        $random = rand(0, 3);
        $newMdp = substr($newMdp, 0, 7) . $chaine[$random];
        // echo "ORI :" . $newMdp  ."<br>";
        explode(" ", $newMdp, 2);
        $arry = str_split($newMdp);
        $random1 = rand(0, count($arry) - 2);
        $temp = $arry[$random1];
        $arry[$random1] =  $arry[7];
        $arry[7] =  $temp;

       echo $newMdp = implode($arry) . "<br>";
    }return $newMdp;
}