<?php
$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'world';
$connection = undefined;
$par_Args = array($_GET['country'], $_GET['all']);
$emp_data = "NO DATA AVAILABLE!";


//Checking the SQL Database  
function checkDbase(){
    global $host, $dbname, $username, $password;
    $GLOBALS['connection'] = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    if($GLOBALS['connection']->getAttribute(PDO::ATTR_ERRMODE)){
        die("Failed to connect to database.");
    }
}

//SQL Query 
function query_Sql(){
    $searchString;
    checkDbase();
    if($GLOBALS['par_Args'][1] == 'true'){
        $searchString = "SELECT * FROM countries";
    } else {
        $searchString = "SELECT * FROM countries WHERE name LIKE '%".$GLOBALS['par_Args'][0]."%'";
    }
    $returnRecord = $GLOBALS['connection']->query($searchString);
    if($returnRecord->rowCount() > 0){
        $results = $returnRecord->fetchAll(PDO::FETCH_ASSOC);
        echo '<ul>';
        foreach ($results as $row) {
          echo '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo $GLOBALS['emp_data'];
    }
}
//Execution of the query_Sql(SQL query) 
if($par_Args[0] == '' & $par_Args[1] == 'false'){
	echo $emp_data;
} else {
    query_Sql();
}

?>