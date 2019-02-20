 <?php
 require_once "controllers/parse_doc.php";
 $data = file_get_contents('php://input');

$data = trim($data, '[');
$data = trim($data, ']');

$json_data = json_decode($data, true);


switch ($json_data['type']) {
    case "ACCEPT": doc_accept($json_data); break;
    case "WRITE_OFF": doc_wright_off($json_data); break;
}
 http_response_code(200);
 