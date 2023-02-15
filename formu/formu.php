<?PHP
// ------ modificado el 25/01/2023
require("fun_fech.php");
// --- crea la carpeta de grabacion de mensajes si no existe
$subdi="msg/";
if(!empty($subdi)){if(!file_exists($subdi)){mkdir($subdi,0777);}}
    $razon   = "EASI ";                 // nombre de la empresa
    $xemail  = "info@easi.com.ar";      // email de la empresa (quien envia)
    $xemail1 = "info@easi.com.ar";      // email de quien recibe
    $xhttp   = "www.easi.com.ar";       // acceso a la pagina
// -----------lectura de datos recibidos del formulario
    $nombre   =$_GET["nombre"];
    $telef    =$_GET["telefono"];
    $email    =$_GET["email"];
    $mensaje  =$_GET["mensaje"];
// ------------ pagina de retorno cuando cierra la pagina de respuesta
    $url="/ricar/index.html";
    $cfilcont = $subdi."msg.dat";
if (!isset($retorno)){$retorno=$url;}
# --------- incrementa el contador -------------
$tipo="";if (isset($TIPO)){$tipo=$_GET["TIPO"];}
if (empty($tipo)){$tipo="SOLICITUD";}
if (!empty($tipo)){
    $count=999;
    $ltxt=file_exists($cfilcont);
    if ($ltxt){
       $ntxt = file($cfilcont);
       $count=0;
       if(!empty($ntxt[0])){$count+=$ntxt[0];}
   }
    $count++;
    grab_cont($cfilcont);         // graba contador de uso
    $texto=envia_formu($tipo);    // graba mensaje en servidor y envia email
}
else{
  $texto = "Error..... Falta el tipo de formulario";
}
// --------- pagina de respuesta del envio
init_html('REGISTRO DE FORMULARIOS');                    // pagina sin recarga
print($texto);   // en $texto esta la pagina de respuesta
fin_html();
// ---
function atras(){
    return("<br><center><a href='javascript:history.back()'>ATRAS</a>");
}
// ---
function envia_formu($ctipo){
    global $razon,$xemail,$xemail1;
    $resp ="";
    $cdato="";
    if ($ctipo=="SOLICITUD") {
       $cdato=solicitud("");        // String de datos a grabar
       $resp=pag_rilo();            // devolucion pagina ricardo
   }
if (!empty($cdato)){grab_msg($cdato);
// habilitar la funcion e_mail() para enviar email por cada solicitud recibida
// hay que definir los emails en $xemail y $xemail1 (lineas 11 y 12) 
//   e_mail($cdato,$xemail1,"Envio de ".$ctipo,$razon,$xemail);
 }
 return($resp);
}
// ---
function pag_rilo(){
   /*header("location:http://easi.com.ar/ricar/enviado.html");*/
 $url="../";
 $p='';
 $p.='<!DOCTYPE html><html lang="es"><head>';
 $p.='<meta charset="UTF-8">';
 $p.='<link rel="shortcut icon" href="'.$url.'img/logo_p1.ico">';
 $p.='<meta name="viewport" content="width=device-width, initial-scale=1.0">';
 $p.='<META NAME="Title" CONTENT="desarrollos front-end">';
 $p.='<META NAME="keywords" CONTENT="ROSARIO, rosario, Argentina, argentina , ">';
 $p.='<META NAME="Description" CONTENT="desarrollos front-en">';
 $p.='<meta property ="og:url" content="https://easi.com.ar">';
 $p.='<meta property ="og:title" content="desarrollos front-end">';
 $p.='<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
 $p.='<link href="https://fonts.googleapis.com/css2?family=Alegreya&family=Sofia+Sans+Semi+Condensed:wght@100&display=swap" rel="stylesheet">';
 $p.='<link rel="stylesheet" href="'.$url.'css/normalize.css">';
 $p.='<link rel="stylesheet" href="'.$url.'css/styles.css">';
 $p.='<link rel="stylesheet" href="'.$url.'css/envia.css" >'; 
 $p.='<title>Datos enviados</title>';
 $p.='</head><body>';
 $p.='<script>function botenvia(){URL="'.$url.'index.html";window.open(URL,"rilo");}</script>';
 $p.='<!--Archivo styles.css-->';
 $p.='<div class="hea_mues">'; 
 $p.='<img class="header__logo" src="'.$url.'img/logo.gif" alt="Logotipo">';
 $p.='</div>';
 $p.='<div class="contenedor_en">';
 $p.='<div class="grid_en">';
 $p.='<div class="arriba_en"></div>';
 $p.='<div class="latiz_en"></div>';
 $p.='<div class="centro_en">';
 $p.='<div class="env-1">Sus datos fueron enviados</div>';
 $p.='<div class="env-2" >A la brevedad nos comunicaremos con Ud</div>';
 $p.='<input class="boton-en" onclick=botenvia()   type="submit" value="Volver">';
 $p.='</div>';
 $p.='</div>';  
 $p.='</div>';            
 $p.='<footer class="pie-pagina"><p>Todos los derechos reservados</p></footer>';
 $p.='</body></html>'; 
 return($p);
}
// ---
function solicitud($lf){
global $fecha,$nombre,$telef,$email,$mensaje;
$font="";$xf="";
if (!empty($lf)){
    $xf="</font>";
    $font="<font size=3 face=verdana color=#0000ff>";
    $resp  = "<body bgcolor=#F0F0F0>";
    $resp .= "Envi&oacute; los siguientes datos<br>\n";
}
else{
    $resp  = "SOLICITUD \n";
}
$resp .= "fecha    :".$font.$fecha.$xf.$lf."\n";
$resp .= "Nombre   :".$font.$nombre.$xf.$lf."\n";
$resp .= "Telefono :".$font.$telef.$xf.$lf."\n";
$resp .= "E-mail   :".$font.$email.$xf.$lf."\n";
$resp .= "Mensaje  :".$font.$mensaje.$xf.$lf."\n";
if (!empty($lf)){
     $resp .="Gracias por enviar sus datos... Nos comunicaremos a la brevedad<br>\n";
}
return($resp);
}
// ---
function init_html($titulo){
print ('<HTML><HEAD><title>'.$titulo.'</title>'."\n");
print ('<style type="text/css"><a:link{ color:#440000} a:hover{background:#ffffbb; color:#0000FF}></style>'."\n");
print ("</HEAD>\n");
}
// --------
function init_html_refresh($titulo,$refresh,$url){
print ('<HTML><HEAD><title>'.$titulo.'</title>'."\n");
print ('<style type="text/css"><a:link{ color:#440000} a:hover{background:#ffffbb; color:#0000FF}></style>'."\n");
print('<META HTTP-EQUIV="Refresh" CONTENT="'.$refresh.';URL='.$url.'">');
print ('</HEAD>'."\n");
}
// ---
function fin_html(){print("\n</body></html>\n");}
// ---
function grab_cont($cfile){
    global $count;
    $hfp    = fopen($cfile,"w");
    $ctexto = "".$count."\n";
    fwrite($hfp,$ctexto);
    fclose($hfp);
}
// ---
function grab_msg($cdat){
    global $subdi,$grupo,$count,$hserv;
    $cfile  = $subdi.$grupo.$count;
    $hh = nueva_hora("","",$hserv);
    $fech   = date("d/m/Y",$hh);
    $hora   = date("H:i:s",$hh);
    $http   = getenv('REMOTE_ADDR');
    $user   = getenv('REMOTE_USER');
    $hfp    = fopen($cfile,"w");
    $ctexto = "MSG ".$count.'|'.$fech.'|'.$hora.'|'.$http.'|'.$user."\n\n".$cdat;
    fwrite($hfp,$ctexto);
    fclose($hfp);
}
// -----  mail --------
function e_mail($cdat,$email_recibe,$asunto,$name,$email_envia){
    global $hserv;
    $resp="no envio";
    if(!empty($email_recibe)){ 
       $hh = nueva_hora("","",$hserv);
       $fech   = date("d/m/Y",$hh);
       $hora   = date("H:i:s",$hh);
       $from  = $name." <".$email_envia.">";
       $reply = "";
       $otros = "";
       if(strlen($from)>0)  {$otros.="From: ".$from."\r\n";}
       if(strlen($reply)>0) {$otros.="Reply-To: ".$reply."\r\n";}
          $otros.="X-Mailer: PHP - " . phpversion()."\r\n";
//     $lf="\n";
          $lf="<br>";
          $otros.="Content-Type: text/html"."\n";
       if(empty($asunto)){$asunto = "**???**";}
          $msg    = "Fecha envio ".' '.$fech.' '.$hora.$lf;
          $msg   .= $cdat;
          mail($email_recibe, $asunto, $msg, $otros);
          $resp="";
  }
  return($resp);
}
?>

