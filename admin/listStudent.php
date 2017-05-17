<?php
require_once '../include.php';

if (isset($_REQUEST['keywords']) && $_REQUEST['keywords'] != null) {
    $keywords = $_REQUEST['keywords'];
    if ( preg_match("/^[\x{4e00}-\x{9fa5}]{1,4}/u", $keywords)) {
        $where = $keywords ? "where sName like '%{$keywords}%'" : null;
        $sql = "select * from stu_list {$where}";
    } elseif ( ($keywords >= 0 && $keywords <= 3)) {
        $school = $_REQUEST['f'];
        $where = "where sId={$keywords}";
        $sql = "select * from stu_list {$where}";
    } elseif ( preg_match('/\d{4}/', $keywords)) {
        $strYear = $keywords . '-01-01';
        $endYear = $keywords . '-12-31';
        $where = "where sRegTime>=UNIX_TIMESTAMP('{$strYear}') AND sRegTime<=UNIX_TIMESTAMP('{$endYear}')";
        $sql = "select * from stu_list {$where}";
    }
} elseif($_REQUEST['class']) {
    $keywords = $_REQUEST['class'];
    $where = "where cId={$keywords}";
    $sql = "select * from stu_list {$where}";

} elseif ($_REQUEST['keywords'] == null) {
        $sql = "select * from stu_list";
        $where = null;
} elseif (!(isset($_REQUEST['keywords']))) {
    $sql = "select * from stu_list";
    $where = null;
}

$pageSize=5;
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getStuByPage($page,$pageSize,$sql,$where);

$school = listSchool();
$class = listClass();


if(!$rows){
    alertMes("sorry,没有学生注册,请添加!","addStudent.php");
    exit;
}


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="styles/backstage.css">
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addStu()">
        </div>

        <div class="text">
            <span>搜索</span>
            <input type="text" value="" class="search"  id="search" onkeypress="search()" placeholder="请输入学生姓名">
        </div>

        <div class="text">
            <span>按系</span>
            <select name="school" id="school" onchange="listschool()">
                <option value="">请选择系名</option>
                <?php foreach ($school as $sch ): ?>
                    <option value="<?php echo $sch['id']; ?>"><?php echo $sch['sName']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text">
            <span>按班级</span>
            <select name="class" id="class" onchange="listclass()">
                <option value="">请选择班级</option>
                <?php foreach ($class as $cla ): ?>
                    <option value="<?php echo $cla['id']; ?>"><?php echo $cla['cName']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text">
            <span>入学年份</span>
            <input type="text" value="" class="search"  id="year" onkeypress="searchyear()" placeholder="请输入学年">
        </div>
    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="12%">学号</th>
            <th width="12%">学生姓名</th>
            <th width="12%">性别</th>
            <th width="12%">系</th>
            <th width="12%">班级</th>
            <th width="12%">地址</th>
            <th width="12%">注册时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($rows as $row):?>
            <tr>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check" name="id"><label for="c1" class="label"><?php echo $row['sNumber'];?></label></td>
                <td><?php echo $row['sName'];?></td>
                <td><?php echo $row['sSex'];?></td>
                <td>
                    <input type="text" name="school" style="display: none" value="<?php echo $row['sId']; ?>">
                    <?php
                        foreach ($school as $sch ):
                            if ($sch['id'] == $row['sId']) echo $sch['sName'];
                        endforeach;
                    ?>
                </td>
                <td>
                    <input type="text" name="class" style="display: none" value="<?php echo $row['sId']; ?>">
                    <?php
                        //echo $row['sId'] .'~'. $row['cId'];
                        $class = listClass($row['sId'], $row['cId']);
                        echo $class['cName'];
                    ?>
                </td>
                <td><?php echo $row['sAddress'];?></td>
                <td><?php echo date("Y-m-d", $row['sRegTime']);?></td>
                <td align="center"><input type="button" value="修改" class="btn" onclick="editStu(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"  onclick="delStu(<?php echo $row['id'];?>)"></td>
            </tr>
        <?php endforeach;?>
        <?php if($totalRows>$pageSize):?>
            <tr>
                <td colspan="8">
                    <?php
                        if ($_REQUEST['class']) {
                            echo showPage($page, $totalPage,"class={$keywords}");
                        } elseif ($_REQUEST['keywords'] || $_REQUEST['keywords'] == null) {
                            echo showPage($page, $totalPage,"keywords={$keywords}");
                        } elseif ($keywords>=0 && $keywords <= 3) {
                            echo showPage($page, $totalPage,"keywords={$keywords}");
                        }

                    ?>
                </td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">

    function addStu(){
        window.location="addStudent.php";
    }
    function editStu(id){
        window.location="editStudent.php?id="+id;
    }
    function delStu(id){
        if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
            window.location="doAdminAction.php?act=delStudent&id="+id;
        }
    }
    function search() {
        if (event.keyCode == 13) {
            var val=document.getElementById("search").value;
            window.location="listStudent.php?keywords="+val;
        }
    }

    function listschool() {
        var val = $('#school option:selected').val();
        window.location="listStudent.php?keywords="+val;
    }

    function listclass() {
        var val = $('#class option:selected').val();
        console.log(val);
        window.location="listStudent.php?class="+val;
    }

    function searchyear() {
        if (event.keyCode == 13) {
            var val = document.getElementById("year").value;
            console.log(val);
            window.location="listStudent.php?keywords="+val;
        }
    }
</script>
</html>