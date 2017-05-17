<?php
require_once "../include.php";
$pageSize=5;
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getClassByPage($page,$pageSize);
if(!$rows){
    alertMes("sorry,没有班级,请添加!","addClass.php");
    exit;
}

$schools = listSchool();

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="styles/backstage.css">
    <link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
    <script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<br>
<div id="showDetail">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addClass()">
        </div>

    </div>
</div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="10%">班号</th>
            <th width="20%">班级名称</th>
            <th width="20%">所在系别</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($rows as $row):?>
            <tr>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                <td><?php echo $row['cName'];?></td>
                <td><?php
                        foreach ($schools as $sc):
                            if ($row['sId'] == $sc['id'])
                                echo $sc['sName'];
                        endforeach;
                    ?>
                </td>
                <td align="center"><input type="button" value="修改" class="btn" onclick="editClass(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"  onclick="delClass(<?php echo $row['id'];?>)"></td>
            </tr>
        <?php endforeach;?>
        <?php if($totalRows>$pageSize):?>
            <tr>
                <td colspan="4"><?php echo showPage($page, $totalPage);?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">

    function addClass(){
        window.location="addClass.php";
    }
    function editClass(id){
        window.location="editClass.php?id="+id;
    }
    function delClass(id){
        if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
            window.location="doAdminAction.php?act=delClass&id="+id;
        }
    }
</script>
</html>