<?php
	$d->reset();
	$sql_list ="select *	from #_product_list where hienthi=1 order by stt asc limit 0,8";
	$d->query($sql_list);
	$list =$d->result_array();
?>

<ul id="menu-danh-muc-san-pham" class="">
	<li id="menu-item-226" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-226">
	<a href="index.html">
	Giới thiệu</a>
	</li>
	<li id="menu-item-226" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-226">
		<a href="#">
	sản phẩm nội thất</a>
	<ul class="sub-menu">
		<?php
		for($i=0,$count_l=count($list);$i<$count_l;$i++){
			$d->reset();
			$sql_cat ="select *	from #_product_cat where id_list='".$list[$i]["id"]."' order by stt asc";
			$d->query($sql_cat);
			$cat =$d->result_array();
			$child = 'class="dropdown"';
			$taga	= '<i class="fa fa-angle-down"></i>';
			$href = 'danh-muc-list/'.$list[$i]["tenkhongdau"].'-'.$list[$i]["id"].'.html';
			$toggle ='class="dropdown-toggle" data-toggle="dropdown"';
			if(count($cat)<1)
			{
			$href = 'danh-muc-list/'.$list[$i]["tenkhongdau"].'-'.$list[$i]["id"].'.html';	
				$child = "";
				$taga = "";
				$toggle='';
			}
		 ?>
		<li id="menu-item-226" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-226">
			<a href="<?php echo $href;?>">
		<?=$list[$i]["ten_vi"]?>
		</a>
		<?php }?>
		</li>
	</ul>
	</li>
	<li id="menu-item-226" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-226">
	<a href="http://homedecor.info.vn/danh-muc/nha-pho-2.html" target="_blank">
	Dịch vụ thiết kế</a>
	</li>
	<li id="menu-item-226" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-226">
	<a href="http://homedecor.info.vn/lien-he.html" target="_blank">
	Liên hệ</a>
	</li>
</ul>
