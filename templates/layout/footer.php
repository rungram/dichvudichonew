<?php 
	$d->reset();
	$sql_chinhsach ="select * from #_product where chinhsach = 1 order by stt asc limit 0,5";
	$d->query($sql_chinhsach);
	$chinhsach=$d->result_array();
	
	$d->reset();
	$sql_list ="select *	from #_product_list where hienthi=1 order by stt asc limit 0,8";
	$d->query($sql_list);
	$list =$d->result_array();
?>

<footer id="footer">
            <div class="container">
                <!-- introduce-box -->
                <div id="introduce-box" class="row">
                    <div class="col-md-4">
                        
                        <div id="address-box">
                            <div id="address-list">

                                <h4 style="color:#fff;font-size: 16px;padding-top: 0px;"><strong>GIỚI THIỆU VỀ Dichvudicho.com</strong></h4>
                                <p style="color:#fff;padding-top: 12px;">
                                    Dichvudicho.com sẽ kết nối khách hàng với hệ thống siêu thị lớn ở thành phố Hồ chí minh như Big C, Lotte, Emart, Vissan… và các đối tác như Thật Sạch Xanh, Đỉnh Phong, Đặc sản 3 miền.
Dichvudicho.com là 1 dịch vụ sẽ giúp bạn trải nghiệm siêu thị online.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="color:#fff;font-size: 16px;padding-bottom: 7px;"><strong>Dịch vụ đi chợ online - Dịch vụ đi chợ thuê tại Tp.HCM</strong></p>
		<p style="color:#fff"> Trụ sở: 24 Hoàng Việt, P4, Quận Tân Bình, Tp.HCM </p>
		<p style="color:#fff"><i class="fa fa-phone"></i> Hotline: <a style="color:#fff" href="tel:0909 911 726">0909 911 726</a></p>
		<p style="color:#fff"><i class="fa fa-envelope"></i> Email: <a style="color:#fff" href="">dichvudicho24h@gmail.com</a></p>
		<p style="color:#fff"> Website: <a style="color:#fff" href="">dichvudicho.com</a></p>
		<p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fdichvudichonhanh%3Ffref%3Dts&amp;width=360&amp;height=139&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 360px;
                        height: 140px;" allowtransparency="true"></iframe>
		<!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
        <!-- Histats.com  START  (aync)-->
        <script type="text/javascript">var _Hasync= _Hasync|| [];
        _Hasync.push(['Histats.start', '1,3843585,4,403,118,80,00011111']);
        _Hasync.push(['Histats.fasi', '1']);
        _Hasync.push(['Histats.track_hits', '']);
        (function() {
        var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
        hs.src = ('//s10.histats.com/js15_as.js');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
        })();</script>
        <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3843585&101" alt="" border="0"></a></noscript>
        <!-- Histats.com  END  -->
                    </div>
                </div><!-- /#introduce-box -->
                <div id="footer-menu-box">
                    <p class="text-center">
                        Copyrights &copy; 2017 dichvudicho. All Rights Reserved.<br />
                    </p>

                </div><!-- /#footer-menu-box -->
            </div>
        </footer>
<!--footer-->
