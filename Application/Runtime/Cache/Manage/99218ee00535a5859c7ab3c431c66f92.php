<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>
    <!--公共css-->
<link rel="stylesheet" type="text/css" href="/Public/Manage/tools/bootstrap-3.2.0-dist/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Manage/css/fontIcon/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="/Public/Manage/css/common/common.css" />
<link rel="stylesheet" type="text/css" href="/Public/Manage/css/alert.css" />
<link rel="stylesheet" type="text/css" href="/Public/Manage/tools/iCheck/flat/blue.css" />
<link rel="stylesheet" type="text/css" href="/Public/Manage/js/tools/icpntDialog/css/icpntDialog.css" />
<!--公共js-->
<script type="text/javascript" src="/Public/Manage/js/common/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/Public/Manage/js/common/jquery.form.js"></script>
<script type="text/javascript" src="/Public/Manage/tools/bootstrap-3.2.0-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="/Public/Manage/tools/Validform_v5.3.2/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="/Public/Manage/js/tools/icpntDialog/js/icpntDialog.js"></script>
<script type="text/javascript" src="/Public/Manage/tools/iCheck/icheck.js"></script>
<script type="text/javascript" src="/Public/Manage/js/common/common.js"></script>
<script type="text/javascript" src="/Public/Manage/postInfo/postInfo.js"></script>
<script>
//定义ThinkPHP模板常量，方便在js中使用
var APP = '/manage.php';
var PUBLIC = '/Public/Manage';
var URL = '/manage.php/News';
var CONTROLLER_NAME = '<?php echo (CONTROLLER_NAME); ?>';
var ACTION_NAME = '<?php echo (ACTION_NAME); ?>';
var GROUPID = '<?php echo ($_SESSION['crm_rules']); ?>';
var AUTH_ADD_ID = '<?php echo C('AUTH_MODULE.auth_add_id');?>';
var AUTH_DEL_ID = '<?php echo C('AUTH_MODULE.auth_del_id');?>';
var AUTH_SAVE_ID = '<?php echo C('AUTH_MODULE.auth_save_id');?>';
var AUTH_USER_ID = '<?php echo C('AUTH_MODULE.auth_user_id');?>';
var AUTH_GROUP_ID = '<?php echo C('AUTH_MODULE.auth_group_id');?>';
var PAGE = '<?php echo ($_GET['p']); ?>';
var KEYWORD = '<?php echo ($_GET['keyWord']); ?>';
$(document).ready(function(e) {
    $('input[data-name=multi-select]').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass: 'iradio_flat-blue'
	});
	
});
</script>
    <link rel="stylesheet" type="text/css" href="/Public/Manage/css/common/rightCommon.css" />

    <script type="text/javascript" src="/Public/Manage/tools/ueditor1_4_3-utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" src="/Public/Manage/tools/ueditor1_4_3-utf8-php/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/Public/Manage/tools/ueditor1_4_3-utf8-php/lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Manage/tools/webuploader-0.1.5/dist/webuploader.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Manage/tools/webuploader-0.1.5/examples/image-upload/style.css" />


    <script>
        $(document).ready(function (e) {
            if ($("#id").val() == '') {
                var ue = UE.getEditor('content');
            }
            getEditData(function (e) {
                var ue = UE.getEditor('content');  //编辑器

                var uploadImg = '';
                var uploadImg2 = '';
                uploadImg += '<div class="upload-listDiv">';
                uploadImg += '<img src="/Uploads/Manage/' + e.image + '" width="120" height="120">';
                uploadImg += '<div class="upload-ldButton" data-url="' + e.image+ + '">';
                // uploadImg += '<button type="button" onclick="javascript:delImg(this)" name="' + e.id + '" title="删除图片" class="btn btn-default upload-delete" ><i class="fa fa-trash-o"></i></button>';
                uploadImg += '<a class="btn btn-defaule upload-select" style="float:left"><i class="fa fa-book" aria-hidden="true"></i> 封面图片</a >';
                uploadImg += '</div>';
                uploadImg += '</div>';
                $('div#imgShow').append(uploadImg);

            });

        });
    </script>

    <style>
        .uploadify-button {
            height: 30px;
            line-height: 30px;
            width: 120px;
            border-radius: inherit;
            background: #5cb85c;
            border: none;
            font-family: '宋体';
        }

        .lable_id {
            float: left;
            margin: auto 17px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #ccc;
            height: 34px;
            line-height: 34px;
            padding-left: 12px;
            padding-right: 12px;
            cursor: pointer;
        }

        .addForm tr td .on {
            background-color: #449d44;
            color: #fff;
        }

        .fenlei_id {
            float: left;
            margin: auto 17px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #ccc;
            height: 34px;
            line-height: 34px;
            padding-left: 12px;
            padding-right: 12px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<!--alert弹窗Start  -->
<div id="top-alert" class="fixed alert alert-error" style="display:none;">
    <button class="close fixed" style="margin-top: 4px;">&times;</button>
    <div class="alert-content">这是内容</div>
</div>
<!--alert弹窗end  -->
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#"><i class="fa fa-plus" aria-hidden="true"></i> <span id="changeTitle">添加</span>新闻</a>
    </div>
</nav>

<div class="add-box">
    <form class="addForm ajax-fadein" id="form1" name="form1" method="post"
          action="/manage.php/Banner/addBannerData/controller/News/backUrl/newsList/table/news">
        <input name="id" type="hidden" id="id" value="<?php echo ($_GET['id']); ?>"/>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>

            <tr>
                <td align="center">新闻类型</td>
                <td><select name="newstypeID" id="newstypeID" class="form-control">
                    <option value="">--请选择--</option>
                    <?php foreach($newstypeList as $key=>$value){ ?>
                    <option value="<?php echo $value['id']?>"><?php echo $value['typeName']?></option>
                    <?php } ?>
                </select></td>
            </tr>

            <tr>
                <td align="center">新闻标题</td>
                <td><input type="text" name="title" id="title" class="form-control" placeholder="请输入新闻标题"/></td>
            </tr>

            <tr>
                <td align="center">新闻缩略图<font color="red">&nbsp;&nbsp;*</font><br/><font color="#e61111" class="imgSize">240*180</font></td>
                <td style="padding:0px;">
                    <div id="uploader">
                        <div class="queueList">
                            <div id="dndArea" class="placeholder">
                                <div id="filePicker"></div>
                                <p>或将照片拖到这里，只能选择一张</p>
                            </div>
                        </div>
                        <div class="statusBar" style="display:none;">
                            <div class="progress"><span class="text">0%</span><span class="percentage"></span></div>
                            <div class="info"></div>
                            <div class="btns">
                                <div id="filePicker2"></div>
                                <div class="uploadBtn">开始上传</div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>


            <tr>
                <td align="center">已上传头图</td>
                <td>
                    <div id="imgShow">

                    </div>
                    <div id="imgShow1">

                    </div>
                    <input name="listCover" type="hidden" id="listCover" datatype="*" nullmsg="请上传图片并设置列表封面" value=""/>
                    <input name="bannerImg" type="hidden" id="bannerImg" datatype="*" nullmsg="请上传图片并设置Banner头图"/>
                </td>
            </tr>





            <tr>
                <td align="center">新闻内容<font color="red">&nbsp;&nbsp;*</font></td>
                <td colspan="3"><textarea name="content" id="content" cols="45" rows="5"
                                          style="width:100%;height:200px; margin:10px 0px;"></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="btn btn-success ajax-post" type="submit" id="saveButton"
                            target-form="form-horizontal"><i class="fa fa-check" aria-hidden="true"></i> 添加
                    </button>
                    <button type="button" class="btn btn-default" id="cancelButton"><i class="fa fa-times"
                                                                                       aria-hidden="true"></i> 取消
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

<script type="text/javascript" src="/Public/Manage/tools/webuploader-0.1.5/dist/webuploader.js"></script>
<script type="text/javascript" src="/Public/Manage/tools/webuploader-0.1.5/examples/image-upload/upload1.js"></script>


<script>




    function addCallback() {
        var imgNameVal = $('#listCover').val();
        var imgNameVal2 = $('#bannerImg').val();
        if (imgNameVal != '' && imgNameVal2 != '') {
            alert('为了节省服务器资源，请先删除现有图片！');
            return false;
        }

    }

    function uploadCallback(response) {
        var UrlHtml = '<input type="hidden" name="hid[]" value="/Uploads/Manage/' + response.url + '">';
        $('div#imgShow1').append(UrlHtml);
        //设为列表封面
        $('.upload-listCover').click(function () {
            var imgUrl = $(this).parent('div.upload-ldButton').attr('data-url');
            $(this).siblings('a.upload-select').html('<i class="fa fa-book" aria-hidden="true"></i> 列表封面');
            $('#listCover').val(imgUrl);
        });
        //设为详情页头图
        $('.upload-detailsImg').click(function () {
            var imgUrl = $(this).parent('div.upload-ldButton').attr('data-url');
            $(this).siblings('a.upload-select').html('<i class="fa fa-picture-o" aria-hidden="true"></i> 详情页头图');
            $('#bannerImg').val(imgUrl);
        });
    }
</script>

<!--<script>-->

    <!--$('#filePicker2').click(function () {-->
        <!--var aaa = $('.success').length;-->
        <!--if(aaa >= 1){-->
            <!--alert('只能上传一张');-->
            <!--$('.btns').hide();-->
            <!--return false;-->
        <!--}-->
    <!--});-->

    <!--$('.uploadBtn').click(function () {-->
        <!--var aaa = $('.filelist li').length;-->
        <!--if(aaa > 1){-->
            <!--alert('只能上传一张1');-->
            <!--window.location.reload();-->
        <!--}-->
    <!--});-->
<!--</script>-->




</body>
</html>