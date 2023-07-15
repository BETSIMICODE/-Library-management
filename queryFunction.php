<?php
function queryPreparation($connection,$query,$val){
    //this is the function who prepare the query
        //PDO's object variable
        $connection=$connection;
        //an array that contains the query parameters
        $val=$val; 
        //the query
        $query=$query; 
        //query's preparation
        $queryPrepared=$connection->prepare($query);

        //question mark's number in the query
        $markOccurence=substr_count($query,'?'); 
        for ($i=1;$i<=$markOccurence;$i++){
            $queryPrepared->bindValue($i,$val[$i-1]);
        }
        return $queryPrepared;
}
function verification($connection,$query,$val){    
    //this is the function who verify the information's existence
        $queryPrepared=queryPreparation($connection,$query,$val);
        //query's execution
        $queryPrepared->execute();
        //if queryExecuted's values is empty return false else true
        if ($queryPrepared->fetch()){
            return true;
        }else{
            return false;
        }
}


function recupVal($connection,$query,$val,$valRecup){    
    //this is the function who verify the information's existence
    $queryPrepared=queryPreparation($connection,$query,$val);
    //query's execution
    $queryPrepared->execute();
    $information=$queryPrepared->fetch(PDO::FETCH_ASSOC);
    return $information[$valRecup];
    
}




function addNewInformation($connection,$query,$val){
    //this is the function who add the new infotmation
    $queryPrepared=queryPreparation($connection,$query,$val);
    //query's execution
    $queryPrepared->execute();

}



function showInformation($connection,$query,$val){    
    //this is the function who show all  information
    $queryPrepared=queryPreparation($connection,$query,$val);
    //query's execution
    $queryPrepared->execute();
    //if queryExecuted's values is empty return false else true
    $a=$queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    $queryPrepared->closeCursor();
    return $a;
    
}


function verificationDifferent($connection,$query,$val,$differentCol,$differentVal){
    $col=showInformation($connection,$query,$val);
    foreach ($col as $value) {
        if ($value[$differentCol]!=$differentVal){
            return true;
        }
    }
    return false;
}

function recupValVerificationDifferent($connection,$query,$val,$differentCol,$differentVal){
    $col=showInformation($connection,$query,$val);
    foreach ($col as $value) {
        if ($value[$differentCol]!=$differentVal){
            return $value[$differentCol];
        }
    }
    return "No value";
}

?>



