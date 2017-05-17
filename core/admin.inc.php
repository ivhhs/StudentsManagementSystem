<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/4/28
 * Time: 22:22
 */

function checkAdmin($sql) {
    $mysqli = new DbOperat();
    return $mysqli->fetchOne($sql);
}

function checkLogined() {
    if($_SESSION['adminId'] == '' && $_COOKIE['adminId'] == '') {
        alertMes("请先登陆", "login.php");
    }
}

function checkLoginPage() {
    if($_SESSION['adminId'] != '' && $_COOKIE['adminId'] != '') {
        alertMes("您已登陆，即将为您跳转", "index.php");
    }
}

/**
 * @return string
 */
function addAdmin(){
    $mysqli = new DbOperat();
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if($mysqli->insert("stu_admin",$arr)){
        $mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    }
    return $mes;
}

/**
 * 注销管理员
 */
function logout() {
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time()-1);
    }
    if (isset($_COOKIE['adminId'])) {
        setcookie("adminId", "", time() -1 );
    }
    if (isset($_COOKIE['adminName'])) {
        setcookie("adminName", "", time() -1 );
    }
    session_destroy();
    header("location:login.php");
}

/**
 * 得到所有的管理员
 * @return array
 */
function getAllAdmin(){
    $mysqli = new DbOperat();
    $sql="select id,username,email from stu_admin ";
    $rows=$mysqli->fetchAll($sql);
    return $rows;
}

/**
 * 管理员列表分页
 * @param $page
 * @param int $pageSize
 * @return array
 */
function getAdminByPage($page,$pageSize=2){
    $mysqli = new DbOperat();
    $sql="select * from stu_admin";
    global $totalRows;
    $totalRows=$mysqli->getResultNum($sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,username,email from stu_admin limit {$offset},{$pageSize}";
    $rows=$mysqli->fetchAll($sql);
    return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
    $mysqli = new DbOperat();
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if($mysqli->update("stu_admin", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
    }
    return $mes;
}
/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
function delAdmin($id){
    $mysqli = new DbOperat();
    if($mysqli->delete("stu_admin","id={$id}")){
        $mes="删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
    }
    return $mes;
}

/**
 *系别列表
 * @return array
 */
function listSchool() {
    $mysqli = new DbOperat();
    $sql = "select id,sName from stu_school ";
    $rows = $mysqli->fetchAll($sql);
    return $rows;
}

/**
 *班级列表
 *
 * @return array
 */
function listClass($sId = null, $cId = null) {
    $mysqli = new DbOperat();
    if (empty($sId) && empty($cId)) {
        $sql = "select id,sId,cName from stu_Class ";
        $rows = $mysqli->fetchAll($sql);
    } else {
        $sql = "select * from stu_Class where sId={$sId} AND id={$cId}";
        $rows = $mysqli->fetchOne($sql);
    }
    return $rows;
}

function getClass($sId) {
    $mysqli = new DbOperat();
    $sql = "select id,sId,cName from stu_Class where (sId={$sId})";
    $rows = $mysqli->fetchAll($sql);
    return $rows;
}

/**
 * 班级列表分页
 * @param $page
 * @param int $pageSize
 * @return array
 */
function getClassByPage($page,$pageSize=2){
    $mysqli = new DbOperat();
    $sql="select * from stu_class";
    global $totalRows;
    $totalRows=$mysqli->getResultNum($sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,cName,sId from stu_class limit {$offset},{$pageSize}";
    $rows=$mysqli->fetchAll($sql);
    return $rows;
}

/**
 * 添加班级
 * @return string
 */
function addClass(){
    $mysqli = new DbOperat();
    $arr = $_POST;
    if($mysqli->insert("stu_class",$arr)){
        $mes="添加成功!<br/><a href='addClass.php'>继续添加</a>|<a href='listClass.php'>查看班级列表</a>";
    }else{
        $mes="添加失败!<br/><a href='addClass.php'>重新添加</a>";
    }
    return $mes;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editClass($id){
    $mysqli = new DbOperat();
    $arr=$_POST;
    if($mysqli->update("stu_class", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listClass.php'>查看班级列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listClass.php'>请重新修改</a>";
    }
    return $mes;
}

/**
 * 添加班级
 * @param $id
 * @return string
 */
function delClass($id) {
    $mysqli = new DbOperat();
    if($mysqli->delete("stu_class","id={$id}")){
        $mes="删除成功!<br/><a href='listClass.php'>查看班级列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listClass.php'>请重新删除</a>";
    }
    return $mes;
}

function addStudent() {
    $arr = $_POST;
    $addTime = strtotime(date("Y-m-d"));
    $arr['sRegTime'] = strtotime($arr['sRegTime']);
    $mysqli = new DbOperat();
    $arr2 = array(
        'addTime' => $addTime,
    );
    $arr = array_merge($arr, $arr2);
    if($mysqli->insert("stu_list",$arr)){
        $mes = array(
            'status' => 1,
            'mes' => '添加成功'
        );
    }else{
        $mes = array(
            'status' => 0,
            'mes' => '添加失败'
        );
    }
    return $mes;
}

function getStuByPage($page,$pageSize=2, $sql, $where = null){
    $mysqli = new DbOperat();
    global $totalRows;
    $totalRows=$mysqli->getResultNum($sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    if (empty($where)) {
        $sql="select * from stu_list limit {$offset},{$pageSize}";
    } else {
        $sql = "select * from stu_list {$where} limit {$offset},{$pageSize}";
    }
    $rows=$mysqli->fetchAll($sql);
    return $rows;
}

function editStudent($id) {
    $mysqli = new DbOperat();
    $arr=$_POST;
    $arr['sRegTime'] = strtotime($arr['sRegTime']);
    if($mysqli->update("stu_list", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listStudent.php'>查看学生列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listStudent.php'>请重新修改</a>";
    }
    return $mes;
}

/**
 * 删除学生
 * @param $id
 * @return string
 */
function delStudent($id) {
    $mysqli = new DbOperat();
    if($mysqli->delete("stu_list","id={$id}")){
        $mes="删除成功!<br/><a href='listStudent.php'>查看学生列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listStudent.php'>请重新删除</a>";
    }
    return $mes;
}

function getRegTime() {
    $mysqli = new DbOperat();
    $sql = "select sRegTime from stu_list";
    $rows = $mysqli->fetchAll($sql);
    return $rows;
}
