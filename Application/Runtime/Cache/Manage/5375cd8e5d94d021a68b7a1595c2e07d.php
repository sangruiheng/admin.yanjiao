<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
var URL = '/manage.php/Product';
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
		<a class="navbar-brand" href="#">商品管理</a>
	</div>
	<div>
		<button type="button" class="btn btn-danger navbar-btn listButton" onclick="deleteProduct('product')"><i class="fa fa-trash-o" aria-hidden="true"></i> 删除</button>
		<button type="button" class="btn btn-info navbar-btn listButton" onclick="editData('addProduct')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 修改</button>
		<button type="button" class="btn btn-success navbar-btn listButton" onclick="openAddData('addProduct')"><i class="fa fa-plus" aria-hidden="true"></i> 新建</button>
		<form class="navbar-form navbar-right listSearch" role="search" method="get" action="/manage.php/Product/productList">

			<div class="form-group">
				<input name="keyWord" type="text" class="form-control" id="keyWord" placeholder="请输入关键词进行搜索" value="<?php echo ($search["keyWord"]); ?>" >
			</div>
			商家名称：<select name="business_id" id="business_id" class="form-control">
			<option value="">---请选择---</option>
			<?php if(is_array($business)): $i = 0; $__LIST__ = $business;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($search['business_id']==$vo['id']) {echo 'selected';} ?> ><?php echo ($vo["business_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
			<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> 搜索</button>
		</form>
		<button type="button" class="btn btn-primary" onclick="javascript:if(confirm('由于数据存在关联查询，导出Exce可能需要1-3分钟的时间，确定要导出吗（确定后请勿刷新页面或关闭浏览器）?'))location='/manage.php/Product/exportExcel?business_id=<?php echo ($search["business_id"]); ?>'"><i class="fa fa-sign-in" aria-hidden="true"></i> 导出Excel</button> &nbsp;
	</div>
</nav>

<div class="list-box">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead>
		<tr>
			<th>选择</th>
			<th>编号</th>
			<th>商品名称</th>
			<th>所属分类</th>
			<th>商品类型</th>
			<th>商家名称</th>
			<th>商家电话</th>
			<th>积分额度</th>
			<th>商品缩略图</th>
			<th>推荐到首页</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><input type="checkbox" name="del_listID" id="del_listID" data-name="multi-select" value="<?php echo ($vo["id"]); ?>" /></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["product_name"]); ?></td>
				<td><?php echo ($vo["navCategory"]["navcate_name"]); ?></td>
				<td><?php echo ($vo["product_type"]); ?></td>
				<td><?php echo ($vo["business"]["business_name"]); ?></td>
				<td><?php echo ($vo["business"]["business_tel"]); ?></td>
				<!--<td><?php echo ($vo["product_stock"]); ?>件</td>-->
				<!--<td><?php echo ($vo["product_freight"]); ?>元</td>-->
				<td><?php echo ($vo["product_bounds"]); ?>分</td>
				<td>
					<?php if(is_array($vo["productimage"])): $i = 0; $__LIST__ = $vo["productimage"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; if($item["is_thumb"] == 1): ?><img  src="/Uploads/Manage/<?php echo $item['productimage_url']?>" width="100" height="100" class="newsimgs" alt="图片未找到" style="padding: 5px"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</td>
				<td class="status"><?php echo statusInfo('product',$vo['id'],$vo['status'],'未推荐','已推荐');?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>

<ul class="pagination">
	<?php echo ($page); ?>
</ul>
<script src="/Public/Manage/js/status/status.js"></script>
</body>
</html>