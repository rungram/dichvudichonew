<?php
if(isset($_GET['id']))
{	
	$id =  addslashes($_GET['id']);
	
	$d->reset();
	$sql_tanglx="update  #_product set luotxem=luotxem+1 where id='$id'";
	$d->query($sql_tanglx);
	
	$d->reset();
	$sql_chitietsp="select *  from #_product where hienthi= 1 and id='$id'";
	$d->query($sql_chitietsp);
	$chitiet_sp=$d->fetch_array();
	//list
	$d->reset();
	$sql_l="select * from #_product_list where hienthi= 1 and id='".$chitiet_sp['id_list']."'";
	$d->query($sql_l);
	$result_l=$d->fetch_array();
	//
	$id_list = $chitiet_sp['id_list'];
	$d->reset();
	$sql_laylq="select * from #_product where hienthi =1 and id<>'$id' and id_list='$id_list' limit 0,5";
	$d->query($sql_laylq);
	$result_laylq=$d->result_array();
	//cat
	$d->reset();
	$sql_c="select * from #_product_cat where hienthi= 1 and id='".$chitiet_sp['id_cat']."'";
	$d->query($sql_c);
	$result_c=$d->fetch_array();
	//item
	$d->reset();
	$sql_i="select * from #_product_item where hienthi= 1 and id='".$chitiet_sp['id_item']."'";
	$d->query($sql_i);
	$result_i=$d->fetch_array();
	$id_list = $chitiet_sp['id_list'];
	$d->reset();
	$sql_spkhac="select id,ten_$lang,tenkhongdau,thumb,gia,masp,luotxem,mota_vi  from #_product where hienthi= 1 and id_list ='$id_list' and id<>'$id' order by stt asc limit 0,12";
	$d->query($sql_spkhac);
	$result_spkhac=$d->result_array();
		
	$url=getCurrentPageURL();
}
?>

				<!--xu ly lay màu-->
                <?php
				$mau_chinh = $chitiet_sp['id_mau'];
				$d->reset();
				$sql_laymau = "select ten_vi,ten_en from #_tinloai2_2 where id='$mau_chinh'";
				$d->query($sql_laymau);
				$result_laymau = $d->fetch_array();
				
				
				//lay ds mau khac
				
				$d->reset();
				$sql_maukhac  = "select * from table_hinh_cungsp";
			    $sql_maukhac .= " left join table_tinloai2_2 on table_tinloai2_2.id = table_hinh_cungsp.chon_mau";
				
				$sql_maukhac .= " where table_hinh_cungsp.id_sp='".$id."' and  table_hinh_cungsp.chon_mau<> '".$mau_chinh."'";
				$sql_maukhac .= " group by table_hinh_cungsp.chon_mau";
				$d->query($sql_maukhac);
				$result_maukhac = $d->result_array();
				
				//lay hinh cung mau
				$d->reset();
				$sql_cungmauc = "select thumb,photo from #_hinh_cungsp where id_sp='$id' and chon_mau='$mau_chinh'";
				$d->query($sql_cungmauc);
				$result_cungmauc = $d->result_array();
				?>
<div class="brackcum">
	<div class="container">
     <!-- Breadcrumb NavXT 5.3.0 -->
