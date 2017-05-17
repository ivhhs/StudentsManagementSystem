<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/5/12
 * Time: 13:29
 */
require_once '../include.php';
$act = $_REQUEST['act'];
$id = $_REQUEST['id'];

if ($act == 'logout') {
    logout();
} elseif ( $act == 'addAdmin' ) {
    $mes = addAdmin();
} elseif($act=="editAdmin"){
    $mes = editAdmin($id);
} elseif($act=="delAdmin") {
    $mes = delAdmin($id);
} elseif($act=="addClass") {
    $mes = addClass();
} elseif($act=="editClass") {
    $mes = editClass($id);
} elseif($act=="delClass") {
    $mes = delClass($id);
} elseif($act=="addStudent") {
    $res = addStudent();
    $res = json_encode($res, JSON_UNESCAPED_UNICODE);
    print_r($res);
    exit();
} elseif($act=="getClass") {
    $res = getClass($id);
    $res = json_encode($res, JSON_UNESCAPED_UNICODE);
    print_r($res);
    exit();
} elseif($act == "editStudent") {
    $mes = editStudent($id);
} elseif($act == "delStudent") {
    $mes = delStudent($id);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Info</title>
</head>
<body>
<?php
	if($mes){
        echo $mes;
    }
?>
</body>
</html>