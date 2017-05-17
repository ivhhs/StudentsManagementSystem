<?php
include_once "../include.php";
$rows = listSchool();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>

</head>
<body>
<h3>添加班级</h3>
<form action="doAdminAction.php?act=addClass" method="post" enctype="multipart/form-data">
    <table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">班级名称</td>
            <td><input type="text" name="cName"  placeholder="请输入班级名称"/></td>
        </tr>
        <tr>
            <td align="right">系别</td>
            <td>
                <select name="sId">
                    <?php  foreach($rows as $row):?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['sName'];?></option>
                    <?php  endforeach;?>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit"  value="确认添加"/></td>
        </tr>
    </table>
</form>
</body>
</html>