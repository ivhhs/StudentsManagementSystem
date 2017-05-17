<?php
require_once "../include.php";
$mysqli = new DbOperat();
$school = listSchool();
$classes = listClass();
$sql = "select max(id) from stu_list";
$sNumber = $mysqli->fetchOne($sql);
$sNumber = $sNumber['max(id)']+1;
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
<h3>学籍注册</h3>
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">学生姓名</td>
            <input type="text" name="sNumber" value="<?php echo $sNumber; ?>" style="display: none;">
            <td><input type="text"  name="sName" placeholder="请输入学生姓名"/></td>
        </tr>
        <tr>
            <td align="right">系别</td>
            <td>
                <select name="sId" id="schools">
                    <?php  foreach($school as $row):?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['sName'];?></option>
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
                <input type="radio" checked="checked" name="sSex" value="男">男
                <input type="radio" name="sSex" value="女">女
            </td>
        </tr>
        <tr>
            <td align="right">地址</td>
            <td>
                <input type="text" name="sAddress">
            </td>
        </tr>
        <tr>
            <td align="right">入学时间</td>
            <td>
                <div class="am-input-group am-datepicker-date" data-am-datepicker="{format: 'yyyy-mm-dd', viewMode: 'years'}">
                    <input type="text" class="am-form-field" placeholder="日历组件" name="sRegTime" readonly>
                    <span class="am-input-group-btn am-datepicker-add-on">
    <button class="am-btn am-btn-default" type="button"><span class="am-icon-calendar"></span> </button>
  </span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><button id="submit">添加</button></td>
        </tr>

    </table>

<script type="text/javascript">
    (function () {
        var school = $('#schools').change(function() {
            getClass();
        });
        var school = $('#schools').ready(function() {
            getClass();
        });
        $('#submit').click(function () {
            var flag = checkForm();
            if (flag == 0) {
                return;
            }
            var sName = $("input[name='sName']").val();
            var sId = $('#schools').children('option:selected').val();
            var cId = $('#class').children('option:selected').val();
            var sSex = $("input[name='sSex']").val();
            var sAddress = $("input[name='sAddress']").val();
            var sRegTime = $("input[name='sRegTime']").val();
            var sNumber = $("input[name='sNumber']").val();
            var tmp = addPreZero(sId) + addPreZero(cId) + addPreZero(sNumber);
            sNumber = sRegTime.substr(0, 4) + tmp;

            var handleUrl = 'doAdminAction.php?act=addStudent';
            $.ajax({
                url: handleUrl,
                data: {
                    sName: sName,
                    sId: sId,
                    cId: cId,
                    sSex: sSex,
                    sAddress: sAddress,
                    sRegTime: sRegTime,
                    sNumber: sNumber
                },
                dataType : 'json',
                type: 'post',
                success: function(result) {
                    alert(result.mes);
                    window.location.href = "addStudent.php";
                }
            });
        });

    })();

    function addPreZero(num){
        if(num<10){
            return '00'+num;
        }else if(num<100){
            return '0'+num;
        }else{
            return num;
        }
    }

    function getClass() {
        var sId = $('#schools').children('option:selected').val();
        var handleUrl = "doAdminAction.php";
        var html = '';
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

    function checkForm () {
        var sname = $("input[name='sName']");
        var address = $("input[name='sAddress']");
        var regtime = $("input[name='sRegTime']");
        if ( sname.val() == '') {
            alert("请输入学生姓名!");
            sname.focus();

            return 0;
        }
        if ( address.val() == '') {
            alert("请输入学生地址!");
            address.focus();
            return 0;
        }
        if ( regtime.val() == '' ) {
            alert("请输入入学时间!");
            regtime.focus();
            return 0;
        }
    }


</script>
</body>
</html>