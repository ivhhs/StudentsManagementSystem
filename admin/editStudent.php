<?php
/**
 * Created by PhpStorm.
 * User: liwei
 * Date: 2017/5/12
 * Time: 19:10
 */
require_once '../include.php';
$mysqli = new DbOperat();
$id=$_REQUEST['id'];
$sql="select sName,sId,cId,sSex,sAddress,sRegTime from stu_list where id='{$id}'";
$row=$mysqli->fetchOne($sql);

$school = "select * from stu_school";
$schools = $mysqli->fetchAll($school);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.css">
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.js"></script>
</head>
<body>
<h3>编辑学生</h3>
<form action="doAdminAction.php?act=editStudent&id=<?php echo $id;?>" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">学生姓名</td>

            <td><input type="text"  name="sName" value="<?php echo $row['sName']; ?>" placeholder="<?php echo $row['sName']; ?>"/></td>
        </tr>
        <tr>
            <td align="right">系别</td>
            <td>
                <select name="sId" id="schools">
                    <?php  foreach($schools as $sc):?>
                        <option value="<?php echo $sc['id'];?>" <?php if ($sc['id'] == $row['sId'] ) echo "selected"; ?>><?php echo $sc['sName'];?></option>
                    <?php  endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">班级名</td>
            <td>
                <select name="cId" id="class">

                </select>
            </td>
        </tr>
        <tr>
            <td align="right">性别</td>
            <td>
                <input type="radio" <?php if($row['sSex'] == '男') echo "checked"; ?> name="sSex" value="男">男
                <input type="radio" <?php if($row['sSex'] == '女') echo "checked"; ?> name="sSex" value="女">女
            </td>
        </tr>
        <tr>
            <td align="right">地址</td>
            <td>
                <input type="text" name="sAddress" placeholder="<?php echo $row['sAddress']; ?>" value="<?php echo $row['sAddress']; ?>">
            </td>
        </tr>
        <tr>
            <td align="right">入学时间</td>
            <td>
                <div class="am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm-dd', viewMode: 'years'}">
                    <input type="text" class="am-form-field" name="sRegTime" value="<?php echo date("Y-m-d", $row['sRegTime']); ?>"  readonly>
                    <span class="am-input-group-btn am-datepicker-add-on">
    <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
  </span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit"  value="编辑"/></td>
        </tr>

    </table>
</form>
</body>
<script type="text/javascript">
    (function () {
        var school = $('#schools').change(function() {
            getClass();
        });
        var school = $('#schools').ready(function() {
            getClass();
        });
    })();
    function getClass() {
        var sId = $('#schools').children('option:selected').val();
        var handleUrl = "doAdminAction.php";
        var html = '';
        console.log(sId);
        $.ajax({
            url: handleUrl,
            data: {
                act: 'getClass',
                id: sId
            },
            dataType: 'json',
            type: 'get',
            success: function(result) {
                $.each(result, function(idx, v) {
                    html += '<option value="' + v.id + '">' + v.cName + '</option>';
                    $('#class').html(html);
                });
            }
        });
    }
</script>
</html>