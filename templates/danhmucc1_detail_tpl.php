<?php 
            $id =  addslashes($_GET['id']);
			$d->reset();
			$order = isset($_GET['order']) ? 'order by gia '.$_GET['order'] : 'order by stt asc';
			$sql_tungdanhmuc="select * from #_product where hienthi =1 and id_list='$id' ".$order;
			$d->query($sql_tungdanhmuc);	
			$result_spnam=$d->result_array();	
			
			$d->reset();
			$sql_laylist="select * from #_product_list where hienthi =1 and id='$id'";
			$d->query($sql_laylist);	
			$result_laylist=$d->fetch_array();	
			
			
						
			$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
			$url=getCurrentPageURL();
			$maxR=30;
			$maxP=5;
			$paging=paging_home($result_spnam , $url, $curPage, $maxR, $maxP);
			$result_spnam=$paging['source'];
            
			
			$total_sp = count($result_spnam);
?>
<script>
function orderajax(){
	var order =  $('#orderby').val();
	var phongcach =  $('#phongcach').val();
	var xuatxu =  $('#xuatxu').val();
    $.ajax({
        url	    : "danhmuc_ajax_tpl.php",
        type		: "POST",
        data		: {id: <?php echo $id;?>, order: order ,phongcach: phongcach ,xuatxu: xuatxu},
        success	: function(data) {
	        $(".products").html(data);
	        }
         });
};
$(document).ready(function() {
    $(".vungphongcach").on('click', '.check', function(e) {
    	$(this).parents('.vungphongcach').find(".active").removeClass("active");
    	$(this).find(".checked").addClass("active");
    });
    $(".vungxuatxu").on('click', '.check', function(e) {
    	$(this).parents('.vungxuatxu').find(".active").removeClass("active");
    	$(this).find(".checked").addClass("active");
    });
});

function changephongcach(value){
	$('#phongcach').val(value);
	orderajax();
};

function changexuatxu(value){
	$('#xuatxu').val(value);
	orderajax();
};
</script>
	<!-- start header -->
<input type="hidden" id="phongcach" />
<input type="hidden" id="xuatxu" />
<div class="brackcum">
	<div class="container">
     <!-- Breadcrumb NavXT 5.3.0 -->
