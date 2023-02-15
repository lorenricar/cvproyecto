<?PHP
 $hserv=0;
// $meses=array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
 $meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
 $dias=array('domingo','lunes','martes','mi&eacute;rcoles','jueves','viernes','s&aacute;bado');
 $anio;
 $mes;
 $dia;
 $fecha=fun_fecha();
 $hora=date("h").":".date("i").":".date("s");
// ----------------------
function fun_fecha(){
    global $meses,$dias,$anio,$mes;
    $anio = date("Y");
    $mes  = date("m");
    $dia  = date("d");
    $ndia = date("w");
    $sec  = date("s");
    $mm=0+$mes;
    $f=$dias[$ndia].", ".$dia." de ".$meses[$mm]." de ".$anio;
return($f);
}
// -----
//  "20021005"=dtos("5/10/2002");
// 
function dtos($cfech){
//  print("func:dtos(??) en 'fun_fech.php' ".$cfech);
$rfec="";
$cfec = explode('/',$cfech);
$nc=count($cfec);
if($nc>1){
    if (strlen($cfec[1])==1){$cf='0'.$cfec[1];$cfec[1]=$cf;}
    if (strlen($cfec[0])==1){$cf='0'.$cfec[0];$cfec[0]=$cf;}
    $rfec.=$cfec[2].$cfec[1].$cfec[0];
}
if(empty($rfec)){
    $cfec = explode('-',$cfech);
    $nc=count($cfec);
    if($nc>1){
       if (strlen($cfec[1])==1){$cf='0'.$cfec[1];$cfec[1]=$cf;}
       if (strlen($cfec[0])==1){$cf='0'.$cfec[0];$cfec[0]=$cf;}
       $rfec.=$cfec[2].$cfec[1].$cfec[0];
   }
}
return($rfec);
}
// -----
//  "20021025"=nueva_fecha("20021005",20);
// 
function nueva_fecha($cfech,$dias){
    $fex = mktime(0,0,0,0+substr($cfech,4,2),0+substr($cfech,6,2)+$dias,0+substr($cfech,0,4));
    $nueva = dtos(date("d/m/Y",$fex));
// print ($nueva);exit;
return($nueva);
}
// -----
//  "05/10/2002"=stod("20021005");
// 
function stod($cfech){
return(substr($cfech,6,2)."/".substr($cfech,4,2)."/".substr($cfech,0,4));
}
// -----
//  $nueva_hora=nueva_hora("20021005","12:14:03",-12);
//  $nueva_hora=nueva_hora("","",-12);  calcula fecha y hora del server
// 
function nueva_hora($cfech,$chora,$hh){
if (!empty($cfecha)){
    $ddd = 0+substr($cfech,6,2);
    $mmm = 0+substr($cfech,4,2);
    $aaa = 0+substr($cfech,0,4);
}
else{
    $ddd = 0+date("d");
    $mmm = 0+date("m");
    $aaa = 0+date("Y");
}
if (!empty($chora)){
    $hor = 0+substr($chora,0,2);
    $min = 0+substr($chora,3,2);
    $sec = 0+substr($chora,6,2);
}
else{
    $hor = 0+date("H");
    $min = 0+date("i");
    $sec = 0+date("s");
}
    $nueva = mktime(0+$hor+$hh,0+$min,0+$sec,$mmm,$ddd,$aaa);
// print ($nueva);exit;
return($nueva);
}
?>
