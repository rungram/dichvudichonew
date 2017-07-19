<?php
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
	remove_product($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
	unset($_SESSION['cart']);
	}
	else if($_REQUEST['command']=='update'){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=intval($_REQUEST['product'.$pid]);
		if($q>0 && $q<=999){
		$_SESSION['cart'][$i]['qty']=$q;
		}
		else{
		$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
		}
	}
	}
?>
<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
		document.formgiobo.pid.value=pid;
		document.formgiobo.command.value='delete';
		document.formgiobo.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
		document.formgiobo.command.value='clear';
		document.formgiobo.submit();
		}
	}
	function updatecart(){
		document.formgiobo.command.value='update';
		document.formgiobo.submit();
	}
</script>

<div class="container">
	<div class="woocommerce">
	<div class="yf-cart">
		<form	name="formgiobo" method="post">
		<input type="hidden" name="pid" />
		<input type="hidden" name="command" />
		<h3>Giỏ hàng của bạn</h3>
		<table class="shop_table cart" cellspacing="0">
			<thead>
			<tr>
				<th class="product-thumbnail">Hình ảnh</th>
				<th class="product-name">Tên sản phẩm</th>
				<th class="product-quantity">Số lượng</th>
				<th class="product-price">Giá (VNĐ)</th>
				<th class="product-subtotal">Tổng (VNĐ)</th>
			</tr>
			</thead>
			<tbody>
			<?php
		if(is_array($_SESSION['cart'])){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];			
			$pname=get_product_name($pid);
			$pma=get_masp($pid);
			$phinh=get_hinh($pid);
			$pmota=get_mota($pid);
			$pkodau=get_kodau($pid);
			$psale=get_giagiam($pid);
			if($q==0) continue;
		?>
			<tr class="cart_item">
				<td class="product-thumbnail"><a href="chi-tiet-san-pham/<?=$pkodau?>-<?=$pid?>.html"><img width="180" height="180" src="upload/sanpham/<?=$phinh?>"></a> </td>
				<td class="product-name"><a href="chi-tiet-san-pham/<?=$pkodau?>-<?=$pid?>.html">
				<?=$pname?>
				</a> </td>
				<td class="product-quantity"><div class="quantity">
					<input onchange="updatecart()" type="number" step="1" min="0" name="product<?=$pid?>" value="<?=$q?>" title="SL" class="input-text qty text" size="4">
				</div>
				<a href="javascript:del(<?=$pid?>)" class="remove" title="Xóa sản phẩm này"></a> </td>
				<td class="product-price"><span class="amount">
				<?php 
					if($psale ==0) 
					echo number_format(get_price($pid),0, ',', '.').'₫';
					else 
					echo number_format($psale,0, ',', '.').'₫';
					 ?>
				</span> </td>
				<td class="product-subtotal"><span class="amount">
				<?php 
						if($psale ==0) 
						echo number_format(get_price($pid)*$q,0, ',', '.').'₫';
						else 
						echo number_format(get_giagiam($pid)*$q,0, ',', '.').'₫';
					 ?>
				</span> </td>
			</tr>
			<?php		 
		}
		?>
			<tr>
				<td colspan="6" class="actions"><div class="coupon">
					<label for="coupon_code">Phiếu ưu đãi:</label>
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Mã ưu đãi">
					<input type="submit" class="button" name="apply_coupon" value="Áp dụng ưu đãi">
				</div>
				<input type="hidden" id="_wpnonce" name="_wpnonce" value="d4e44a7f4a">
				<input type="hidden" name="_wp_http_referer" value="/cart/">
				</td>
			</tr>
			<?php
			}
	?>
			</tbody>
		</table>
		<div class="cart_summary">
			<div class="left">
			<input type="submit" class="button" name="update_cart" value="Cập nhật lại">
			</div>
			<div class="right">
			<p>Tổng giá trị đơn hàng: <span class="amount">
				<?= number_format( get_ordersale_total($pid)+$row_setting['phivc'],0, ',', '.').'đ';?>
				</span></p>
			<p>Mã giảm giá: <span class="coupon"> </span> </p>
			<p>Giá sau giảm: <strong><span class="amount">
				<?= number_format( get_ordersale_total($pid)+$row_setting['phivc'],0, ',', '.').'đ';?>
				</span></strong> </p>
			</div>
			<div class="clear"></div>
		</div>
		</form>
		<!-- *** Check out *** -->
		<style>
	#order_review_heading,
	.woocommerce-checkout-review-order-table
	{
	display: none;
	}