<span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" title="Go to ." href="index.html" class="home">Trang chủ</a>
</span>
<span typeof="v:Breadcrumb">
<span property="v:title"><?php echo $result_laylist['ten_vi'];?></span>
</span>	</div>
</div>	
<div id="content" class="archive">
	<div class="container">
    <a href="#" class="yf-mob-filter">Hiển thị bộ lọc</a>
		<div class="left">
			<div class="filter">
				<h4>Phong cách:</h4>
				<ul class="filter_ul vungphongcach">
					<li class="phongcach" ><a onclick="changephongcach('all')" class="check"><p class="checked active"><span></span></p>Tất cả</a></li>
											<li class="phongcach"><a class="check" onclick="changephongcach('co-dien')"><p class="checked"><span></span></p>Cổ điển</a></li>
											<li class="phongcach"><a class="check" onclick="changephongcach('hien-dai')"><p class="checked"><span></span></p>Hiện đại</a></li>
											<li class="phongcach"><a class="check" onclick="changephongcach('sang-tao')"><p class="checked"><span></span></p>Sáng tạo</a></li>
											<li class="phongcach"><a class="check" onclick="changephongcach('sang-trong')"><p class="checked"><span></span></p>Sang trọng</a></li>
											<li class="phongcach"><a class="check" onclick="changephongcach('tre-trung')"><p class="checked"><span></span></p>Trẻ trung</a></li>
									</ul>
			</div>
			<div class="filter">
				<h4>Xuất xứ:</h4>
				<ul class="filter_ul vungphongcach">
					<li><a class="check" onclick="changexuatxu('all')"><p class="checked active"><span></span></p>Tất cả</a></li>
											<li><a class="check" onclick="changexuatxu('chau-au')"><p class="checked"><span></span></p>Châu Âu</a></li>
											<li><a class="check" onclick="changexuatxu('dai-loan')"><p class="checked"><span></span></p>Đài Loan</a></li>
											<li><a class="check" onclick="changexuatxu('duc')"><p class="checked"><span></span></p>Đức</a></li>
											<li><a class="check" onclick="changexuatxu('han-quoc')"><p class="checked"><span></span></p>Hàn Quốc</a></li>
											<li><a class="check" onclick="changexuatxu('italia')"><p class="checked"><span></span></p>Italia</a></li>
											<li><a class="check" onclick="changexuatxu('malaysia')"><p class="checked"><span></span></p>Malaysia</a></li>
											<li><a class="check" onclick="changexuatxu('nhat-ban')"><p class="checked"><span></span></p>Nhật Bản</a></li>
											<li><a class="check" onclick="changexuatxu('trung-quoc')"><p class="checked"><span></span></p>Trung Quốc</a></li>
											<li><a class="check" onclick="changexuatxu('viet-nam')"><p class="checked"><span></span></p>Việt Nam</a></li>
									</ul>
			</div>
		</div>
		<div class="right">
			
			<div class="title">
				<h2>Danh sách sản phẩm</h2>
				<div class="title_right">
					<span class="count">(Tìm thấy <?php echo count($result_spnam);?> sản phẩm)</span>
					<span class="orderby">Sắp xếp theo: 
						<select id="orderby" onchange="orderajax()">
							<option value="" selected="selected">Mặc định</option>
							<option value="desc">Giá từ cao đến thấp</option>
							<option value="asc">Giá từ thấp đến cao</option>
						</select>
					</span>
				</div>
				<div class="clear"></div>
							</div>
			<div class="products">
			<?php
			for ($i=0;$i<count($result_spnam);$i++)
			{ 
			?>
				<div class="item-content">
						<div class="item" style="height: 285px;">	
							<a href="chi-tiet-san-pham/<?=$result_spnam[$i]['tenkhongdau']?>-<?=$result_spnam[$i]['id']?>.html" class="thumbnail">
								<img src="upload/sanpham/<?php if($result_spnam[$i]["tc_big"]==1) echo $result_spnam[$i]["photo"]; else echo $result_spnam[$i]["photo"] ?>" alt="<?=$result_spnam[$i]["ten_vi"]?>">
									<img src="upload/sanpham/<?php if($result_spnam[$i]["tc_big"]==1) echo $result_spnam[$i]["photo"]; else echo $result_spnam[$i]["photo"] ?>" alt="<?=$result_spnam[$i]["ten_vi"]?>" class="phoicanh">
																                							</a>
							<div class="text">
								<h3><a href="chi-tiet-san-pham/<?=$result_spnam[$i]['tenkhongdau']?>-<?=$result_spnam[$i]['id']?>.html"><?=$result_spnam[$i]["ten_vi"]?></a></h3>
								<!--<h4>Mã SP: </h4>
																	<table class="shop_attributes">
										<tbody>
											<tr>
												<th>Kích thước</th>
												<td><p>
																					</p></td>
											</tr>
										</tbody>
									</table>
																-->
									<p class="price regular_price">&nbsp;</p>
												<p class="price">Giá: <span><span class="amount"><?php echo number_format ($result_spnam[$i]['gia'],0,",",".")." ₫";?></span></span></p>
																	</div>
							<div class="status">
								<p>Tình trạng: <?=$result_spnam[$i]['tinh_trang']?></p>
							</div>
						</div>
					</div>
			<?php
			} 
			?>
								<div class="clear"></div>
			
			</div>
			<div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <div class="pagination">
                        <?=$paging['paging']?></div>

                    </div>
                    
                </div>
		</div>
		<div class="clear"></div>
		</div>
</div>