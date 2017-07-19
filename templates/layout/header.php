<?php
	$d->reset();
	$sql_list ="select *	from #_product_list order by stt asc limit 0,5";
	$d->query($sql_list);
	$list =$d->result_array();
	
	$d->reset();
	$sql_tin_l ="select *	from #_tinloai1_1_list order by stt asc limit 0,3";
	$d->query($sql_tin_l);
	$tin_l=$d->result_array();
?>

<div id="header">
		<div class="header"> <!--Thay class container bằng class header-->
        	<div class="container"> <!--Add thêm div -->
			
			<a href="index.html" class="logo" ><img src="images/logo.png" alt=""  ></a>
			<div class="">
				<div class="menu-header">
				<div class="toogle-menu toggle-menu-top">
					MENU
					<a href="#">
						<span></span>
						<span></span>
						<span></span>
					</a>
				</div>
				<?php include _template."layout/menu_top.php"; ?>
				</div>
			</div>
			</div>
			<div class="clear"></div>
			 
		</div>
    </div><!--header-->