</style>
		<form name="checkout" method="post" class="checkout woocommerce-checkout yf-checkout container" action="gui-don-hang.html" enctype="multipart/form-data" novalidate="novalidate">
		<h3>Thông tin thanh toán đơn hàng</h3>
		<div class="yf-checkout-container">
			<div class="left">
			<h4><img src="http://nhadep.com.vn/wp-content/themes/nhadep/images/transport.png" alt="">Phương thức giao hàng</h4>
			<div class="fix-center">
				<div class="cart_totals ">
				<table cellspacing="0">
					<tbody>
					<tr class="shipping">
						<th>Giao hàng</th>
						<td><ul id="shipping_method">
							<li>
							<input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_delivery" value="local_delivery" checked="checked" class="shipping_method">
							<label for="shipping_method_0_local_delivery">Nhận hàng tại nhà (Miễn phí)</label>
							</li>
							<li>
							<input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup" value="local_pickup" class="shipping_method">
							<label for="shipping_method_0_local_pickup">Nhận hàng tại cửa hàng (Miễn phí)</label>
							</li>
						</ul>
						<p><a href="#" class="shipping-calculator-button">Tính phí giao nhận</a></p>
						<section class="shipping-calculator-form" style="display:none;">
							<p class="form-row form-row-wide woocommerce-validated" id="calc_shipping_country_field">
							<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
								<option value="">Chọn quốc gia…</option>
								<option value="AF">Afghanistan</option>
								<option value="EG">Ai Cập</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="GB">Anh (UK)</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua và Barbuda</option>
								<option value="AN">Antille thuộc Hà Lan</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
								<option value="BY">Belarus</option>
								<option value="PW">Belau</option>
								<option value="BZ">Belize</option>
								<option value="BJ">Benin</option>
								<option value="BM">Bermuda</option>
								<option value="BT">Bhutan</option>
								<option value="BO">Bolivia</option>
								<option value="BQ">Bonaire, Saint Eustatius và Saba</option>
								<option value="BA">Bosnia và Herzegovina</option>
								<option value="BW">Botswana</option>
								<option value="BR">Brazil</option>
								<option value="BN">Brunei</option>
								<option value="BG">Bulgaria</option>
								<option value="BF">Burkina Faso</option>
								<option value="BI">Burundi</option>
								<option value="BE">Bỉ</option>
								<option value="PT">Bồ Đào Nha</option>
								<option value="CI">Bờ biển Ngà</option>
								<option value="CM">Cameroon</option>
								<option value="KH">Campuchia</option>
								<option value="CA">Canada</option>
								<option value="CV">Cape Verde</option>
								<option value="TD">Chad</option>
								<option value="CL">Chile</option>
								<option value="CX">Christmas Island</option>
								<option value="CO">Colombia</option>
								<option value="KM">Comoros</option>
								<option value="CG">Congo (Brazzaville)</option>
								<option value="CD">Congo (Kinshasa)</option>
								<option value="CR">Costa Rica</option>
								<option value="HR">Croatia</option>
								<option value="CU">Cuba</option>
								<option value="CW">CuraÇao</option>
								<option value="CY">Cyprus</option>
								<option value="AE">Các tiểu vương quốc Ả Rập</option>
								<option value="DO">Cộng hòa Dominica</option>
								<option value="IE">Cộng hòa Ireland</option>
								<option value="CZ">Cộng hòa Séc</option>
								<option value="CF">Cộng hòa Trung Phi</option>
								<option value="DJ">Djibouti</option>
								<option value="DM">Dominica</option>
								<option value="EC">Ecuador</option>
								<option value="SV">El Salvador</option>
								<option value="ER">Eritrea</option>
								<option value="EE">Estonia</option>
								<option value="ET">Ethiopia</option>
								<option value="FJ">Fiji</option>
								<option value="GA">Gabon</option>
								<option value="GM">Gambia</option>
								<option value="GE">Georgia</option>
								<option value="GH">Ghana</option>
								<option value="GI">Gibraltar</option>
								<option value="GL">Greenland</option>
								<option value="GD">Grenada</option>
								<option value="GP">Guadeloupe</option>
								<option value="GT">Guatemala</option>
								<option value="GG">Guernsey</option>
								<option value="GN">Guinea</option>
								<option value="GQ">Guinea Xích đạo</option>
								<option value="GW">Guinea-Bissau</option>
								<option value="GY">Guyana</option>
								<option value="GF">Guyane thuộc Pháp</option>
								<option value="HT">Haiti</option>
								<option value="HN">Honduras</option>
								<option value="HU">Hungary</option>
								<option value="GR">Hy Lạp</option>
								<option value="NL">Hà Lan</option>
								<option value="KR">Hàn Quốc</option>
								<option value="HK">Hồng Kông</option>
								<option value="IS">Iceland</option>
								<option value="ID">Indonesia</option>
								<option value="IR">Iran</option>
								<option value="IQ">Iraq</option>
								<option value="IL">Israel</option>
								<option value="JM">Jamaica</option>
								<option value="JE">Jersey</option>
								<option value="JO">Jordan</option>
								<option value="KZ">Kazakhstan</option>
								<option value="KE">Kenya</option>
								<option value="KI">Kiribati</option>
								<option value="KW">Kuwait</option>
								<option value="KG">Kyrgyzstan</option>
								<option value="LV">Latvia</option>
								<option value="LB">Lebanon</option>
								<option value="LS">Lesotho</option>
								<option value="LR">Liberia</option>
								<option value="LY">Libya</option>
								<option value="LI">Liechtenstein</option>
								<option value="LT">Lithuania</option>
								<option value="LU">Luxembourg</option>
								<option value="LA">Lào</option>
								<option value="TF">Lãnh thổ miền Nam nước Pháp</option>
								<option value="IO">Lãnh thổ Ấn Độ Dương thuộc Anh</option>
								<option value="MO">Ma Cao</option>
								<option value="MK">Macedonia</option>
								<option value="MG">Madagascar</option>
								<option value="MW">Malawi</option>
								<option value="MY">Malaysia</option>
								<option value="MV">Maldives</option>
								<option value="ML">Mali</option>
								<option value="MT">Malta</option>
								<option value="MQ">Martinique</option>
								<option value="MR">Mauritania</option>
								<option value="MU">Mauritius</option>
								<option value="YT">Mayotte</option>
								<option value="MX">Mexico</option>
								<option value="FM">Micronesia</option>
								<option value="MD">Moldova</option>
								<option value="MC">Monaco</option>
								<option value="ME">Montenegro</option>
								<option value="MS">Montserrat</option>
								<option value="MA">Morocco</option>
								<option value="MZ">Mozambique</option>
								<option value="MM">Myanmar</option>
								<option value="MN">Mông Cổ</option>
								<option value="US">Mỹ (US)</option>
								<option value="NO">Na Uy</option>
								<option value="GS">Nam Georgia và Quần đảo Nam Sandwich</option>
								<option value="ZA">Nam Phi</option>
								<option value="SS">Nam Sudan</option>
								<option value="NA">Namibia</option>
								<option value="NR">Nauru</option>
								<option value="NP">Nepal</option>
								<option value="NC">New Caledonia</option>
								<option value="NZ">New Zealand</option>
								<option value="RU">Nga</option>
								<option value="JP">Nhật Bản</option>
								<option value="NI">Nicaragua</option>
								<option value="NE">Niger</option>
								<option value="NG">Nigeria</option>
								<option value="NU">Niue</option>
								<option value="NF">Norfolk Island</option>
								<option value="OM">Oman</option>
								<option value="PK">Pakistan</option>
								<option value="PS">Palestinian Territory</option>
								<option value="PA">Panama</option>
								<option value="PG">Papua New Guinea</option>
								<option value="PY">Paraguay</option>
								<option value="PE">Peru</option>
								<option value="PH">Philippines</option>
								<option value="FR">Pháp</option>
								<option value="PL">Phần Lan</option>
								<option value="FI">Phần Lan</option>
								<option value="PN">Pitcairn</option>
								<option value="PF">Polynesia thuộc Pháp</option>
								<option value="QA">Qatar</option>
								<option value="AX">Quần đảo Åland</option>
								<option value="VG">Quần đảo British Virgin</option>
								<option value="KY">Quần đảo Cayman</option>
								<option value="CC">Quần đảo Cocos (Keeling)</option>
								<option value="CK">Quần đảo Cook</option>
								<option value="FK">Quần đảo Falkland</option>
								<option value="FO">Quần đảo Faroe</option>
								<option value="MH">Quần đảo Marshall</option>
								<option value="SB">Quần đảo Solomon</option>
								<option value="RE">Reunion</option>
								<option value="RO">Romania</option>
								<option value="RW">Rwanda</option>
								<option value="ST">São Tomé và Príncipe</option>
								<option value="BL">Saint Barthélemy</option>
								<option value="SH">Saint Helena</option>
								<option value="KN">Saint Kitts và Nevis</option>
								<option value="LC">Saint Lucia</option>
								<option value="SX">Saint Martin (thuộc Hà Lan)</option>
								<option value="PM">Saint Pierre và Miquelon</option>
								<option value="VC">Saint Vincent và Grenadines</option>
								<option value="MF">Saint-Martin (thuộc Pháp)</option>
								<option value="SM">San Marino</option>
								<option value="SN">Senegal</option>
								<option value="RS">Serbia</option>
								<option value="SC">Seychelles</option>
								<option value="SL">Sierra Leone</option>
								<option value="SG">Singapore</option>
								<option value="SK">Slovakia</option>
								<option value="SI">Slovenia</option>
								<option value="SO">Somalia</option>
								<option value="LK">Sri Lanka</option>
								<option value="SD">Sudan</option>
								<option value="SR">Suriname</option>
								<option value="SJ">Svalbard và Jan Mayen</option>
								<option value="SZ">Swaziland</option>
								<option value="SY">Syria</option>
								<option value="TJ">Tajikistan</option>
								<option value="TZ">Tanzania</option>
								<option value="TH">Thái Lan</option>
								<option value="TR">Thổ Nhĩ Kỳ</option>
								<option value="CH">Thụy Sĩ</option>
								<option value="SE">Thụy Điển</option>
								<option value="TG">Togo</option>
								<option value="TK">Tokelau</option>
								<option value="TO">Tonga</option>
								<option value="TT">Trinidad và Tobago</option>
								<option value="KP">Triều Tiên</option>
								<option value="CN">Trung Quốc</option>
								<option value="TN">Tunisia</option>
								<option value="TM">Turkmenistan</option>
								<option value="TC">Turks và quần đảo Caicos</option>
								<option value="TV">Tuvalu</option>
								<option value="ES">Tây Ban Nha</option>
								<option value="UG">Uganda</option>
								<option value="UA">Ukraine</option>
								<option value="UY">Uruguay</option>
								<option value="UZ">Uzbekistan</option>
								<option value="VU">Vanuatu</option>
								<option value="VA">Vatican</option>
								<option value="VE">Venezuela</option>
								<option value="VN" selected="selected">Việt Nam</option>
								<option value="WF">Wallis và Futuna</option>
								<option value="EH">Western Sahara</option>
								<option value="WS">Western Samoa</option>
								<option value="YE">Yemen</option>
								<option value="ZM">Zambia</option>
								<option value="ZW">Zimbabwe</option>
								<option value="AT">Áo</option>
								<option value="AU">Úc</option>
								<option value="IT">Ý</option>
								<option value="DK">Đan Mạch</option>
								<option value="TW">Đài Loan</option>
								<option value="TL">Đông Timo</option>
								<option value="BV">Đảo Bouvet</option>
								<option value="HM">Đảo Heard và quần đảo McDonald</option>
								<option value="IM">Đảo Man</option>
								<option value="DE">Đức</option>
								<option value="SA">Ả Rập Saudi</option>
								<option value="IN">Ấn Độ</option>
							</select>
							</p>
							<p class="form-row form-row-wide" id="calc_shipping_state_field" style="display: none;">
							<input type="hidden" class="hidden" name="calc_shipping_state" id="calc_shipping_state" value="" placeholder="Bang / Hạt">
							</p>
							<p class="form-row form-row-wide" id="calc_shipping_postcode_field">
							<input type="text" class="input-text" value="" placeholder="Mã bưu điện" name="calc_shipping_postcode" id="calc_shipping_postcode">
							</p>
							<p>
							<button type="submit" name="calc_shipping" value="1" class="button">Cập nhật tổng</button>
							</p>
							<input type="hidden" id="_wpnonce" name="_wpnonce" value="d4e44a7f4a">
							<input type="hidden" name="_wp_http_referer" value="/cart/">
						</section>
						</td>
					</tr>
					</tbody>
				</table>
				</div>
			</div>
			<h4><img src="http://nhadep.com.vn/wp-content/themes/nhadep/images/lock.png" alt="">Phương thức thanh toán</h4>
			<div class="fix-center">
				<table class="shop_table woocommerce-checkout-review-order-table">
				<thead>
					<tr>
					<th class="product-name">Sản phẩm</th>
					<th class="product-total">Tổng</th>
					</tr>
				</thead>
				<tbody>
					<tr class="cart_item">
					<td class="product-name"> Sofa da Italia New Ming góc trái, màu nâu | Mã: 72608036&nbsp; <strong class="product-quantity">× 1</strong> </td>
					<td class="product-total"><span class="amount">114.880.000₫</span> </td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="cart-subtotal">
					<th>Tổng phụ</th>
					<td><span class="amount">114.880.000₫</span></td>
					</tr>
					<tr class="shipping">
					<th>Giao hàng</th>
					<td><ul id="shipping_method">
						<li>
							<input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_delivery" value="local_delivery" checked="checked" class="shipping_method">
							<label for="shipping_method_0_local_delivery">Nhận hàng tại nhà (Miễn phí)</label>
						</li>
						<li>
							<input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_local_pickup" value="local_pickup" class="shipping_method">
							<label for="shipping_method_0_local_pickup">Nhận hàng tại cửa hàng (Miễn phí)</label>
						</li>
						</ul></td>
					</tr>
					<tr class="order-total">
					<th>Tổng</th>
					<td><strong><span class="amount">114.880.000₫</span></strong> </td>
					</tr>
				</tfoot>
				</table>
				<ul class="payment_methods methods">
				<li class="payment_method_bacs">
					<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" checked="checked" data-order_button_text="">
					<label for="payment_method_bacs"> Thanh toán qua ngân hàng </label>
				</li>
				<li class="payment_method_cod">
					<input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" data-order_button_text="">
					<label for="payment_method_cod"> Thanh toán khi nhận hàng </label>
					<div class="payment_box payment_method_cod" style="display:none;">
					<p>Trả tiền mặt khi giao hàng</p>
					</div>
				</li>
				</ul>
				<div class="form-row place-order">
				<noscript>
				Trình duyệt của bạn không hỗ trợ JavaScript, hoặc nó bị vô hiệu hóa, hãy đảm bảo bạn nhấp vào &lt;em&gt; Cập nhật giỏ hàng &lt;/ em&gt; trước khi bạn thanh toán. Bạn có thể phải trả nhiều hơn số tiền đã nói ở trên, nếu bạn không làm như vậy.&lt;br/&gt;&lt;input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Cập nhật tổng" /&gt;
				</noscript>
				<input type="hidden" id="_wpnonce" name="_wpnonce" value="62565e22bb">
				<input type="hidden" name="_wp_http_referer" value="/cart/">
				</div>
				<div class="clear"></div>
			</div>
			</div>
			<div class="right">
			<h4><img src="http://nhadep.com.vn/wp-content/themes/nhadep/images/phone.png" alt="">Thông tin khách hàng</h4>
			<div class="fix-center">
				<p class="form-row form-row form-row-last validate-required" id="billing_last_name_field">
				<label for="billing_last_name" class="">Tên <abbr class="required" title="bắt buộc" aria-required="true">*</abbr></label>
				<input type="text" class="input-text " name="hoten2" id="billing_last_name" placeholder="" value="">
				</p>
				<div class="clear"></div>
				<p class="form-row form-row form-row-first validate-required validate-email" id="billing_email_field">
				<label for="billing_email" class="">Địa chỉ email <abbr class="required" title="bắt buộc" aria-required="true">*</abbr></label>
				<input type="email" class="input-text " name="email" id="billing_email" placeholder="" value="">
				</p>
				<p class="form-row form-row form-row-last validate-required validate-phone" id="billing_phone_field">
				<label for="billing_phone" class="">Số điện thoại <abbr class="required" title="bắt buộc" aria-required="true">*</abbr></label>
				<input type="tel" class="input-text " name="dienthoai" id="billing_phone" placeholder="" value="">
				</p>
				<div class="clear"></div>
				<p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
				<label for="billing_address_1" class="">Địa chỉ <abbr class="required" title="bắt buộc" aria-required="true">*</abbr></label>
				<input type="text" class="input-text " name="diachi" id="billing_address_1" placeholder="Tên phố" value="">
				</p>
				<!-- ORDER NOTE -->
				<p class="form-row form-row notes" id="order_comments_field">
				<label for="order_comments" class="">Ghi chú đơn hàng</label>
				<textarea name="noidung" class="input-text " id="order_comments" placeholder="Ghi chú về đơn hàng, ví dụ: lưu ý khi giao hàng." rows="2" cols="5"></textarea>
				</p>
				<p class="form-row form-row hoadon" id="field_hoadon_field">
				<label for="1" class="strong">Bạn có muốn lấy hóa đơn?</label>
				<input type="radio" class="input-radio " value="1" name="field_hoadon" id="field_hoadon_1">
				<label for="field_hoadon_1" class="radio strong">Có</label>
				<input type="radio" class="input-radio " value="0" name="field_hoadon" id="field_hoadon_0" checked="checked">
				<label for="field_hoadon_0" class="radio strong">Không</label>
				</p>
			</div>
			<div class="more-info">
				<div class="fix-center">
				<div class="woocommerce-shipping-fields">
					<p id="ship-to-different-address"> <strong>Thông tin người nhận:</strong> Khác địa chỉ trên
					<input id="ship-to-different-address-checkbox" class="input-checkbox" type="checkbox" name="ship_to_different_address" value="1">
					</p>
					<div class="shipping_address" style="display: none;">
					<p class="form-row form-row form-row-last validate-required" id="shipping_last_name_field">
						<label for="shipping_last_name" class="">Tên <abbr class="required" title="bắt buộc" aria-required="true">*</abbr></label>
						<input type="text" class="input-text " name="shipping_last_name" id="shipping_last_name" placeholder="" value="">
					</p>
					<div class="clear"></div>
					<p class="form-row form-row form-row-wide address-field validate-required" id="shipping_address_1_field">
						<label for="shipping_address_1" class="">Địa chỉ <abbr class="required" title="bắt buộc" aria-required="true">*</abbr></label>
						<input type="text" class="input-text " name="shipping_address_1" id="shipping_address_1" placeholder="Tên phố" value="">
					</p>
					<p class="form-row form-row form-row-wide address-field" id="shipping_address_2_field">
						<label for="shipping_address_2" class="">Điện thoại</label>
						<input type="text" class="input-text " name="shipping_address_2" id="shipping_address_2" placeholder="Số nhà chung cư, số phòng, số nhà riêng...(không bắt buộc)" value="">
					</p>
					</div>
				</div>
				</div>
			</div>
			<br>
			</div>
			<div class="clear"></div>
		</div>
		<input type="submit" class="dat_mua" name="woocommerce_checkout_place_order" id="place_order" value="Gửi đơn hàng" data-value="">
		<div class="clear"></div>
		</form>
	</div>
	</div>
</div>
