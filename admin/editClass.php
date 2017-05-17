<?php
require_once '../include.php';
$mysqli = new DbOperat();
$id=$_REQUEST['id'];
$sql="select id,sId,cName from stu_class where id='{$id}'";
$row=$mysqli->fetchOne($sql);
$schools = listSchool();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<h3>编辑班级</h3>
<form action="doAdminAction.php?act=editClass&id=<?php echo $id;?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">班级名称</td>
            <td><input type="text" name="cName" placeholder="<?php echo $row['cName'];?>"/></td>
        </tr>
        <tr>
            <td align="right">系别</td>
            <td>
                <select name="sId">
                    <?php  foreach($schools as $sc):?>
                        <option value="<?php echo $sc['id'];?>"><?php echo $sc['sName'];?></option>
                    <?php  endforeach;?>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit"  value="编辑班级"/></td>
        </tr>

    </table>
</form>
</body>
</html>