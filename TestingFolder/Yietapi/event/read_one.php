<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/event.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare event object
$event = new Event($db);
 
// set ID property of record to read
$event->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of event to be edited
$event->readOne();
 
if($event->title!=null){
    // create array
    $event_arr = array(
        "id" =>  $event->id,
        "organization_id" => $event->organization_id,
        "org_name" => $event->org_name,
        "title" => $event->title,
        "description" => $event->description,
        "email" => $event->email,
        "phone" => $event->phone,



        "job_title" =>$event->job_title,
        "job_description" =>$event->job_description,
        "starttime" =>$event->starttime,
        "endtime" =>$event->endtime,
        "min" =>$event->min,
        "max" =>$event->max,

      //  "public" => $event->public
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($event_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user event does not exist
    echo json_encode(array("message" => "event does not exist."));
}
?>