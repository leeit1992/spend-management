<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>
	<?php  
		enqueueStyle( [
            'main'  => assets( 'backend/css/main.css' )
		] );
	?>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> -->
</head>
<body>
	<div class="container">
	  	<div class="row">
		    <div class="col-2">
		        <img src="<?php echo assets('/backend/assets/img/vietcombank.jpg'); ?>">
		    </div>
		    <div class="col-2 text-center">
		        <b>VIETCOMBANK</b>
		    </div>
		    <div class="col-6 text-center">
		    	<span class="atl-tittle"><b>UỶ NHIỆM CHI</b> - <i>PAYMENT ORDER</i></span>
		        <br>
		        Ngày <i>(Date)</i>: 01/03/2017
		    </div>
		    <div class="col-2 text-center">
		        <div class="atl-card-number">00005</div>
		    </div>
	  	</div>
	  	<hr>
	  	<div class="row">
	  		<div class="col-6">
	  			<b>ĐỀ NGHỊ GHI NỢ TÀI KHOẢN</b> <i>(Please Debit account:)</i>
	  			<br>
	  			<table class="table table-sm">
				    <tbody>
					    <tr>
						      <td class="atl-account atl-rm-border-right">Số TK <i>(A/C No)</i>:</td>
						      <td class="atl-rm-border-left"><b>11004064680</b></td>
					    </tr>
					    <tr>
						      <td class="atl-rm-border-right atl-rm-border-bottom">Tên TK <i>(A/C name)</i>:</td>
						      <td class="atl-rm-border-left atl-rm-border-bottom"><b>Đặng Nghĩa Hiệp</b></td>
					    </tr>
					    <tr>
						      <td class="atl-rm-border-right atl-rm-border-top">Địa chỉ <i>(Address)</i>:</td>
						      <td class="atl-rm-border-left atl-rm-border-top"></td>
					    </tr>
					    <tr>
						      <td class="atl-rm-border-right">Tại NH <i>(with Bank)</i>:</td>
						      <td class="atl-rm-border-left">Vietcombank – SGD</td>
					    </tr>
				    </tbody>
				</table>
				<br>
				<b>& GHI CÓ TÀI KHOẢN</b> <i>(& Credit accout:)</i>
	  			<br>
	  			<table class="table table-sm">
				    <tbody>
					    <tr>
						      <td class="atl-account atl-rm-border-right">Số TK <i>(A/C No)</i>:</td>
						      <td class="atl-rm-border-left"><b>0011 0041 61940</b></td>
					    </tr>
					    <tr>
						      <td class="atl-rm-border-right atl-rm-border-bottom">Tên TK <i>(A/C name)</i>:</td>
						      <td class="atl-rm-border-left atl-rm-border-bottom"><b>CONG TY TNHH TM & DL KHACH SAN PHUONG DONG HANOI</b></td>
					    </tr>
					    <tr>
						      <td class="atl-rm-border-right atl-rm-border-top">Địa chỉ <i>(Address)</i>:</td>
						      <td class="atl-rm-border-left atl-rm-border-top"></td>
					    </tr>
					    <tr>
						      <td class="atl-rm-border-right">Tại NH <i>(with Bank)</i>:</td>
						      <td class="atl-rm-border-left">Vietcombank - Hội Sở Branch</td>
					    </tr>
				    </tbody>
				</table>
	  		</div>
	  		<div class="col-6">
	  			<div class="row">
		  			<div class="col-8">
			  			SỐ TIỀN <i>(With amount)</i>
			  			<br>
			  			<table class="table table-sm">
						    <tbody>
							    <tr>
								    <td class="atl-rm-border-right">BẰNG SỐ <i>(In figures)</i>:</td>
								    <td class="atl-rm-border-left"><b>4 998 400</b></td>
								    <td>VNĐ</td>
							    </tr>
							    <tr>
								    <td colspan="3">BẰNG CHỮ <i>(In words)</i>:
								      	<br>
								      	<div class="text-center">
								      		<b>Bốn triệu chín trăm chín mươi tám ngàn bốn trăm đồng</b>
								      	</div>
								      	<br>
								     </td>
							    </tr>
						    </tbody>
						</table>
					</div>
					<div class="col-4">
						Phí NH <i>(Bank charges)</i>
						<table class="table table-sm">
						    <tbody>
							    <tr>
								    <td class="atl-bank-charges atl-rm-border text-center"><b>Phí trong </b><br> <i>Including</i></td>
								    <td class="atl-rm-border">
								      	<div class="atl-card-fee"></div>
								    </td>
							    </tr>
							    <tr>
								      <td class="atl-bank-charges atl-rm-border text-center"><b>Phí ngoài</b> <br> <i>Excluding</i></td>
								      <td class="atl-rm-border"><div class="atl-card-fee"></div></td>
							    </tr>
						    </tbody>
						</table>
					</div>

					<div class="col-4 text-center">
						NỘI DUNG
					</div>
					<div class="col-8 text-right">
						Asia Travel & Leisure thanh toan doan
					</div>

					<div class="col-12">
						<b>AU170309Peta ($220)</b>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5 text-center">
						<b>KẾ TOÁN TRƯỞNG KÝ</b><br><i>Chief Accountant</i>
						<br><br><br><br><br>
						Tuấn Nghiệp
					</div>
					<div class="col-7 text-center">
						<b>CHỦ TÀI KHOẢN KÝ VÀ ĐÓNG DẤU</b><br><i>Acc. Holder & Stamp</i>
						<br><br><br><br><br>
						 Đặng Nghĩa Hiệp
					</div>
				</div>
			</div>
	  	</div>
	  	<hr>
	  	<div class="row">
	  		<div class="col-12">
		  		<b><u>DÀNH CHO NGÂN HÀNG</u></b> <i>(For Bank's Use only)</i> <b>MÃ VAT</b>:
		  	</div>
		  	<br>
			<div class="col-6 offset-6">
				<div class="row">
					<div class="col-4 text-center"><b>Thanh toán viên</b></div>
					<div class="col-4 text-center"><b>Kiểm soát</b></div>
					<div class="col-4 text-center"><b>Giám đốc</b></div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>