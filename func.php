
<?php
$con=$GLOBALS['CONNECTION'];
function dateFormat(){
  return array(
    "AaDate"=>Date("D (d) / M (m) / Y || h : i a")
  );
}
function connect(){
  global $con; 
if($con){
   return true;
}
else{
  return false;
}
}

function isRunningOnLocalHost(){
$whitelist = array('127.0.0.1', '::1',"192.168.43.99");
return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}
function getItem($id,$table){
  if(connect()){
    global $con;
$get=$con->query("SELECT * FROM `$table` where id=$id");
if($get){
  if($get->num_rows>0){
    return $get->fetch_assoc();
    }
  }
}
}


function getTable($tableName,$conditions=1){
global $con;
if(connect()){
  $json=[];
  $select=$con->query("SELECT * FROM `$tableName` where $conditions");
  if($select){
  if($select->num_rows>0){
    while ($row=$select->fetch_assoc()) {
     array_push($json,$row);
    }
  } 
}
else{
  echo "Error".$con->error."<br>".$tableName;
logToFile("../developer/Error.txt","\n\n\n".__FUNCTION__."fail to get table line".__LINE__."\n file ".__FILE__."sql said".$con->error);
}
  return $json;
}
}


function reportBug($message,$path="../developer/Error.txt"){
  //send mail
  if(!file_exists($path)){
    $path="developer/Error.txt";
  }
  $message="\n\n".$message."\nDate\n".Date("y_m_d_-_h_i_s a");
  $file=fopen($path,"a");
  fwrite($file,$message);
  fclose($file);
}


function rndName($len){
  $a_to_z=["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
  $mainName="";
  $unique_number = microtime(true) * 999;
  for ($i=0; $i < $len; $i++) { 
    $mainName.=$a_to_z[rand(0,count($a_to_z)-1)].''.rand(0,5).''.$unique_number;
  }
return $mainName."";
}
function getFileContent($filePath){
  if(!file_exists($filePath))return false;
$file=fopen($filePath,"r");
$content=fread($file,filesize($filePath));
fclose($file);
return $content;
}

function get_last_id($tableName){
 global $con;
$select=$con->query("SELECT MAX(id) FROM `$tableName`");
if($select){
  return $select->fetch_array()[0];
}
else{
  echo "fail to get last id";
}
}

function uploadImage($name=array(),$folder=false,$surportedExtn=["image/jpeg","image/jpg","image/png","image/jpg","image/gif","image/svg+xml","image/svg"]){
  if($name["error"]==0){
  $tmp=$name["tmp_name"];
  $type=trim(mime_content_type($tmp));
  $fileName=$name["name"];
  if(!$folder){
    $folder="../images/";
  }
$extn=strtolower(substr($fileName,strrpos($fileName,"."),strlen($fileName)));
if(in_array($type,$surportedExtn)){
  $imageName=substr(trim(md5(rndName(30))),0,15);
 $save=!file_exists($folder.''.$imageName."".$extn) ? move_uploaded_file($tmp,$folder."".$imageName."".$extn):false;
 if($save){
   return $imageName."".$extn;
 }
 else{
   return false;
 }
 }
 else{
  return "notSuported";
}
}
}


function validateEmail($email){
  $email=filter_var($email,FILTER_SANITIZE_EMAIL);
  $email=filter_var($email,FILTER_VALIDATE_EMAIL);
return $email;  
}
function logToFile($fileName,$data){
  if(file_exists($fileName)){
$f=fopen($fileName,"a");
fwrite($f,$data);
fclose($f);
  }
  else{
    exit($fileName. " not exist");
  }
}

//function }

function deleteFile($name){
  if(file_exists($name)){
    unlink($name);
    return "deleted";
  }
  else{
    return "not exist";
  }
}

function execute($query){
  global $con;
  return $con->query($query);
}




function validatePackages($plainPackageMain){
  if(!isset($plainPackageMain)){
    return [];
    }
  else{
$packages=[];

foreach($plainPackageMain as $plainPackage){

    $newObj=Array();
    $newObj["percent"]=$plainPackage["percent"];
    $newObj["id"]=$plainPackage["id"];
   $newObj["title"]=$plainPackage["title"];
    $newObj["pay"]=array("value"=>$plainPackage["pay"],"currency"=>$plainPackage["payCurrency"]);
    $newObj["get"]=array("value"=>$plainPackage["get"],"currency"=>$plainPackage["getCurrency"]);

    $newObj["style"]=$plainPackage["style"];
array_push($packages,$newObj);
  }
}
return $packages;
}

$errorList=[];
function reportErrors($continueExecution=false){
  //
global $errorList;
  if(count($errorList)>0){//write errors on a file
    $errorJson=getFileContent("../developer/BackendErrors.json");
    $errorJson=json_decode($errorJson);
    if($errorJson==null)$errorJson=[];
    foreach($errorList as $error){//push all errors to the json file
      $error['date']=Date('h - i - s a (Y M D) ');
      array_push($errorJson,$error);
    }
    $errorString=json_encode($errorJson);
    //if possible send mail to developer about the new errors
    $errorLogs=fopen('../developer/BackendErrors.json','w');
    fwrite($errorLogs,$errorString);
    fclose($errorLogs);
    if(!$continueExecution)exit('SqlError');
  }
}


function logClient($arr){
echo "<script>console.log('".json_encode($arr)."')</script>";
}