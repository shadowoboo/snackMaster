<?php
session_start();
if(session_destroy()==true){
    echo "Clear session ok!";
}else{
    echo "Clear session Fail Q口Q ";
}

?>