<span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" title="Go to ." href="index.html" class="home">Trang chủ</a>
</span>
<span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" title="Go to ." href='danh-muc-list/<?php echo $result_l["tenkhongdau"];?>-<?php echo $result_l["id"];?>.html' class="home"><?php echo $result_l['ten_vi'];?></a>
</span>
<span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" title="Go to ." href='danh-muc-cat/<?php echo $result_c["tenkhongdau"];?>-<?php echo $result_c["id"];?>.html' class="home"><?php echo $result_c['ten_vi'];?></a>
</span>
<span typeof="v:Breadcrumb">
<span property="v:title"><?=$chitiet_sp["ten_vi"]?></span>
</span>
</div>				
<div id="content" class="single_product">
	<div class="container">
		<div class="main_content">
			<div class="left">
				<div class="thumbnail" style="border: none;">
					<a href="#" data-fill="image_1" class="thumbnail-fancy" style="margin-right: 0px; padding-right: 0px;"><img src="upload/sanpham/<?php if($chitiet_sp["tc_big"]==1) echo $chitiet_sp["photo"]; else echo $chitiet_sp["photo"] ?>"></a>
											<a style="background:none" target="_blank" id="image_2" href="upload/sanpham/<?php if($chitiet_sp["tc_big"]==1) echo $chitiet_sp["photo"]; else echo $chitiet_sp["photo"] ?>" class="fancybox" rel="single_fancy">
										
					          					<p>Click chuột để phóng to ảnh</p></a>
				</div>
				<h3>Album ảnh</h3>
				<div class="slider_thumbnail">
					<ul class="slider_single owl-carousel owl-theme owl-loaded">
						
													
											<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 211.2px;"><div class="owl-item active" style="width: 105.6px; margin-right: 0px;"><li><a data-fill="image_1" href="#">
											<img src="upload/sanpham/<?php if($chitiet_sp["tc_big"]==1) echo $chitiet_sp["photo"]; else echo $chitiet_sp["photo"] ?>"></a></li></div><div class="owl-item active" style="width: 105.6px; margin-right: 0px;"></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style="display: none;">prev</div><div class="owl-next" style="display: none;">next</div></div><div class="owl-dots" style=""><div class="owl-dot active"><span></span></div></div></div></ul>
				</div>
											</div>
			<div class="right">
				<h1><?=$chitiet_sp["ten_vi"]?></h1>
				<h4><?=$chitiet_sp["mota_vi"]?></h4>
												<p class="price regular_price">&nbsp;</p>
								<p class="price">Giá: <span><span class="amount" style="font-size: 20px;"><?php echo number_format ($chitiet_sp['gia'],0,",",".")." ₫";?></span></span></p>
								<?=$chitiet_sp["noidung_vi"]?>		
				<div class="color">
									</div>
				<div class="social">
					<a href="http://www.facebook.com/share.php?u=http://nhadep.com.vn/product/sofa-da-italia-newming-72608036/&amp;title=Sofa da Italia New Ming góc trái, màu nâu | Mã: 72608036"><img src="http://nhadep.com.vn/wp-content/themes/nhadep/images/fbshare.jpg" alt="Fb Share"></a>
					<a href="https://plus.google.com/share?url=http://nhadep.com.vn/product/sofa-da-italia-newming-72608036/"><img src="http://nhadep.com.vn/wp-content/themes/nhadep/images/gshare.jpg" alt="G+ Share"></a>
					<a href="#" class="single-product-print"><img src="http://nhadep.com.vn/wp-content/themes/nhadep/images/print.png" alt=""> In trang này</a>
				</div>
				<button type="submit" name="do_submit" id="do_submit" class="dat_mua" onclick="addtocart(<?=$chitiet_sp['id']?>)"  valign=""><span>Đặt mua sản phẩm này</span></button>
													
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-8211">
		    <div class="yith-wcwl-add-button show" style="display:block">
	    </div>

	    <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
	        <span class="feedback">Đã thêm sản phẩm!</span>
	        <a href="http://nhadep.com.vn/wishlist/view/">
	            Vào trang danh sách	        </a>
	    </div>

	    <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
	        <span class="feedback">Sản phẩm đã có trong danh sách</span>
	        <a href="http://nhadep.com.vn/wishlist/view/">
	            Vào trang danh sách	        </a>
	    </div>

	    <div style="clear:both"></div>
	    <div class="yith-wcwl-wishlistaddresponse"></div>
	
</div>

<div class="clear"></div>				<br><br>
			</div>
			<div class="clear"></div>
		</div>
		<div class="more_content">
			<div class="left">
				<ul class="more_menu">
					<li><a href="#" data-fill="#more_mota" class="active">Mô tả</a></li>
					<li><a href="#" data-fill="#more_video">Video</a></li>
					<li><a href="#" data-fill="#more_gallery">Gallery</a></li>
					<li><a href="#" data-fill="#more_huongdan">Hướng dẫn mua hàng</a></li>
					<li><a href="#" data-fill="#more_binhluan">Bình luận</a></li>
				</ul>
				<div class="more_tab" id="more_mota">
				<?=$chitiet_sp["mota_en"]?>
					<div class="content-lienhe">
						<a href="#lienhe-popup" class="fancybox">Liên hệ để được tư vấn</a>
						<div class="hidden">
							<div class="phan-hoi" id="lienhe-popup">
								<div class="left-form">
									<h3>GỬI PHẢN HỒI CHO NHÀ ĐẸP</h3>
									[contact-form-7 id="62" title="Gửi phản hồi"]									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="more_tab hidden" id="more_video">
										<p>Hiện chưa có video cho sản phẩm này</p>
									</div>
				<div class="more_tab hidden" id="more_gallery">
					<ul class="more_gallery">
													<li><a href="http://nhadep.com.vn/wp-content/uploads/05-a-Sofa-da-Italia-New-Ming.jpg" class="fancybox" rel="group"><img src="http://nhadep.com.vn/wp-content/uploads/05-a-Sofa-da-Italia-New-Ming.jpg"></a></li>
											</ul>
				</div>
				<div class="more_tab hidden" id="more_huongdan">
					<p></p><p>Hướng dẫn mua hàng</p>
