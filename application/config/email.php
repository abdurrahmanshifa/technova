<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol']='smtp';  
$config['smtp_host']='ssl://smtp.Gmail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='30';  

$config['smtp_user'] = "Your Email";
$config['smtp_pass'] = "Your Password"; 


$config['charset']='utf-8';  
$config['mailtype']='html';
$config['starttls']=true;
$config['wordwrap']=true;
$config['newline']="\r\n"; 
$config['charset']='iso-8859-1'; 

?>