<p></p>
				</div>
				<div class="more_tab hidden" id="more_binhluan">
					<div id="reviews">
	<div id="comments">
		<h2>Đánh giá</h2>

		
			<p class="woocommerce-noreviews">Chưa có đánh giá nào.</p>

			</div>

	
		<div id="review_form_wrapper">
			<div id="review_form">
										<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title">Hãy là người đầu tiên đánh giá “Sofa da Italia New Ming góc trái, màu nâu | Mã: 72608036” <small><a rel="nofollow" id="cancel-comment-reply-link" href="/product/sofa-da-italia-newming-72608036/#respond" style="display:none;">Hủy</a></small></h3>
									<p class="must-log-in">Bạn phải <a href="http://nhadep.com.vn/wp-login.php?redirect_to=http%3A%2F%2Fnhadep.com.vn%2Fproduct%2Fsofa-da-italia-newming-72608036%2F">đăng nhập</a> để gửi phản hồi.</p>												</div><!-- #respond -->
						</div>
		</div>

	
	<div class="clear"></div>
</div>
				</div>
			</div>
			<div class="right">
				<h5>Bạn đang xem sản phẩm</h5>
				<img src="upload/sanpham/<?php if($chitiet_sp["tc_big"]==1) echo $chitiet_sp["photo"]; else echo $chitiet_sp["photo"] ?>" alt="thumbnail">
				<h2><?=$chitiet_sp["ten_vi"]?></h2>
				<div class="main_content">
														<p class="price regular_price">&nbsp;</p>
									<p class="price">Giá: <span><span class="amount"><?php echo number_format ($chitiet_sp['gia'],0,",",".")." ₫";?></span></span></p>
											</div>
															<button type="submit" name="do_submit" id="do_submit" class="dat_mua" onclick="addtocart(<?=$chitiet_sp['id']?>)"  valign=""><span>Đặt mua sản phẩm này</span></button>
												</div>
			<div class="clear"></div>
		</div>
		<!-- *** Sản phẩm đi kèm *** -->
					<!-- *** Sản phẩm tương tự *** -->
		<div class="products">
			<h3>Sản phẩm tương tự</h3>
			<?php
               for($i=0;$i<count($result_laylq);$i++)
               { 
               ?>
						<div class="item-content">
				<div class="item" style="height: 288px;">	
					<a href="chi-tiet-san-pham/<?=$result_laylq[$i]['tenkhongdau']?>-<?=$result_laylq[$i]['id']?>.html" class="thumbnail">
						<img src="upload/sanpham/<?php if($result_laylq[$i]["tc_big"]==1) echo $result_laylq[$i]["photo"]; else echo $result_laylq[$i]["photo"] ?>">
													<img src="upload/sanpham/<?php if($result_laylq[$i]["tc_big"]==1) echo $result_laylq[$i]["photo"]; else echo $result_laylq[$i]["photo"] ?>" class="phoicanh">
												            					</a>
					<div class="text">
						<h3><?=$result_laylq[$i]["ten_vi"]?></h3>
						
																								<p class="price regular_price">&nbsp;</p>
							<p class="price">Giá: <span><span class="amount"><?php echo number_format ($result_laylq[$i]['gia'],0,",",".")." ₫";?></span></span></p>
																</div>
					<div class="status">
						<p>Tình trạng: <?=$result_laylq[$i]['tinh_trang']?></p>
					</div>
				</div>
			</div>
			<?php 
               }
               ?>
						<div class="clear"></div>
		</div>
		
	</div>
</div>