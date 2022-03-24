<block name='form'>

<?php
 $db= getDB("ora");

 #############
 # mengambil list Service Code dari tabel mst_service code
 # 12/06/2009

 $sql= "select KD_SERVICE_CODE,SERVICE_CODE from mst_service_code";
 $rs = $db->query($sql);

 $combolist["SERVICE_CODE"] = $rs->getAll();


$combolist["RAMP_DOOR"] = array (
  0 =>
  array (
    'id' => '0',
    '' => 'TIDAK',
  ),
  1 =>
  array (
    'id' => '1',
    '' => 'YA',
  ),
);
$combolist["KD_GERAKAN"] = array (
  0 => 
  array (
    'id' => '0',
    '' => 'MASUK',
  ),
  1 => 
  array (
    'id' => '1',
    '' => 'PINDAH',
  ),
  2 => 
  array (
    'id' => '2',
    '' => 'KELUAR',
  ),
);
$combolist["KD_PERAIRAN"] = array (
  0 =>
  array (
    'id' => '0',
    '' => 'DALAM PERAIRAN TANJUNG PRIOK',
  ),
  1 =>
  array (
    'id' => '1',
    '' => 'LUAR PERAIRAN TANJUNG PRIOK',
  ),
  2 =>
  array (
    'id' => '2',
    '' => 'DERMAGA KHUSUS',
  ),
  
);
$combolist["POS_TAMBAT"] = array (
  0 =>
  array (
    'id' => '0',
    '' => 'MERAPAT',
  ),
  1 =>
  array (
    'id' => '1',
    '' => 'MELAMBUNG',
  ),
  2 =>
  array (
    'id' => '2',
    '' => 'SUSUN SIRIH',
  ),
);
$combolist["JN_BONGKAR"] = array (
  0 =>
  array (
    'id' => 'TANPA KEMASAN',
    '' => 'TANPA KEMASAN',
  ),
  1 =>
  array (
    'id' => 'DENGAN KEMASAN',
    '' => 'DENGAN KEMASAN',
  ),
);

$combolist["KD_MORING"] = array (
  
  1 =>
  array (
    'id' => '1',
    '' => 'YA',
  ),
  0 =>
  array (
    'id' => '0',
    '' => 'TIDAK',
  ),
  
);


$combolist["JN_MUAT"] = array (
  0 =>
  array (
    'id' => 'TANPA KEMASAN',
    '' => 'TANPA KEMASAN',
  ),
  1 =>
  array (
    'id' => 'DENGAN KEMASAN',
    '' => 'DENGAN KEMASAN',
  ),
);

 //$sql= "select KD_KETERANGAN_PANDU,KETERANGAN from MST_KETERANGAN_PANDU";
 //add by Tofan (Khusus & Darurat) 14032013
 $sql= "select KD_KETERANGAN_PANDU,KETERANGAN from MST_KETERANGAN_PANDU WHERE AKTIF='Y'";
 $rs = $db->query($sql);
 $combolist["KET_PANDU"] = $rs->getAll();
 
 $sql= "select KD_KETERANGAN_PANDU KD_KETERANGAN_PANDU_KHUSUS,KETERANGAN from MST_KET_PANDU_KHUSUS WHERE AKTIF='Y'";
 $rs = $db->query($sql);
 $combolist["KET_PANDU_KHUSUS"] = $rs->getAll();

 $sql= "Select * from mst_kepil";
 $rs = $db->query($sql);

 $combolist["KD_MST_KEPIL"] = $rs->getAll();

?>

<script language="JavaScript" src="{$HOME}js/jquery.taconite.js"></script>
<script type="text/javascript">
<!--auto kode ppkb-->
// Start Edit 31 Januari 2018, Validasi kapal tunda
		function validateTunda(){
	  		var kp_loa = $('#KP_LOA').val();
	  		var min_kpl_tunda = $('#MIN_KPL_TUNDA').val();
	  		var tunda1 = $('#KD_TUNDA_1').val();
	  		var tunda2 = $('#KD_TUNDA_2').val();
	  		var tunda3 = $('#KD_TUNDA_3').val();
	  		var tunda4 = $('#KD_TUNDA_4').val();
	  		var tunda5 = $('#KD_TUNDA_5').val();
	  		var tunda6 = $('#KD_TUNDA_6').val();
			if (min_kpl_tunda == 1) {
	  			if (tunda1 != ''){
	  				//swal("teruskan");
	  				myFunction();
	  				//submitForm('dataForm');
	  			} else {
	  				swal({
					  title: "Warning!",
					  type:"error",
					  text: "LOA = "+kp_loa+" | Anda wajib menggunakan 1 kapal tunda!",
					  allowOutsideClick: false
					});
	  			}
	  		}
	  		else if (min_kpl_tunda == 2) {
	  			if (tunda1 != '' && tunda2 != ''){
	  				// swal("teruskan");
	  				myFunction();
	  				//submitForm('dataForm');
	  			} else{
	  				swal({
					  title: "Warning!",
					  type:"error",
					  text: "LOA = "+kp_loa+" | Anda wajib menggunakan 2 kapal tunda!",
					  allowOutsideClick: false
					});
	  			}
	  		}
	  		else if (min_kpl_tunda == 3) {
	  			if (tunda1 != '' && tunda2 != '' && tunda3 != ''){
	  				// swal("teruskan");
	  				myFunction();
	  				//submitForm('dataForm');
	  			} else {
	  				swal({
					  title: "Warning!",
					  type:"error",
					  text: "LOA = "+kp_loa+" | Anda wajib menggunakan 3 kapal tunda!",
					  allowOutsideClick: false
					});	
	  			}
	  		}
	  		else{
	  			// swal("teruskan");
	  			myFunction();
	  			//submitForm('dataForm');
	  		}
	  	}
	  	// End Edit 31 Januari 2018, Validasi kapal tunda

	function popfill_PBM(kd_pbm,nm_pbm) {
		$('#KD_PBM').val(kd_pbm);
		$('#NM_PBM').val(nm_pbm);
		setTimeout("$('#popsuggestions').hide();", 200);
	}

	function popuphide() {
		setTimeout("$('#popsuggestions').hide();", 200);
	}
	
	function fillData(){
		var keyid = $('#NO_SPK_PANDU').val();
		var status_ex = $('#STATUS_EX').val();
		$.get('{$HOME}<? echo APPID;?>/control/?action=chgrecord&keyid='+keyid);
		if(status_ex == '1'){
				alert ('PPKB ini telah membuat PPKB perubahan atau pembatalan mohon di periksa lagi PPKB-nya');
			}
		
		//tabChange()
	}
	function fillData_PETUGAS_PANDU() {
		var keyid = $('#KD_PERS_PANDU').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_petugas_pandu/?action=chgrecord&keyid='+keyid);
	}
	function fillData_KADE() {
		var keyid = $('#PANDU_DARI').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kade/?action=chgrecord&keyid='+keyid);
	}
	function fillData_KADE2() {
		var keyid = $('#PANDU_KE').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kade/?action=chgrecord2&keyid='+keyid);
	}
	
	function fillData_FAS_PANDU() {
		var keyid = $('#KD_FAS_PANDU').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord_p&keyid='+keyid);
	}
	function fillData_FAS_PANDU_JEMPUT() {
		var keyid = $('#KD_FAS_PANDU_JEMPUT').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord_p&keyid='+keyid);
	}
	function fillData_NM_NAHKODA() {
		var keyid = $('#KD_NM_NAHKODA').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_nm_nahkoda/?action=chgrecord&keyid='+keyid);
	}
	
	function fillData_KD_TUNDA_1() {
		var keyid = $('#KD_TUNDA_1').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord&keyid='+keyid);
	}
	function fillData_KD_TUNDA_2() {
		var keyid = $('#KD_TUNDA_2').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord2&keyid='+keyid);
	}
	function fillData_KD_TUNDA_3() {
		var keyid = $('#KD_TUNDA_3').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord3&keyid='+keyid);
	}
	function fillData_KD_TUNDA_4() {
		var keyid = $('#KD_TUNDA_4').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord4&keyid='+keyid);
	}
	function fillData_KD_TUNDA_5() {
		var keyid = $('#KD_TUNDA_5').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord5&keyid='+keyid);
	}
	function fillData_KD_TUNDA_6() {
		var keyid = $('#KD_TUNDA_6').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecord6&keyid='+keyid);
	}
	function fillData_FAS_KEPIL() {
		var keyid = $('#KD_FAS_KEPIL').val();
		//alert (keyid);
		$.get('{$HOME}<? echo APPID;?>/control_kapal_fasilitas/?action=chgrecordk&keyid='+keyid);
	}
	
</script>
<!--popup kode spk-->
<script type="text/javascript">
	function close(){
		$.unblockUI();
		setTimeout($('#suggestions').hide(), 200);
	}
	
	function popup_SPK(NO_SPK_PANDU) {
					var pop_SPK = '<iframe src="{$HOME}<?php echo APPID;?>.popup_ppkb/" width="99%" height="450px" ></iframe>';
					var position = $('#KD_PPKB').position();
					$.blockUI({message: $(pop_SPK)});	
					//$('#popsuggestions').css({"left":position.left+80,"top":position.top-80}).show();
					//$('#popsuggestions').html(pop_SPK);
	} // popup

	// start edit 29 januari 2018, penambahan variable KP_LOA
	function popfill_SPK(NO_SPK_PANDU,STATUS_EX, kp_loa, min_kpl_tunda) {
	  //alert(NO_SPK_PANDU);
		$('#NO_SPK_PANDU').val(NO_SPK_PANDU);
		$('#STATUS_EX').val(STATUS_EX);
		$('#KP_LOA').val(kp_loa);
		$('#LOA').val(kp_loa);
		$('#MIN_KPL_TUNDA').val(min_kpl_tunda);

		// start edit 31 Januari 2018, notifikasi require kapal tunda
		if (min_kpl_tunda === 1) {
	  		$('#notif_KD_TUNDA_1').show();
	  	} 
	  	else if (min_kpl_tunda === 2) {
	  		$('#notif_KD_TUNDA_1').show();
	  		$('#notif_KD_TUNDA_2').show();
	  	}
	  	else if (min_kpl_tunda === 3) {
	  		$('#notif_KD_TUNDA_1').show();
	  		$('#notif_KD_TUNDA_2').show();
	  		$('#notif_KD_TUNDA_3').show();	  		
	  	}
	  	else {
	  		$('#notif_KD_TUNDA_1').hide();
	  		$('#notif_KD_TUNDA_2').hide();
	  		$('#notif_KD_TUNDA_3').hide();	  		
	  	}
	  	// end edit 31 Januari 2018, notifikasi require kapal tunda

		//alert(STATUS_EX);
		setTimeout("$('#popsuggestions').hide();", 200);
		fillData();
		$.unblockUI(); 	

		
	}

	function popuphide() {
		setTimeout("$('#popsuggestions').hide();", 200);
	}
</script>

<script type="text/javascript">
	/*$(document).ready(function(){ 
		$('#TGL_MPANDU_day').change(function () {
		  		var TANGGAL = $("#TGL_MPANDU_day").val();
		  alert (TANGGAL);
		 }).trigger('change');

		});
	*/
	$(function(){
	   $('#ubah_tab').click(function (){
			var LABUH = $("#LABUH_PASS").val();
			var PANDU = $("#PANDU_PASS").val();
			var TAMBAT = $("#TAMBAT_PASS").val();
			var TUNDA= $("#TUNDA_PASS").val();
			var AIR = $("#AIR_PASS").val();
			var KEPIL = $("#KEPIL_PASS").val();
			var TUGBOAT = $("#JN_KAPAL").val();
			var PPKB_KE = $("#PPKB_KE").val();
			var SERVICE = $("#KD_SERVICE_CODE").val();
			var KD_TJN = $("#KADE_TUJUAN").val();
			var KD_ASAL = $("#PANDU_DARI").val();
			var KP_LOA = $("#KP_LOA").val();
			var MIN_KPL_TUNDA = $("#MIN_KPL_TUNDA").val();
			var KET_PANDU_KHUSUS_CB = $("#KET_PANDU_KHUSUS").val();		
			
			
			if ((LABUH == 1)||(SERVICE == 8)|| (KD_ASAL == '9999')||(KD_TJN == '9999')){
				$("#tabLabuh").attr("style","visibility:visible");
				//$("li[pandu]").hidden();
				//alert(TUGBOAT);	
			} else {
				$("#tabLabuh").attr("style","visibility:hidden");
				//alert(KEPIL);
			}
			
			if (PANDU == 1) {
				$("#tabPandu").attr("style","visibility:visible");
				//alert(KEPIL);	
			} else {
				$("#tabPandu").attr("style","visibility:hidden");
				//alert(KEPIL);
			}
			
			if (PANDU == 1) {
				$("#tabTunda").attr("style","visibility:visible");
				//alert(KEPIL);	
			} else {
				$("#tabTunda").attr("style","visibility:hidden");
				//alert("Kapal Tidak mengambil layanan Tunda Pada Saat PPKB");
			}
			
			if (PANDU == 1) {
				$("#tabKepil").attr("style","visibility:visible");
				//alert(KEPIL);	
			} else {
				$("#tabKepil").attr("style","visibility:hidden");
				//alert(KEPIL);
			}
			
			if ((TUGBOAT == '08')){
				//$("#tongkang").attr("style","visibility:visible");
				$("#tugboad").attr("style","visibility:visible");
				
				//alert(KEPIL);	
			} else {
				//$("#tongkang").attr("style","visibility:hidden");
				$("#tugboad").attr("style","visibility:hidden");
				//alert(KEPIL);
			}
			
			//alert (KD_ASAL);
			if (KD_ASAL == '9999'){
				$('#KD_GERAKAN').val(0);
				$('#PANDU_DARI').attr("readonly","readonly");
			}else if(KD_TJN == '9999'){
				$('#KD_GERAKAN').val(2);
				$('#PANDU_KE').attr("readonly","readonly");
			}else {
				$('#KD_GERAKAN').val(1);
				//$('#KD_GERAKAN').attr("disabled","true");
			}
			
			if (MIN_KPL_TUNDA == 0 && KET_PANDU_KHUSUS_CB == 1){				
				$('#tunda1_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda2_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda3_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda4_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda5_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda6_remark').text("**").css('color', 'green').css('font-weight', 'bold');
			}else if(MIN_KPL_TUNDA == 1 && KET_PANDU_KHUSUS_CB == 1){
				$('#tunda1_remark').text("*").css('color', 'blue').css('font-weight', 'bold');
				$('#tunda2_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda3_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda4_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda5_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda6_remark').text("**").css('color', 'green').css('font-weight', 'bold');
			}else if(MIN_KPL_TUNDA == 2 && KET_PANDU_KHUSUS_CB == 1){
				$('#tunda1_remark').text("*").css('color', 'blue').css('font-weight', 'bold');
				$('#tunda2_remark').text("*").css('color', 'blue').css('font-weight', 'bold');
				$('#tunda3_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda4_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda5_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda6_remark').text("**").css('color', 'green').css('font-weight', 'bold');
			}else if(MIN_KPL_TUNDA == 3 && KET_PANDU_KHUSUS_CB == 1){
				$('#tunda1_remark').text("*").css('color', 'blue').css('font-weight', 'bold');
				$('#tunda2_remark').text("*").css('color', 'blue').css('font-weight', 'bold');
				$('#tunda3_remark').text("*").css('color', 'blue').css('font-weight', 'bold');
				$('#tunda4_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda5_remark').text("**").css('color', 'green').css('font-weight', 'bold');
				$('#tunda6_remark').text("**").css('color', 'green').css('font-weight', 'bold');
			}else if(KET_PANDU_KHUSUS_CB == 17){
				$('#tunda1_remark').text("***").css('color', 'red').css('font-weight', 'bold');
				$('#tunda2_remark').text("***").css('color', 'red').css('font-weight', 'bold');
				$('#tunda3_remark').text("***").css('color', 'red').css('font-weight', 'bold');
				$('#tunda4_remark').text("***").css('color', 'red').css('font-weight', 'bold');
				$('#tunda5_remark').text("***").css('color', 'red').css('font-weight', 'bold');
				$('#tunda6_remark').text("***").css('color', 'red').css('font-weight', 'bold');
			}					
			
	   });
	});
</script>

<script type="text/javascript">
	function popup_KD_KADE_AIR(popString_KD_KADE_AIR) { 
		var pop_KD_KADE_AIR = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=KD_KADE_AIR" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_KADE_AIR').position();
		$.blockUI({message: $(pop_KD_KADE_AIR)});	
	} // popup

	function popfill_KD_KADE_AIR(valkey,labelkey) {
		$('#popString_KD_KADE_AIR').val(valkey);
		$('#KD_KADE_AIR').val(valkey);
		$('#ref_KD_KADE_AIR').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_KADE_KEPIL(popString_KD_KADE_KEPIL) { 
		var pop_KD_KADE_KEPIL = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=KD_KADE_KEPIL" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_KADE_KEPIL').position();
		$.blockUI({message: $(pop_KD_KADE_KEPIL)});	
	} // popup

	function popfill_KD_KADE_KEPIL(valkey,labelkey) {
		$('#popString_KD_KADE_KEPIL').val(valkey);
		$('#KD_KADE_KEPIL').val(valkey);
		$('#ref_KD_KADE_KEPIL').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_FAS_KEPIL(popString_KD_FAS_KEPIL) { 
		var pop_KD_FAS_KEPIL = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_kepil/?kode=KD_FAS_KEPIL" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_FAS_KEPIL').position();
		$.blockUI({message: $(pop_KD_FAS_KEPIL)});	
	} // popup

	function popfill_KD_FAS_KEPIL(valkey,labelkey) {
		//alert(valkey);
		$('#popString_KD_FAS_KEPIL').val(valkey);
		$('#KD_FAS_KEPIL').val(valkey);
		$('#ref_KD_FAS_KEPIL').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_KADE_TAMBAT(popString_KD_KADE_TAMBAT) { 
		var pop_KD_KADE_TAMBAT = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=KD_KADE_TAMBAT" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_KADE_TAMBAT').position();
		$.blockUI({message: $(pop_KD_KADE_TAMBAT)});	
	} // popup

	function popfill_KD_KADE_TAMBAT(valkey,labelkey) {
		$('#popString_KD_KADE_TAMBAT').val(valkey);
		$('#KD_KADE_TAMBAT').val(valkey);
		$('#ref_KD_KADE_TAMBAT').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_TUNDA_DARI(popString_TUNDA_DARI) { 
		var pop_TUNDA_DARI = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=TUNDA_DARI" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_TUNDA_DARI').position();
		$.blockUI({message: $(pop_TUNDA_DARI)});	
	} // popup

	function popfill_TUNDA_DARI(valkey,labelkey) {
		$('#popString_TUNDA_DARI').val(valkey);
		$('#TUNDA_DARI').val(valkey);
		$('#ref_TUNDA_DARI').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_TUNDA_KE(popString_TUNDA_KE) { 
		var pop_TUNDA_KE = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=TUNDA_KE" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_TUNDA_KE').position();
		$.blockUI({message: $(pop_TUNDA_KE)});	
	} // popup

	function popfill_TUNDA_KE(valkey,labelkey) {
		$('#popString_TUNDA_KE').val(valkey);
		$('#TUNDA_KE').val(valkey);
		$('#ref_TUNDA_KE').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	
	
	function popup_PANDU_DARI(popString_PANDU_DARI) { 
		var PPKB_KE = $("#PPKB_KE").val();
		if (PPKB_KE != 1){
			var pop_PANDU_DARI = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=PANDU_DARI" width="99%" height="300px" style="border:0px"></iframe>';
			var position = $('#popString_PANDU_DARI').position();
			$.blockUI({message: $(pop_PANDU_DARI)});
		}
	} // popup

	function popfill_PANDU_DARI(valkey,labelkey) {
		$('#popString_PANDU_DARI').val(valkey);
		$('#PANDU_DARI').val(valkey);
		$('#ref_PANDU_DARI').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_PANDU_KE(popString_PANDU_KE) { 
		var SERVICE = $("#KD_SERVICE_CODE").val();
		if (SERVICE != '8'){
			var pop_PANDU_KE = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kade/?kode=PANDU_KE" width="99%" height="300px" style="border:0px"></iframe>';
			var position = $('#popString_PANDU_KE').position();
			$.blockUI({message: $(pop_PANDU_KE)});
		}
	} // popup

	function popfill_PANDU_KE(valkey,labelkey) {
		$('#popString_PANDU_KE').val(valkey);
		$('#PANDU_KE').val(valkey);
		$('#ref_PANDU_KE').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_FAS_PANDU(popString_KD_FAS_PANDU) { 
		var pop_KD_FAS_PANDU = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_pandu/?kode=KD_FAS_PANDU" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_FAS_PANDU').position();
		$.blockUI({message: $(pop_KD_FAS_PANDU)});	
	} // popup

	function popfill_KD_FAS_PANDU(valkey,labelkey) {
		$('#popString_KD_FAS_PANDU').val(valkey);
		$('#KD_FAS_PANDU').val(valkey);
		$('#ref_KD_FAS_PANDU').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_FAS_PANDU_JEMPUT(popString_KD_FAS_PANDU_JEMPUT) { 
		var pop_KD_FAS_PANDU_JEMPUT = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_pandu/?kode=KD_FAS_PANDU_JEMPUT" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_FAS_PANDU_JEMPUT').position();
		$.blockUI({message: $(pop_KD_FAS_PANDU_JEMPUT)});	
	} // popup

	function popfill_KD_FAS_PANDU_JEMPUT(valkey,labelkey) {
		$('#popString_KD_FAS_PANDU_JEMPUT').val(valkey);
		$('#KD_FAS_PANDU_JEMPUT').val(valkey);
		$('#ref_KD_FAS_PANDU_JEMPUT').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_FAS_TUNDA1(popString_KD_FAS_TUNDA1) { 
		var pop_KD_FAS_TUNDA1 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas/?kode=KD_FAS_TUNDA1" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_FAS_TUNDA1').position();
		$.blockUI({message: $(pop_KD_FAS_TUNDA1)});	
	} // popup

	function popfill_KD_FAS_TUNDA1(valkey,labelkey) {
		$('#popString_KD_FAS_TUNDA1').val(valkey);
		$('#KD_FAS_TUNDA1').val(valkey);
		$('#ref_KD_FAS_TUNDA1').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_FAS_TUNDA2(popString_KD_FAS_TUNDA2) { 
		var pop_KD_FAS_TUNDA2 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas/?kode=KD_FAS_TUNDA2" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_FAS_TUNDA2').position();
		$.blockUI({message: $(pop_KD_FAS_TUNDA2)});	
	} // popup

	function popfill_KD_FAS_TUNDA2(valkey,labelkey) {
		$('#popString_KD_FAS_TUNDA2').val(valkey);
		$('#KD_FAS_TUNDA2').val(valkey);
		$('#ref_KD_FAS_TUNDA2').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_FAS_TUNDA3(popString_KD_FAS_TUNDA3) { 
		var pop_KD_FAS_TUNDA3 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas/?kode=KD_FAS_TUNDA3" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_FAS_TUNDA3').position();
		$.blockUI({message: $(pop_KD_FAS_TUNDA3)});	
	} // popup

	function popfill_KD_FAS_TUNDA3(valkey,labelkey) {
		$('#popString_KD_FAS_TUNDA3').val(valkey);
		$('#KD_FAS_TUNDA3').val(valkey);
		$('#ref_KD_FAS_TUNDA3').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>


<script type="text/javascript">
	function popup_KD_MST_KEPIL(popString_KD_MST_KEPIL) { 
		var pop_KD_MST_KEPIL = '<iframe src="{$HOME}<?php echo APPID;?>.popup_kepil/?kode=KD_MST_KEPIL" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_MST_KEPIL').position();
		$.blockUI({message: $(pop_KD_MST_KEPIL)});	
	} // popup

	function popfill_KD_MST_KEPIL(valkey,labelkey) {
		$('#popString_KD_MST_KEPIL').val(valkey);
		$('#KD_MST_KEPIL').val(valkey);
		$('#ref_KD_MST_KEPIL').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_PERS_PANDU(popString_KD_PERS_PANDU) { 
		var pop_KD_PERS_PANDU = '<iframe src="{$HOME}<?php echo APPID;?>.popup_pers_pandu/?kode=KD_PERS_PANDU" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_PERS_PANDU').position();
		$.blockUI({message: $(pop_KD_PERS_PANDU)});	
	} // popup

	function popfill_KD_PERS_PANDU(valkey,valkey2,labelkey) {
		$('#popString_KD_PERS_PANDU').val(valkey);
		$('#KD_PERS_PANDU').val(valkey);
		$('#KD_PERS_PANDU_NEW').val(valkey2);
		$('#ref_KD_PERS_PANDU').text(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_NM_NAHKODA(popString_KD_NM_NAHKODA) { 
		var pop_KD_NM_NAHKODA = '<iframe src="{$HOME}<?php echo APPID;?>.popup_mst_nahkoda/?kode=KD_NM_NAHKODA" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_NM_NAHKODA').position();
		$.blockUI({message: $(pop_KD_NM_NAHKODA)});	
	} // popup

	function popfill_KD_NM_NAHKODA(valkey,labelkey) {
		$('#popString_KD_NM_NAHKODA').val(valkey);
		$('#KD_NM_NAHKODA').val(valkey);
		$('#ref_KD_NM_NAHKODA').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_TUNDA_1(popString_KD_TUNDA_1) { 
		var kd_tunda1 = $('#KD_TUNDA_1').val();
		var kd_tunda2 = $('#KD_TUNDA_2').val();
		var kd_tunda3 = $('#KD_TUNDA_3').val();
		var kd_tunda4 = $('#KD_TUNDA_4').val();
		var kd_tunda5 = $('#KD_TUNDA_5').val();
		var kd_tunda6 = $('#KD_TUNDA_6').val();
		var pop_KD_TUNDA_1 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_tunda/?kode=KD_TUNDA_1&kd_tunda1='+kd_tunda1+'&kd_tunda2='+kd_tunda2+'&kd_tunda3='+kd_tunda3+'&kd_tunda4='+kd_tunda4+'&kd_tunda5='+kd_tunda5+'&kd_tunda6='+kd_tunda6+'" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_TUNDA_1').position();
		$.blockUI({message: $(pop_KD_TUNDA_1)});	
	} // popup

	function popfill_KD_TUNDA_1(valkey,labelkey) {
		$('#popString_KD_TUNDA_1').val(valkey);
		$('#KD_TUNDA_1').val(valkey);
		$('#ref_KD_TUNDA_1').text(labelkey);	
		$('#notif_KD_TUNDA_1').hide();	
		//$('#ref_KD_TUNDA_1').val('tes');		
		//$('#ref_KD_TUNDA_1').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>
<script type="text/javascript">
	function popup_KD_TUNDA_2(popString_KD_TUNDA_2) { 
		var kd_tunda1 = $('#KD_TUNDA_1').val();
		var kd_tunda2 = $('#KD_TUNDA_2').val();
		var kd_tunda3 = $('#KD_TUNDA_3').val();
		var kd_tunda4 = $('#KD_TUNDA_4').val();
		var kd_tunda5 = $('#KD_TUNDA_5').val();
		var kd_tunda6 = $('#KD_TUNDA_6').val();
		var pop_KD_TUNDA_2 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_tunda/?kode=KD_TUNDA_2&kd_tunda1='+kd_tunda1+'&kd_tunda2='+kd_tunda2+'&kd_tunda3='+kd_tunda3+'&kd_tunda4='+kd_tunda4+'&kd_tunda5='+kd_tunda5+'&kd_tunda6='+kd_tunda6+'" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_TUNDA_2').position();
		$.blockUI({message: $(pop_KD_TUNDA_2)});	
	} // popup

	function popfill_KD_TUNDA_2(valkey,labelkey) {
		$('#popString_KD_TUNDA_2').val(valkey);
		$('#KD_TUNDA_2').val(valkey);
		$('#ref_KD_TUNDA_2').text(labelkey);
		$('#notif_KD_TUNDA_2').hide();
		//$('#ref_KD_TUNDA_2').replaceWith(labelkey);
		$.unblockUI(); 
	}
	
</script>

<script type="text/javascript">
	function popup_KD_TUNDA_3(popString_KD_TUNDA_3) { 
		var kd_tunda1 = $('#KD_TUNDA_1').val();
		var kd_tunda2 = $('#KD_TUNDA_2').val();
		var kd_tunda3 = $('#KD_TUNDA_3').val();
		var kd_tunda4 = $('#KD_TUNDA_4').val();
		var kd_tunda5 = $('#KD_TUNDA_5').val();
		var kd_tunda6 = $('#KD_TUNDA_6').val();
		var pop_KD_TUNDA_3 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_tunda/?kode=KD_TUNDA_3&kd_tunda1='+kd_tunda1+'&kd_tunda2='+kd_tunda2+'&kd_tunda3='+kd_tunda3+'&kd_tunda4='+kd_tunda4+'&kd_tunda5='+kd_tunda5+'&kd_tunda6='+kd_tunda6+'" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_TUNDA_3').position();
		$.blockUI({message: $(pop_KD_TUNDA_3)});	
	} // popup

	function popfill_KD_TUNDA_3(valkey,labelkey) {
		$('#popString_KD_TUNDA_3').val(valkey);
		$('#KD_TUNDA_3').val(valkey);
		$('#ref_KD_TUNDA_3').text(labelkey);
		$('#notif_KD_TUNDA_3').hide();
		//$('#ref_KD_TUNDA_3').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_TUNDA_4(popString_KD_TUNDA_4) { 
		var kd_tunda1 = $('#KD_TUNDA_1').val();
		var kd_tunda2 = $('#KD_TUNDA_2').val();
		var kd_tunda3 = $('#KD_TUNDA_3').val();
		var kd_tunda4 = $('#KD_TUNDA_4').val();
		var kd_tunda5 = $('#KD_TUNDA_5').val();
		var kd_tunda6 = $('#KD_TUNDA_6').val();
		var pop_KD_TUNDA_4 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_tunda/?kode=KD_TUNDA_4&kd_tunda1='+kd_tunda1+'&kd_tunda2='+kd_tunda2+'&kd_tunda3='+kd_tunda3+'&kd_tunda4='+kd_tunda4+'&kd_tunda5='+kd_tunda5+'&kd_tunda6='+kd_tunda6+'" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_TUNDA_4').position();
		$.blockUI({message: $(pop_KD_TUNDA_4)});	
	} // popup

	function popfill_KD_TUNDA_4(valkey,labelkey) {
		$('#popString_KD_TUNDA_4').val(valkey);
		$('#KD_TUNDA_4').val(valkey);
		$('#ref_KD_TUNDA_4').text(labelkey);
		$('#notif_KD_TUNDA_4').hide();
		//$('#ref_KD_TUNDA_3').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_TUNDA_5(popString_KD_TUNDA_5) { 
		var kd_tunda1 = $('#KD_TUNDA_1').val();
		var kd_tunda2 = $('#KD_TUNDA_2').val();
		var kd_tunda3 = $('#KD_TUNDA_3').val();
		var kd_tunda4 = $('#KD_TUNDA_4').val();
		var kd_tunda5 = $('#KD_TUNDA_5').val();
		var kd_tunda6 = $('#KD_TUNDA_6').val();
		var pop_KD_TUNDA_5 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_tunda/?kode=KD_TUNDA_5&kd_tunda1='+kd_tunda1+'&kd_tunda2='+kd_tunda2+'&kd_tunda3='+kd_tunda3+'&kd_tunda4='+kd_tunda4+'&kd_tunda5='+kd_tunda5+'&kd_tunda6='+kd_tunda6+'" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_TUNDA_5').position();
		$.blockUI({message: $(pop_KD_TUNDA_5)});	
	} // popup

	function popfill_KD_TUNDA_5(valkey,labelkey) {
		$('#popString_KD_TUNDA_5').val(valkey);
		$('#KD_TUNDA_5').val(valkey);
		$('#ref_KD_TUNDA_5').text(labelkey);
		$('#notif_KD_TUNDA_5').hide();
		//$('#ref_KD_TUNDA_3').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_TUNDA_6(popString_KD_TUNDA_6) { 
		var kd_tunda1 = $('#KD_TUNDA_1').val();
		var kd_tunda2 = $('#KD_TUNDA_2').val();
		var kd_tunda3 = $('#KD_TUNDA_3').val();
		var kd_tunda4 = $('#KD_TUNDA_4').val();
		var kd_tunda5 = $('#KD_TUNDA_5').val();
		var kd_tunda6 = $('#KD_TUNDA_6').val();
		var pop_KD_TUNDA_6 = '<iframe src="{$HOME}<?php echo APPID;?>.popup_fasilitas_tunda/?kode=KD_TUNDA_6&kd_tunda1='+kd_tunda1+'&kd_tunda2='+kd_tunda2+'&kd_tunda3='+kd_tunda3+'&kd_tunda4='+kd_tunda4+'&kd_tunda5='+kd_tunda5+'&kd_tunda6='+kd_tunda6+'" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_TUNDA_6').position();
		$.blockUI({message: $(pop_KD_TUNDA_6)});	
	} // popup

	function popfill_KD_TUNDA_6(valkey,labelkey) {
		$('#popString_KD_TUNDA_6').val(valkey);
		$('#KD_TUNDA_6').val(valkey);
		$('#ref_KD_TUNDA_6').text(labelkey);
		$('#notif_KD_TUNDA_6').hide();
		//$('#ref_KD_TUNDA_3').replaceWith(labelkey);
		$.unblockUI(); 
	}
</script>

<script type="text/javascript">
	function popup_KD_MORING(popString_KD_MORING) { 
		var pop_KD_MORING = '<iframe src="{$HOME}<?php echo APPID;?>.popup_moring/?kode=KD_MORING" width="99%" height="300px" style="border:0px"></iframe>';
		var position = $('#popString_KD_MORING').position();
		$.blockUI({message: $(pop_KD_MORING)});	
	} // popup

	function popfill_KD_MORING(valkey,labelkey) {
		$('#popString_KD_MORING').val(valkey);
		$('#KD_MORING').val(valkey);
		$('#ref_KD_MORING').replaceWith(labelkey);
		$.unblockUI(); 
	}
	
</script>
<script type="text/javascript">
	function popup_TUG_BOAT(TUG_BOAT) { 
					var pop_TUG_BOAT = '<iframe src="{$HOME}<? echo APPID;?>.popup_pkk_tugboat/?kode=TUG_BOAT" width="99%" height="450px" ></iframe>';
					var position = $('#TUG_BOAT').position();
					$.blockUI({message: $(pop_TUG_BOAT)});	
	} // popup

	function popfill_TUG_BOAT(no_ukk,ket) {
		//alert (ket);
		if ($("#NO_UKK").val() != no_ukk) {
		$('#TUG_BOAT1').val(no_ukk);
		$('#ref_TUG_BOAT1').replaceWith(ket);
		} else {
		 alert("NO UKK Kapal Tug Boat 1 sama dengan No UKK pada PPKB");
		}
		
		if ( no_ukk == $("#TUG_BOAT2").val() || no_ukk == $("#TUG_BOAT3").val() ) {
			alert("NO PKK Tug Boat tidak boleh ada yang sama");
			$('#TUG_BOAT1').val("");
			$('#ref_TUG_BOAT1').replaceWith("");
		}
		//alert (no_ukk);
		$.unblockUI();
	}
</script>

<script type="text/javascript">
	function popup_TUG_BOAT2(TUG_BOAT) { 
					var pop_TUG_BOAT = '<iframe src="{$HOME}<? echo APPID;?>.popup_pkk_tugboat/?kode=TUG_BOAT2" width="99%" height="450px" ></iframe>';
					var position = $('#TUG_BOAT').position();
					$.blockUI({message: $(pop_TUG_BOAT)});	
	} // popup

	function popfill_TUG_BOAT2(no_ukk,ket) {
		if ($("#NO_UKK").val() != no_ukk) {
		$('#TUG_BOAT2').val(no_ukk);
		$('#ref_TUG_BOAT2').replaceWith(ket);
		} else {
		 alert("NO PKK Kapal Tug Boat sama dengan No PKK pada PPKB");
		}
		
		if ( no_ukk == $("#TUG_BOAT1").val() || no_ukk == $("#TUG_BOAT3").val() ) {
			alert("NO PKK Tug Boat tidak boleh ada yang sama");
			$('#TUG_BOAT2').val("");
			$('#ref_TUG_BOAT2').replaceWith("");
		}		
		$.unblockUI();
	}
</script>
<script type="text/javascript">
	function popup_TK1(TK) { 
					var pop_TK = '<iframe src="{$HOME}<? echo APPID;?>.popup_pkk_tongkang/?kode=TK1" width="99%" height="450px" ></iframe>';
					var position = $('#TONGKANG1').position();
					$('#popsuggestions').css({"left":position.left+80,"top":position.top-80}).show();
					$('#popsuggestions').html(pop_TK);
					//$.blockUI({message: $(popup_TK1)});
	} // popup

	function popfill_TK1(no_ukk) {
		if ($("#NO_UKK").val() != no_ukk) {
		$('#TONGKANG1').val(no_ukk);
		} else {
		 alert("NO PKK Kapal Tongkang sama dengan No PKK pada Bukti");
		}
		if ( no_ukk == $("#TONGKANG2").val() ) {
			alert("NO PKK Tongkang tidak boleh ada yang sama");
			$('#TONGKANG1').val("");
		}		
		setTimeout("$('#popsuggestions').hide();", 200);
	}
</script>

<script type="text/javascript">
	function popup_TK2(TK) { 
					var pop_TK = '<iframe src="{$HOME}<? echo APPID;?>.popup_pkk_tongkang/?kode=TK2" width="99%" height="450px" ></iframe>';
					var position = $('#TONGKANG1').position();
					$('#popsuggestions').css({"left":position.left+80,"top":position.top-80}).show();
					$('#popsuggestions').html(pop_TK);
					//$.blockUI({message: $(popup_TK2)});
	} // popup

	function popfill_TK2(no_ukk) {
		if ($("#NO_UKK").val() != no_ukk) {
		$('#TONGKANG2').val(no_ukk);
		} else {
		 alert("NO PKK Kapal Tongkang sama dengan No PKK pada Bukti");
		}
		if ( no_ukk == $("#TONGKANG1").val() ) {
			alert("NO PKK Tongkang tidak boleh ada yang sama");
			$('#TONGKANG2').val("");
		}		
		setTimeout("$('#popsuggestions').hide();", 200);
	}
</script>
<script type="text/javascript">
	function popup_TUG_BOAT3(TUG_BOAT) { 
					var pop_TUG_BOAT = '<iframe src="{$HOME}<? echo APPID;?>.popup_pkk_tugboat/?kode=TUG_BOAT3" width="99%" height="450px" ></iframe>';
					var position = $('#TUG_BOAT').position();
					$.blockUI({message: $(pop_TUG_BOAT)});
	} // popup

	function popfill_TUG_BOAT3(no_ukk,ket) {
		if ($("#NO_UKK").val() != no_ukk) {
		$('#TUG_BOAT3').val(no_ukk);
		$('#ref_TUG_BOAT3').replaceWith(ket);
		} else {
		 alert("NO PKK Kapal Tug Boat sama dengan No PKK pada PPKB");
		}
		if ( no_ukk == $("#TUG_BOAT1").val() || no_ukk == $("#TUG_BOAT2").val() ) {
			alert("NO PKK Tug Boat tidak boleh ada yang sama");
			$('#TUG_BOAT3').val("");
			$('#ref_TUG_BOAT3').replaceWith("");
		}		
		$.unblockUI();
	}
	
	function remove_KD_TUNDA(a, b, notif){
		$('#'+a).val('');
		$('#'+b).empty();
		$('#'+notif).show();
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#TGL_JAM_TIBA_KPL1_S").change(function(){
			for (var i = 2; i <= 6; i++) {
				$("#cal_TGL_JAM_TIBA_KPL"+i+"_day").val($("#cal_TGL_JAM_TIBA_KPL1_day").val());
				$("#cal_TGL_JAM_TIBA_KPL"+i+"_month").val($("#cal_TGL_JAM_TIBA_KPL1_month").val());
				$("#cal_TGL_JAM_TIBA_KPL"+i).val($("#cal_TGL_JAM_TIBA_KPL1").val());
			}
		}).trigger('change');

		$("#TGL_JAM_BRNGKT_KPL1_S").change(function(){
			for (var i = 2; i <= 6; i++) {
				$("#cal_TGL_JAM_BRNGKT_KPL"+i+"_day").val($("#cal_TGL_JAM_BRNGKT_KPL1_day").val());
				$("#cal_TGL_JAM_BRNGKT_KPL"+i+"_month").val($("#cal_TGL_JAM_BRNGKT_KPL1_month").val());
				$("#cal_TGL_JAM_BRNGKT_KPL"+i).val($("#cal_TGL_JAM_BRNGKT_KPL1").val());
			}
		}).trigger('change');
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	$("#cal_TGL_MPANDU").change(function(){
		$("#cal_JAM_PANDU_NAIK_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_PANDU_NAIK_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_PANDU_NAIK").val($("#cal_TGL_MPANDU").val());
		$("#cal_JAM_KAPAL_GERAK_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_KAPAL_GERAK_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_KAPAL_GERAK").val($("#cal_TGL_MPANDU").val());
		$("#cal_TGL_SPANDU_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_SPANDU_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_SPANDU").val($("#cal_TGL_MPANDU").val());
		$("#cal_JAM_PANDU_TURUN_day").val($("#cal_TGL_MPANDU_day").val());		
		$("#cal_JAM_PANDU_TURUN_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_PANDU_TURUN").val($("#cal_TGL_MPANDU").val());
		
		$("#cal_TGL_JAM_TIBA_KPL1_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_TIBA_KPL1_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_TIBA_KPL1").val($("#cal_TGL_MPANDU").val());
		
		$("#cal_TGL_JAM_BRNGKT_KPL1_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_BRNGKT_KPL1_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_BRNGKT_KPL1").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_TIBA_KPL2_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_TIBA_KPL2_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_TIBA_KPL2").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_BRNGKT_KPL2_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_BRNGKT_KPL2_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_BRNGKT_KPL2").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_TIBA_KPL3_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_TIBA_KPL3_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_TIBA_KPL3").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_BRNGKT_KPL3_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_BRNGKT_KPL3_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_BRNGKT_KPL3").val($("#cal_TGL_MPANDU").val());

		$("#cal_JAM_TOLAK_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_TOLAK_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_TOLAK").val($("#cal_TGL_MPANDU").val());
		$("#cal_JAM_TIBA_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_TIBA_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_TIBA").val($("#cal_TGL_MPANDU").val());

		// start edit 31 januari 2018, menghilangkan notifikasi require ketika form pertama kali di load
		$("#notif_KD_TUNDA_1").hide();
		$("#notif_KD_TUNDA_2").hide();
		$("#notif_KD_TUNDA_3").hide();
		// end edit 31 januari 2018, menghilangkan notifikasi require ketika form pertama kali di load

	}).trigger('change');
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
	$("#TGL_MPANDU_S").change(function(){
		$("#cal_JAM_PANDU_NAIK_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_PANDU_NAIK_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_PANDU_NAIK").val($("#cal_TGL_MPANDU").val());
		$("#cal_JAM_KAPAL_GERAK_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_KAPAL_GERAK_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_KAPAL_GERAK").val($("#cal_TGL_MPANDU").val());
		$("#cal_TGL_SPANDU_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_SPANDU_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_SPANDU").val($("#cal_TGL_MPANDU").val());
		$("#cal_JAM_PANDU_TURUN_day").val($("#cal_TGL_MPANDU_day").val());		
		$("#cal_JAM_PANDU_TURUN_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_PANDU_TURUN").val($("#cal_TGL_MPANDU").val());
		
		$("#cal_TGL_JAM_TIBA_KPL1_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_TIBA_KPL1_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_TIBA_KPL1").val($("#cal_TGL_MPANDU").val());
		
		$("#cal_TGL_JAM_BRNGKT_KPL1_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_BRNGKT_KPL1_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_BRNGKT_KPL1").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_TIBA_KPL2_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_TIBA_KPL2_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_TIBA_KPL2").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_BRNGKT_KPL2_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_BRNGKT_KPL2_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_BRNGKT_KPL2").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_TIBA_KPL3_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_TIBA_KPL3_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_TIBA_KPL3").val($("#cal_TGL_MPANDU").val());

		$("#cal_TGL_JAM_BRNGKT_KPL3_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_TGL_JAM_BRNGKT_KPL3_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_TGL_JAM_BRNGKT_KPL3").val($("#cal_TGL_MPANDU").val());

		$("#cal_JAM_TOLAK_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_TOLAK_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_TOLAK").val($("#cal_TGL_MPANDU").val());
		$("#cal_JAM_TIBA_day").val($("#cal_TGL_MPANDU_day").val());
		$("#cal_JAM_TIBA_month").val($("#cal_TGL_MPANDU_month").val());
		$("#cal_JAM_TIBA").val($("#cal_TGL_MPANDU").val());
	}).trigger('change');
	});
</script>

<script>
$(document).ready(function(){
		$("#KET_PANDU").change(function () {
			// alert ("TES");
			var ket_pandu = $("#KET_PANDU").val();
			//alert (ket_pandu);
			//edited by tofan 14032013
			//if(ket_pandu == '15'){
			if(ket_pandu == '17'){
				$("#EMERGENCY").attr("style","visibility:visible");
			}else{
				$("#EMERGENCY").attr("style","visibility:hidden");	
			}
			
									
									
		}).trigger('change');

	});
</script>


<div id="ubah_tab">
<span class="graybrown"><img src='images/dokumenbig.png' border='0' class="icon"/>{$formtitle}</span><br/>
  <br/>
  <form id="dataForm" action="{$formurl}" method="post" class="form-input">
    <input type="hidden" name="__pbkey" value="" />
	<input type="hidden" name="SC" id="SC" value="{$row.SC}" />

	<input type="hidden" name="AIR_C" id="AIR_C" value="{$row.AIR_C}" />
	<input type="hidden" name="LABUH_C" id="LABUH_C" value="{$row.LABUH_C}" />
	<input type="hidden" name="TAMBAT_C" id="TAMBAT_C" value="{$row.TAMBAT_C}" />
	<input type="hidden" name="KEPIL_C" id="KEPIL_C" value="{$row.KEPIL_C}" />
	<input type="hidden" name="PANDU_C" id="PANDU_C" value="{$row.PANDU_C}" />
	<input type="hidden" name="TUNDA_C" id="TUNDA_C" value="{$row.TUNDA_C}" />
    <input type="hidden" name="STATUS_EX" id="STATUS_EX" value="{$row.STATUS_EX}" />
	<input type="hidden" name="TGL_JAM_PMT_PANDU_D" id="TGL_JAM_PMT_PANDU_D" value="{$row.TGL_JAM_PMT_PANDU_D}" />
	<input type="hidden" name="KP_LOA" id="KP_LOA" value="{$row.KP_LOA}" />
	<input type="hidden" name="MIN_KPL_TUNDA" id="MIN_KPL_TUNDA" value="{$row.MIN_KPL_TUNDA}" />
  <table class="" cellspacing='2' cellpadding='2' border='0' width="84%">
  <tr>
    <td height="545" valign="top">
		

	<fieldset class="form-fieldset" width="300px">
          <legend style="font-size:14px;" class="form-field-caption">Informasi 
          Kunjungan Kapal</legend>
          <table width="907" border="0">
            <tr> 
              <td width="146" height="25" align="left" class="form-field-caption">No.SPK 
                Pandu</td>
              <td height="25" colspan="3" class="form-field-input">: 
                <input name="NO_SPK_PANDU" type="text" id="NO_SPK_PANDU" value="{$row.NO_SPK_PANDU}" /> 
                <img src="{$HOME}images/ico_autocomplete.gif" onclick="fillData();"> 
                <img src="{$HOME}images/ico_help.gif" onclick="popup_SPK(this.value);"> 
                <span id="nodata"></span>
                <div class="suggestionsBox" id="suggestions" style="display: none;"> 
                  <div class="suggestionList" id="autoSuggestionsList"> &nbsp;</div>
                  </div>
                <block visible="error.NO_SPK_PANDU"><span class="form-field-error">{$error.NO_SPK_PANDU}</span></block>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr> 
              <td width="146" height="25" align="left" class="form-field-caption"> 
                <div align="left">No PKK</div></td>
              <td height="25" class="form-field-input">: 
                <input name="NO_UKK" id="NO_UKK" onKeyUp="lookup_NO_UKK(this.value);" onBlur="fill_NO_UKK();" type="text" value="{$row.NO_UKK}" size="15" readonly="readonly"  /> 
                <div class="suggestionsBox" id="suggestions" style="display: none;"> 
                  <div class="suggestionList" id="autoSuggestionsList"> &nbsp;</div>
                </div></td>
              <td colspan="2"class="form-field-caption" align="right">Tgl jam 
                Tiba</td>
              <td width="332">: 
                <input name="TGL_JAM_TIBA" type="text" id="TGL_JAM_TIBA" value="{$row.TGL_JAM_TIBA}" readonly="readonly"/></td>
            </tr>
            <tr> 
              <td width="146" height="25" align="left" class="form-field-caption"> 
                <div align="left">Kode - Nama Kapal</div></td>
              <td height="25" class="form-field-input">: 
                <input name="KD_KAPAL" id="KD_KAPAL" type="text" value="{$row.KD_KAPAL}" size="5" maxlength="11" readonly="readonly" />
                - 
                <input type="text" id="NM_KAPAL" name="NM_KAPAL" value="{$row.NM_KAPAL}" size="15"  readonly="readonly"/></td>
              <td colspan="2"class="form-field-caption" align="right">Tgl jam 
                Berangkat</td>
              <td>: 
                <input name="TGL_JAM_BERANGKAT" type="text" id="TGL_JAM_BERANGKAT" value="{$row.TGL_JAM_BERANGKAT}" readonly="readonly" /></td>
            </tr>
            <tr> 
              <td width="146" height="25" align="right" class="form-field-caption"> 
                <div align="left">Kode - Nama Bendera</div></td>
              <td height="25"><block visible="error.NM_KAPAL"></block> : 
                <input name="KD_BENDERA" type="text" id="KD_BENDERA" value="{$row.KD_BENDERA}" size="5" readonly />
                - 
                <input name="NM_BENDERA" type="text" id="NM_BENDERA" size="20" value="{$row.NM_BENDERA}" readonly="readonly" /></td>
              <td colspan="2"class="form-field-caption" align="right">Gross Tonage</td>
              <td>: 
				<input name="GRT" type="text" id="KP_GRT" value="{$row.KP_GRT}" size="5" readonly /></td>
            </tr>
              <td width="146" height="25" align="right" class="form-field-caption"> 
                <div align="left">Jenis Kapal</div></td>
              <td height="25">: 
                <input id="JN_KAPAL" name="JN_KAPAL" type="text" value="{$row.JN_KAPAL}" size="3" maxlength="11" readonly="readonly" />
                - 
                <input name="NM_JN_KAPAL" type="text" id="NM_JN_KAPAL" value="{$row.NM_JN_KAPAL}" readonly="readonly" /> 
              </td>
              <td colspan="2"class="form-field-caption" align="right">LOA</td>
              <td>: 
				<input name="LOA" type="text" id="LOA" value="{$row.KP_LOA}" size="5" readonly /></td>
            </tr>
			<tr>
			
			<td width="146" height="25" align="right" class="form-field-caption"> 
                <div align="left">Nomor SPOG</div></td>
              <td height="25">: 
                <input id="NOMOR_SPOG" name="NOMOR_SPOG" type="text" value="{$row.NOMOR_SPOG}"  size="40" readonly="readonly" />
                </td>
                <td colspan="2"class="form-field-caption">Jenis Pelayaran</td>
              <td>: 
                <input name="NM_PLAYAR" type="text" id="NM_PLAYAR" value="{$row.KD_PELAYARAN}" maxlength="25" readonly="readonly" /> 
                &nbsp; <div class="suggestionsBox" id="suggestions" style="display: none;"> 
                  <div class="suggestionList" id="autoSuggestionsList"> &nbsp;</div>
                </div>
                <block visible="error.JN_PELAYARAN"></block></td>	
			</tr>

			</table>
      </fieldset>		<!--Data PKK-->
	  <fieldset class="form-fieldset" style="margin-bottom:10px;">
          <legend style="font-size:14px;" class="form-field-caption">Informasi 
          Permintaan Pelayanan Kapal dan Barang</legend>
          <table width="906" border="0">
            <tr> 
              <td width="151" height="24" class="form-field-caption" align="right"><div align="left">No 
                  PPKB - PPKB Ke</div></td>
              <td width="317" height="24" class=""><div align="left">: 
                  <input name="KD_PPKB" type="text" id="KD_PPKB" value="{$row.KD_PPKB}" readonly="readonly" />
                  - 
                  <input name="PPKB_KE" type="text" id="PPKB_KE" value="{$row.PPKB_KE}" size="1" readonly="readonly"/>
                </div></td>
              <td rowspan="3" align="right" class="form-field-caption"> <div align="left"> 
                  <fieldset class="form-fieldset" style="padding-top:5px; padding-bottom:5px;">
                  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                  <legend style="font-size:14px;" class="form-field-caption">Service 
                  Code</legend>
                  <input align="left" name="SERVICE_CODE" type="text" id="SERVICE_CODE" value="{$row.SERVICE_CODE}" size="20" readonly="readonly"/>
                  </fieldset>
                  <fieldset class="form-fieldset" style="padding-top:5px; padding-bottom:5px;">
                  <legend style="font-size:14px;" class="form-field-caption">Permintaan 
                  Pelayanan</legend>
                  <table width="227" border="0" style="margin-left:35px;">
                    <tr> 
                      <td colspan="3"> <br/> 
						
                      <label id="DET_LABUH" name="DET_LABUH"><?php if(($_POST['LABUH_PASS']==1)||($row["LABUH"])){?>LABUH,<?php }?></label> 
                        <label id="DET_PANDU" name="DET_PANDU"><?php if(($_POST['PANDU_PASS']==1)||($row['PANDU']==1)){?>PANDU,<?php }?></label> 
						<label id="DET_TAMBAT" name="DET_TAMBAT"><?php if(($_POST['TAMBAT_PASS']==1)||($row['TAMBAT']==1)){?>TAMBAT,<?php }?></label> 
                        <label id="DET_TUNDA" name="DET_TUNDA"><?php if(($_POST['TUNDA_PASS']==1)||($row['TUNDA']==1)){?>TUNDA,<?php }?></label> 
						<label id="DET_AIR" name="DET_AIR"><?php if(($_POST['AIR_PASS']==1)||($row["AIR"])){?>AIR,<?php }?></label> 
                        <label id="DET_KEPIL" name="DET_KEPIL"><?php if(($_POST['KEPIL_PASS']==1)||($row["KEPIL"])){?>KEPIL<?php }?></label> 
                        
                         <div align="left"> 
                          <input type="hidden" id="LABUH_PASS" name="LABUH_PASS" value="{$row.LABUH_PASS}" size="1" />
                          <input type="hidden" id="PANDU_PASS" name="PANDU_PASS" value="{$row.PANDU_PASS}" size="1"/>
                          <input type="hidden" id="TAMBAT_PASS" name="TAMBAT_PASS"value="{$row.TAMBAT_PASS}" size="1" />
                          <input type="hidden" id="TUNDA_PASS" name="TUNDA_PASS" value="{$row.TUNDA_PASS}" size="1"/>
                          <input type="hidden" id="AIR_PASS" name="AIR_PASS" value="{$row.AIR_PASS}" size="1" />
                          <input type="hidden" id="KEPIL_PASS" name="KEPIL_PASS" value="{$row.KEPIL_PASS}" size="1"  />
                          <input type="hidden" id="KD_SERVICE_CODE" name="KD_SERVICE_CODE" value="{$row.KD_SERVICE_CODE}" size="1"  />
                          <!--input type="hidden" id="JN_KAPAL" name="JN_KAPAL" value="{$row.JN_KAPAL}" size="3"  /-->
                        </div></td>
                    </tr>
                  </table>
                  </fieldset>
                </div></td>
            </tr>
            <tr> 
              <td height="24" class="form-field-caption" align="right"><div align="left">Kade 
                  Lokasi</div></td>
              <td align="left" class="form-field-input"><div align="left">: 
                  <input name="KADE_ASAL" type="text" id="KADE_ASAL" size="5" value="{$row.KADE_ASAL}" readonly="readonly" />
                  - 
                  <input name="NM_KADE_ASAL" id="NM_KADE_ASAL" type="text" size="10" value="{$row.NM_KADE_ASAL}" readonly="readonly" />
                </div></td>
            </tr>
            <tr> 
              <td height="24" class="form-field-caption" align="right"><div align="left">Kade 
                  Tujuan</div></td>
              <td><div align="left">: 
                  <input name="KADE_TUJUAN" type="text" id="KADE_TUJUAN" value="{$row.KADE_TUJUAN}" size="5" readonly="readonly"/>
                  <span class="form-field-input"> - 
                  <input name="NM_KADE_TUJUAN" id="NM_KADE_TUJUAN" type="text" value="{$row.NM_KADE_TUJUAN}" size="10" readonly="readonly" />
                  </span></div></td>
            </tr>
          </table>
      </fieldset>	<!--Master PPKB-->



 <multitab id="multi">
<!---------------------------------------------------PANDU-------------------------------------->
  <tab name="pandu" id="pandu" label="PANDU">
<div style="visibility:hidden" id="tabPandu">
  <table class="form-input" cellspacing='2' cellpadding='2' border='0' width="100%">
      <block visible="error">
        <!--><tr>
          <td colspan="2">Kesalahan dalam pengisian</td>
        </tr>-->
      </block>
    </table>
    <table width="100%">
      <tr>
        <td colspan="2" align="left" valign="top" class="form-field-caption">
        <fieldset class="form-fieldset">
          <div align="left">
            <legend>Data Pandu </legend>
                    <table width="100%" border="0">
                              
                      <tr> 
                        <td width="20%">Tanggal Mulai Pandu</td>
                        <td width="80%"><span class="form-field-input"> : <span id="TGL_MPANDU_S">

                         <input id="TGL_MPANDU" name="TGL_MPANDU" type="date" value="{$row.TGL_MPANDU}" size="19" maxlength="19" />

                          <block visible="error.TGL_MPANDU"><span class="form-field-error">{$error.TGL_MPANDU}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Tanggal Jam Pandu Naik</td>
                        <td><span class="form-field-input"> : <span id="JAM_PANDU_NAIK_S">
                          <input id="JAM_PANDU_NAIK" name="JAM_PANDU_NAIK" type="datetime" value="{$row.JAM_PANDU_NAIK}" size="15" maxlength="15" />
                          <block visible="error.JAM_PANDU_NAIK"><span class="form-field-error">{$error.JAM_PANDU_NAIK}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Tanggal Jam Kapal Gerak</td>
                        <td><span class="form-field-input"> : <span id="JAM_KAPAL_GERAK_S">
                          <input id="JAM_KAPAL_GERAK" name="JAM_KAPAL_GERAK" type="datetime" value="{$row.JAM_KAPAL_GERAK}" size="15" maxlength="15" />
                          <block visible="error.JAM_KAPAL_GERAK"><span class="form-field-error">{$error.JAM_KAPAL_GERAK}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Tanggal Jam Selesai Pandu</td>
                        <td><span class="form-field-input"> : <span id="TGL_SPANDU_S">
                          <input id="TGL_SPANDU" name="TGL_SPANDU" type="datetime" value="{$row.TGL_SPANDU}" size="15" maxlength="15" />
                          <block visible="error.TGL_SPANDU"><span class="form-field-error">{$error.TGL_SPANDU}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Tanggal Jam Pandu Turun</td>
                        <td><span class="form-field-input"> : <span id="JAM_PANDU_TURUN_S">
                          <input id="JAM_PANDU_TURUN" name="JAM_PANDU_TURUN" type="datetime" value="{$row.JAM_PANDU_TURUN}" size="15" maxlength="15" />
                          <block visible="error.JAM_PANDU_TURUN"><span class="form-field-error">{$error.JAM_PANDU_TURUN}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Kode Nama Pandu</td>
                        <td>: <span class="form-field-input"> 
                          <input id="KD_PERS_PANDU" name="KD_PERS_PANDU" type="text" value="{$row.KD_PERS_PANDU}" size="10" hidden />
                          <input id="KD_PERS_PANDU_NEW" name="KD_PERS_PANDU_NEW" type="text" value="{$row.KD_PERS_PANDU_NEW}" size="10" readonly />
                          </span>
                          <img onclick="fillData_PETUGAS_PANDU();" src="{$HOME}images/ico_autocomplete.gif" />
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_PERS_PANDU(this.value);" /> 
                          <b> <span id="ref_KD_PERS_PANDU">{$row.KD_PERS_PANDU}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_KD_PERS_PANDU" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						  <block visible="error.KD_PERS_PANDU"><span class="form-field-error">{$error.KD_PERS_PANDU}></span></block>
						  </td>
                      </tr>
                      <tr> 
                        <td>Pandu Dari</td>
                        <td>: <span class="form-field-input"> 
                          <input id="PANDU_DARI" name="PANDU_DARI" type="text" value="{$row.PANDU_DARI}" size="10"/>
                          </span>
                          <img onclick="fillData_KADE();" src="{$HOME}images/ico_autocomplete.gif" />
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_PANDU_DARI(this.value);" /> 
                          <b> <span id="ref_PANDU_DARI">{$row.KD_PANDU_DARI}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_PANDU_DARI" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						  <block visible="error.PANDU_DARI"><span class="form-field-error">{$error.PANDU_DARI}></span></block>
						  </td>
                      </tr>
                      <tr> 
                        <td height="25">Pandu Ke</td>
                        <td>: <span class="form-field-input"> 
                          <input id="PANDU_KE" name="PANDU_KE" type="text" value="{$row.PANDU_KE}" size="10"/>
                          </span>
                          <img onclick="fillData_KADE2();" src="{$HOME}images/ico_autocomplete.gif" />
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_PANDU_KE(this.value);" /> 
                          <b> <span id="ref_PANDU_KE">{$row.PANDU_KE}</span> </b> 
                          <div class="suggestionsBox" id="popsuggestions_PANDU_KE" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						  <block visible="error.PANDU_KE"><span class="form-field-error">{$error.PANDU_KE}></span></block>
						  </td>
                      </tr>
                      <tr> 
                        <td>Gerakan Pandu</td>
                        <td>: <span class="form-field-input"> 
                          <select id="KD_GERAKAN" name="KD_GERAKAN" selected="row.KD_GERAKAN" list="combolist.KD_GERAKAN" key="id" label=""  >
                          </select>
                          </span></td>
                      </tr>
                      <tr> 
                        <td>Kode Perairan</td>
                        <td>: <span class="form-field-input">
                         
                          <select id="KD_PERAIRAN" name="KD_PERAIRAN" selected="row.KD_PERAIRAN" list="combolist.KD_PERAIRAN" key="id" label="" >
                          </select>
                          </span></td>
                      </tr>
                      <tr> 
                        <td>Kode Kapal Pandu Antar</td>
                        <td>: <span class="form-field-input"> 
                          <input id="KD_FAS_PANDU" name="KD_FAS_PANDU" type="text" value="{$row.KD_FAS_PANDU}" size="10" readonly/>
                          </span>
                          <img onclick="fillData_FAS_PANDU();" src="{$HOME}images/ico_autocomplete.gif" />
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_FAS_PANDU(this.value);" /> 
                          <b> <span id="ref_KD_FAS_PANDU">{$row.KD_FAS_PANDU}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_KD_FAS_PANDU" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						   <block visible="error.KD_FAS_PANDU"><span class="form-field-error">{$error.KD_FAS_PANDU}></span></block>
						  </td>
                      </tr>
					  <tr> 
                        <td>Kode Kapal Pandu Jemput</td>
                        <td>: <span class="form-field-input"> 
                          <input id="KD_FAS_PANDU_JEMPUT" name="KD_FAS_PANDU_JEMPUT" type="text" value="{$row.KD_FAS_PANDU_JEMPUT}" size="10" readonly/>
                          </span>
                          <img onclick="fillData_FAS_PANDU_JEMPUT();" src="{$HOME}images/ico_autocomplete.gif" />
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_FAS_PANDU_JEMPUT(this.value);" /> 
                          <b> <span id="ref_KD_FAS_PANDU_JEMPUT">{$row.KD_FAS_PANDU_JEMPUT}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_KD_FAS_PANDU_JEMPUT" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						   <block visible="error.KD_FAS_PANDU_JEMPUT"><span class="form-field-error">{$error.KD_FAS_PANDU_JEMPUT}></span></block>
						  </td>
                      </tr>
                      <tr> 
                        <td>Nahkoda Kapal</td>
                        <td>: <span class="form-field-input"> 
                          <input id="KD_NM_NAHKODA" name="KD_NM_NAHKODA" type="text" value="{$row.KD_NM_NAHKODA}" size="20" maxlength="50"/>
                          </span>
                          <!--<img onclick="fillData_NM_NAHKODA();" src="{$HOME}images/ico_autocomplete.gif" />
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_NM_NAHKODA(this.value);" /> 
                          <b> <span id="ref_KD_NM_NAHKODA">{$row.KD_NM_NAHKODA}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_KD_NM_NAHKODA" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						   <block visible="error.KD_NM_NAHKODA"><span class="form-field-error">{$error.KD_NM_NAHKODA}></span></block>
						  -->
                          </td>
                      </tr>
                      <tr>
                        <td>Draft Depan / Belakang</td>
                        <td>: <span class="form-field-input">
                          <input id="DRAFT_DEPAN" name="DRAFT_DEPAN" type="text" value="{$row.DRAFT_DEPAN}" size="5"/>
                        &nbsp;-&nbsp;<input id="DRAFT_BELAKANG" name="DRAFT_BELAKANG" type="text" value="{$row.DRAFT_BELAKANG}" size="5"/></span></td>
                      </tr>
                      <tr> 
                        <td>Keterangan Pandu</td>
                        <td><span class="form-field-input">:
                           <select id="KET_PANDU" name="KET_PANDU" selected="row.KET_PANDU" list="combolist.KET_PANDU" key="KD_KETERANGAN_PANDU" label="KETERANGAN"  >
                          </select> -
						  <select id="KET_PANDU_KHUSUS" name="KET_PANDU_KHUSUS" selected="row.KET_PANDU_KHUSUS" list="combolist.KET_PANDU_KHUSUS" key="KD_KETERANGAN_PANDU_KHUSUS" 
									label="KETERANGAN"  ></select>
 
                          
                          </span></td>
                      </tr>
                      
                      <!--EMERGENCY-->
                      <tr>
                        <td colspan="2">
                        <div style="visibility:hidden" id="EMERGENCY">
                        	<table width="100%">
                            <tr>
                            	<td width="20%">Nomor BA</td>
                                <td width="25%">: <input type="text" id="NO_BA" name="NO_BA" value="{$row.NO_BA}" size="20"/></td>
                                <td width="11%">Tanggal BA</td>
                                <td width="44%">: <input id="TGL_BA" name="TGL_BA" type="date" value="{$row.TGL_BA}" size="15" maxlength="15" /></td>
                            </tr>
                            <!--tr>
                            	<td width="20%">Keterangan</td>
                                <td colspan="3" width="80%">: <textarea name="KETERANGAN_BA" cols="35" rows="1" id="KETERANGAN_BA">{$row.KETERANGAN_BA}</textarea></td>
                            </tr-->
                            </table>
                        </div>
                        </td>
                        </tr>
                        <!--END EMERGENCY--->

                      
                      
                      
                                            
                    </table>
          </div>
          </fieldset></td>
      </tr>
      <tr>
        <td width="492" align="right" valign="top" class="form-field-caption"></td>
        <td width="246" valign="top" class="form-field-input"></td>
      </tr>
      <tr>
        <td colspan="2" class="form-footer">&nbsp;</td>
      </tr>
    </table>
  </div>
  </tab>
  
<!---------------------------------------------------TUNDA-------------------------------------->
  <tab name="tunda" id="tunda" label="TUNDA">
  <div style="visibility:hidden" id="tabTunda">
  <table class="form-input" cellspacing='2' cellpadding='2' border='0' width="100%">
      <block visible="error">
        <tr>
          <td colspan="2">Kesalahan dalam pengisian</td>
        </tr>
      </block>
    </table>
    <table width="100%">
      <tr>
        <td colspan="2" align="left" valign="top" class="form-field-caption">
        <fieldset class="form-fieldset">
          <div align="left">
            <legend>Data Tunda </legend>
                    <table width="100%" border="0">
                      <!--
                      <tr> 
                        <td width="13%">Tanggal Jam Mulai Tunda</td>
                        <td colspan="3"><span class="form-field-input"> :<span id="TGL_JAM_MTUNDA_S"> 
                          <input id="TGL_JAM_MTUNDA" name="TGL_JAM_MTUNDA" type="datetime" value="{$row.TGL_JAM_MTUNDA}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_MTUNDA"><span class="form-field-error">{$error..TGL_JAM_MTUNDA}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Tanggal Jam Selesai Tunda</td>
                        <td colspan="3"><span class="form-field-input"> : <span id="TGL_JAM_STUNDA_S">
                          <input id="TGL_JAM_STUNDA" name="TGL_JAM_STUNDA" type="datetime" value="{$row.TGL_JAM_STUNDA}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_STUNDA"><span class="form-field-error">{$error..TGL_JAM_STUNDA}</span></block> 
                          </span></span></td>
                      </tr>
                      
                      <tr> 
                        <td>Tunda Dari</td>
                        <td colspan="3">: <span class="form-field-input"> 
                          <input id="TUNDA_DARI" name="TUNDA_DARI" type="text" value="{$row.TUNDA_DARI}" size="10"/>
                          </span><img src="{$HOME}images/ico_help.gif" onclick="popup_TUNDA_DARI(this.value);" /> 
                          <b> <span id="ref_TUNDA_DARI">{$row.KD_TUNDA_DARI}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_TUNDA_DARI" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div></td>
                      </tr>
                      <tr> 
                        <td>Tunda Ke</td>
                        <td colspan="3">: <span class="form-field-input"> 
                          <input id="TUNDA_KE" name="TUNDA_KE" type="text" value="{$row.TUNDA_KE}" size="10"/>
                          </span><img src="{$HOME}images/ico_help.gif" onclick="popup_TUNDA_KE(this.value);" /> 
                          <b> <span id="ref_TUNDA_KE">{$row.KD_TUNDA_KE}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_TUNDA_KE" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div></td>
                      </tr>
                      -->
                      <tr> 
                        <td width="6%">&nbsp;</td>
                        <td width="32%">&nbsp;</td>
                        <td width="31%">Tanggal Jam Tiba Lokasi</td>
                        <td width="31%">Tanggal Jam Meninggalkan Lokasi</td>
                      </tr>
                      <tr> 
                        <td>Kapal 1<span id='tunda1_remark'></span></td>
                        <td>: 
                          <input id="KD_TUNDA_1" name="KD_TUNDA_1" type="text" value="{$row.KD_TUNDA_1}" size="4" maxlength="25" readonly/> 
                         <!-- <img onclick="fillData_KD_TUNDA_1();" src="{$HOME}images/ico_autocomplete.gif" />  -->
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_TUNDA_1(this.value);" /> 
                          <b> <span id="ref_KD_TUNDA_1">{$row.KD_TUNDA_1}</span> 
						  <img src="{$HOME}images/ico_delete.gif" onclick="remove_KD_TUNDA('KD_TUNDA_1', 'ref_KD_TUNDA_1', 'notif_KD_TUNDA_1');" />
						  <span id="notif_KD_TUNDA_1" style="color: red;">&nbsp;&nbsp;required</span>
                          </b> <div class="suggestionsBox" id="popsuggestions_KD_TUNDA_1" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
                          <block visible="error.KD_TUNDA_1"><span class="form-field-error">{$error.KD_TUNDA_1}</span></block> 
                        </td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_TIBA_KPL1_S">
                          <input id="TGL_JAM_TIBA_KPL1" name="TGL_JAM_TIBA_KPL1" type="datetime" value="{$row.TGL_JAM_TIBA_KPL1}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_TIBA_KPL1"><span class="form-field-error">{$error.TGL_JAM_TIBA_KPL1}</span></block> 
                          </span></span></td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_BRNGKT_KPL1_S">
                          <input id="TGL_JAM_BRNGKT_KPL1" name="TGL_JAM_BRNGKT_KPL1" type="datetime" value="{$row.TGL_JAM_BRNGKT_KPL1}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_BRNGKT_KPL1"><span class="form-field-error">{$error.TGL_JAM_BRNGKT_KPL1}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Kapal 2<span id='tunda2_remark'></span></td>
                        <td>: 
                          <input id="KD_TUNDA_2" name="KD_TUNDA_2" type="text" value="{$row.KD_TUNDA_2}" size="4" maxlength="25" readonly/> 
                          <!-- <img onclick="fillData_KD_TUNDA_2();" src="{$HOME}images/ico_autocomplete.gif" />  -->
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_TUNDA_2(this.value);" /> 
                          <b> <span id="ref_KD_TUNDA_2">{$row.KD_TUNDA_2}</span> 
                          <img src="{$HOME}images/ico_delete.gif" onclick="remove_KD_TUNDA('KD_TUNDA_2', 'ref_KD_TUNDA_2', 'notif_KD_TUNDA_2');" />
                          <span id="notif_KD_TUNDA_2" style="color: red;">&nbsp;&nbsp;required</span>
						  </b> <div class="suggestionsBox" id="popsuggestions_KD_TUNDA_2" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
                          <block visible="error.KD_TUNDA_2"><span class="form-field-error">{$error.KD_TUNDA_2}</span></block> 
                        </td>
                        <td><span class="form-field-input"><span id="TGL_JAM_TIBA_KPL2_S"> 
                          <input id="TGL_JAM_TIBA_KPL2" name="TGL_JAM_TIBA_KPL2" type="datetime" value="{$row.TGL_JAM_TIBA_KPL2}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_TIBA_KPL2"><span class="form-field-error">{$error.TGL_JAM_TIBA_KPL2}</span></block> 
                          </span></span></td>
                        <td><span class="form-field-input"><span id="TGL_JAM_BRNGKT_KPL2_S"> 
                          <input id="TGL_JAM_BRNGKT_KPL2" name="TGL_JAM_BRNGKT_KPL2" type="datetime" value="{$row.TGL_JAM_BRNGKT_KPL2}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_BRNGKT_KPL2"><span class="form-field-error">{$error.TGL_JAM_BRNGKT_KPL2}</span></block> 
                          </span></span></td>
                      </tr>
                      <tr> 
                        <td>Kapal 3<span id='tunda3_remark'></span></td>
                        <td>: 
                          <input id="KD_TUNDA_3" name="KD_TUNDA_3" type="text" value="{$row.KD_TUNDA_3}" size="4" maxlength="25" readonly/> 
                          <!-- <img onclick="fillData_KD_TUNDA_3();" src="{$HOME}images/ico_autocomplete.gif" />  -->
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_TUNDA_3(this.value);" /> 
                          <b> <span id="ref_KD_TUNDA_3">{$row.KD_TUNDA_3}</span> 
                          <img src="{$HOME}images/ico_delete.gif" onclick="remove_KD_TUNDA('KD_TUNDA_3', 'ref_KD_TUNDA_3', 'notif_KD_TUNDA_3');" />
                          <span id="notif_KD_TUNDA_3" style="color: red;">&nbsp;&nbsp;required</span>
						  </b> <div class="suggestionsBox" id="popsuggestions_KD_TUNDA_3" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList3"> 
                              &nbsp;</div>
                          </div>
                          <block visible="error.KD_TUNDA_3"><span class="form-field-error">{$error.KD_TUNDA_3}</span></block> 
                        </td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_TIBA_KPL3_S"> 
                          <input id="TGL_JAM_TIBA_KPL3" name="TGL_JAM_TIBA_KPL3" type="datetime" value="{$row.TGL_JAM_TIBA_KPL3}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_TIBA_KPL3"><span class="form-field-error">{$error.TGL_JAM_TIBA_KPL3}</span></block> 
                          </span></span></td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_BRNGKT_KPL3_S"> 
                          <input id="TGL_JAM_BRNGKT_KPL3" name="TGL_JAM_BRNGKT_KPL3" type="datetime" value="{$row.TGL_JAM_BRNGKT_KPL3}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_BRNGKT_KPL3"><span class="form-field-error">{$error.TGL_JAM_BRNGKT_KPL3}</span></block> 
                          </span></span></td>
                      </tr>
					  <tr> 
                        <td>Kapal 4<span id='tunda4_remark'></span></td>
                        <td>: 
                          <input id="KD_TUNDA_4" name="KD_TUNDA_4" type="text" value="{$row.KD_TUNDA_4}" size="4" maxlength="25" readonly/> 
                          <!-- <img onclick="fillData_KD_TUNDA_4();" src="{$HOME}images/ico_autocomplete.gif" />  -->
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_TUNDA_4(this.value);" /> 
                          <b> <span id="ref_KD_TUNDA_4">{$row.KD_TUNDA_4}</span> 
                          <img src="{$HOME}images/ico_delete.gif" onclick="remove_KD_TUNDA('KD_TUNDA_4', 'ref_KD_TUNDA_4');" />
						  </b> <div class="suggestionsBox" id="popsuggestions_KD_TUNDA_4" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList4"> 
                              &nbsp;</div>
                          </div>
                          <block visible="error.KD_TUNDA_4"><span class="form-field-error">{$error.KD_TUNDA_4}</span></block> 
                        </td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_TIBA_KPL4_S"> 
                          <input id="TGL_JAM_TIBA_KPL4" name="TGL_JAM_TIBA_KPL4" type="datetime" value="{$row.TGL_JAM_TIBA_KPL4}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_TIBA_KPL4"><span class="form-field-error">{$error.TGL_JAM_TIBA_KPL4}</span></block> 
                          </span></span></td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_BRNGKT_KPL4_S"> 
                          <input id="TGL_JAM_BRNGKT_KPL4" name="TGL_JAM_BRNGKT_KPL4" type="datetime" value="{$row.TGL_JAM_BRNGKT_KPL4}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_BRNGKT_KPL4"><span class="form-field-error">{$error.TGL_JAM_BRNGKT_KPL4}</span></block> 
                          </span></span></td>
                      </tr>
					  <tr> 
                        <td>Kapal 5<span id='tunda5_remark'></span></td>
                        <td>: 
                          <input id="KD_TUNDA_5" name="KD_TUNDA_5" type="text" value="{$row.KD_TUNDA_5}" size="4" maxlength="25" readonly/> 
                          <!-- <img onclick="fillData_KD_TUNDA_5();" src="{$HOME}images/ico_autocomplete.gif" />  -->
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_TUNDA_5(this.value);" /> 
                          <b> <span id="ref_KD_TUNDA_5">{$row.KD_TUNDA_5}</span> 
                          <img src="{$HOME}images/ico_delete.gif" onclick="remove_KD_TUNDA('KD_TUNDA_5', 'ref_KD_TUNDA_5');" />
						  </b> <div class="suggestionsBox" id="popsuggestions_KD_TUNDA_5" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList5"> 
                              &nbsp;</div>
                          </div>
                          <block visible="error.KD_TUNDA_5"><span class="form-field-error">{$error.KD_TUNDA_5}</span></block> 
                        </td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_TIBA_KPL5_S"> 
                          <input id="TGL_JAM_TIBA_KPL5" name="TGL_JAM_TIBA_KPL5" type="datetime" value="{$row.TGL_JAM_TIBA_KPL5}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_TIBA_KPL5"><span class="form-field-error">{$error.TGL_JAM_TIBA_KPL5}</span></block> 
                          </span></span></td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_BRNGKT_KPL5_S"> 
                          <input id="TGL_JAM_BRNGKT_KPL5" name="TGL_JAM_BRNGKT_KPL5" type="datetime" value="{$row.TGL_JAM_BRNGKT_KPL5}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_BRNGKT_KPL5"><span class="form-field-error">{$error.TGL_JAM_BRNGKT_KPL5}</span></block> 
                          </span></span></td>
                      </tr>
					  <tr> 
                        <td>Kapal 6<span id='tunda6_remark'></span></td>
                        <td>: 
                          <input id="KD_TUNDA_6" name="KD_TUNDA_6" type="text" value="{$row.KD_TUNDA_6}" size="4" maxlength="25" readonly/> 
                          <!-- <img onclick="fillData_KD_TUNDA_6();" src="{$HOME}images/ico_autocomplete.gif" />  -->
                          <img src="{$HOME}images/ico_help.gif" onclick="popup_KD_TUNDA_6(this.value);" /> 
                          <b> <span id="ref_KD_TUNDA_6">{$row.KD_TUNDA_6}</span> 
                          <img src="{$HOME}images/ico_delete.gif" onclick="remove_KD_TUNDA('KD_TUNDA_6', 'ref_KD_TUNDA_6');" />
						  </b> <div class="suggestionsBox" id="popsuggestions_KD_TUNDA_6" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList3"> 
                              &nbsp;</div>
                          </div>
                          <block visible="error.KD_TUNDA_6"><span class="form-field-error">{$error.KD_TUNDA_6}</span></block> 
                        </td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_TIBA_KPL6_S"> 
                          <input id="TGL_JAM_TIBA_KPL6" name="TGL_JAM_TIBA_KPL6" type="datetime" value="{$row.TGL_JAM_TIBA_KPL6}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_TIBA_KPL6"><span class="form-field-error">{$error.TGL_JAM_TIBA_KPL6}</span></block> 
                          </span></span></td>
                        <td><span class="form-field-input"> <span id="TGL_JAM_BRNGKT_KPL6_S"> 
                          <input id="TGL_JAM_BRNGKT_KPL6" name="TGL_JAM_BRNGKT_KPL6" type="datetime" value="{$row.TGL_JAM_BRNGKT_KPL6}" size="15" maxlength="15" />
                          <block visible="error.TGL_JAM_BRNGKT_KPL6"><span class="form-field-error">{$error.TGL_JAM_BRNGKT_KPL6}</span></block> 
                          </span></span></td>
                      </tr>
                    </table>
          </div>
          </fieldset></td>
      </tr>
      <tr>
        <td width="492" align="right" valign="top" class="form-field-caption"></td>
        <td width="246" valign="top" class="form-field-input"></td>
      </tr>
    </table>
	<div><strong>Keterangan : <font color="blue">* = Zonasi</font>, <font color="green">** = Tambahan</font>,  <font color="red">*** = Darurat</font></strong></div>
  </div>
  </tab>
<!---------------------------------------------------KEPIL-------------------------------------->

  <tab name="kepil" label="KEPIL">
<div style="visibility:hidden" id="tabKepil">
    <table class="form-input" cellspacing='2' cellpadding='2' border='0' width="100%">
      <block visible="error">
        <tr>
          <td colspan="2">Kesalahan dalam pengisian</td>
        </tr>
      </block>
    </table>
    <table width="100%">
      <tr>
        <td colspan="2" align="left" valign="top" class="form-field-caption">
		<fieldset class="form-fieldset">
          <div align="left">
                    <p>Kepil</p>
                    <table width="100%" border="0">
                      
                      <tr> 
                        <td width="30%">Kode Moring Service</td>
                        <td width="66%">: <span class="form-field-input">
                         
                          <select id="KD_MORING" name="KD_MORING" selected="row.KD_MORING" list="combolist.KD_MORING" key="id" label="" >
                          </select> <i>* <font color="red">Jika Ya, harus mengisi kode kapal kepilnya</font></i>
                          </span></td>
                      </tr>
                      <tr> 
                        <td>Kode Kapal Kepil</td>
                        <td>: <span class="form-field-input"> 
                          <input id="KD_FAS_KEPIL" name="KD_FAS_KEPIL" type="text" value="{$row.KD_FAS_KEPIL}" size="10" readonly/>
                          </span>
                          <img onclick="fillData_FAS_KEPIL();" src="{$HOME}images/ico_autocomplete.gif" /> 
                          <img src="{$HOME}images/ico_help.gif" onClick="popup_KD_FAS_KEPIL(this.value);" /> 
                          <b> <span id="ref_KD_FAS_KEPIL">{$row.ref_KD_FAS_KEPIL}</span> 
                          </b> <div class="suggestionsBox" id="popsuggestions_KD_FAS_KEPIL" style="display: none;"> 
                            <div class="suggestionList" id="popSuggestionsList2"> 
                              &nbsp;</div>
                          </div>
						  <block visible="error.KD_FAS_KEPIL"><span class="form-field-error">{$error.KD_FAS_KEPIL}</span></block>
						  </td>
                      </tr>
                    </table>
          </div>
          </fieldset></td>
      </tr>
      <tr>
        <td width="492" align="right" valign="top" class="form-field-caption"></td>
        <td width="246" valign="top" class="form-field-input"></td>
      </tr>
    </table>
</div>
  </tab>

<!---------------------------------------------------LABUH-------------------------------------->

<tab name="labuh" id="labuh" label="LABUH">
<div style="visibility:hidden" id="tabLabuh">
    <table class="form-input" cellspacing='2' cellpadding='2' border='0' width="100%">
      <block visible="error">
        <tr>
          <td colspan="2">Kesalahan dalam pengisian</td>
        </tr>
      </block>
    </table>
    <table width="100%">
      <tr>
        <td colspan="2" align="left" valign="top" class="form-field-caption">
		<fieldset class="form-fieldset">
          <div align="left">
            <legend>Data Labuh</legend>
                    <table width="100%" border="0">
                      <tr> 
                        <td width="28%">Tanggal Jam Permintaan Mulai Labuh </td>
                        <td width="72%">: 
                          <span id="tgl_mlabuh">						  
						   <input id='TGL_JAM_BKT_MLABUH' name='TGL_JAM_BKT_MLABUH' type='datetime' value='{$row.TGL_JAM_BKT_MLABUH}' size="19" size="19" />
						  </span>
						  <block visible="error.TGL_JAM_BKT_MLABUH"><span class="form-field-error">{$error.TGL_JAM_BKT_MLABUH}</span></block>
                          </td>
                      </tr>
                      <tr> 
                        <td>Tanggal Jam Permintaan Selesai Labuh</td>
                        <td>: <span id="tgl_slabuh">
					<input id="TGL_JAM_BKT_SLABUH" name="TGL_JAM_BKT_SLABUH" type="datetime" value="{$row.TGL_JAM_BKT_SLABUH}" size="19" maxlength="19" />
						</span>
						<block visible="error.TGL_JAM_BKT_SLABUH"><span class="form-field-error">{$error.TGL_JAM_BKT_SLABUH}</span></block>
                          </td>
                      </tr>
                      
                      <tr> 
                        <td></td>
                        <td><span class="form-field-input">
<input name="LABUH_KE" type="hidden" id="LABUH_KE" value="{$row.LABUH_KE}" size="2" />
                          </span></td>
                      </tr>
                    </table>
          </div>
        </fieldset>
	    </td>
      </tr>
      <tr>
        <td width="492" align="right" valign="top" class="form-field-caption"></td>
        <td width="246" valign="top" class="form-field-input"></td>
      </tr>
    </table>
</div>
  </tab>



  </multitab>

		<fieldset class="form-fieldset" id="tugboad" style="visibility:hidden" >
                        <legend>Menggandeng Tugboat / Tongkang</legend>
                        <table width="100%">
                        <tr>
                        <td width="13%">Nomor PKK Tugboat 1</td>
                        <td width="37%">: 
                          <input name="TUG_BOAT1" type="text" id="TUG_BOAT1" value="{$row.TUG_BOAT1}" size="15"/>
                             <img src="{$HOME}images/ico_help.gif" onclick="popup_TUG_BOAT(this.value);">
                             <b><span id="ref_TUG_BOAT1">{$row.TUG_BOAT1}</span> </b>
                              <div class="suggestionsBox" id="popsuggestions" style="display: none;">
                               
                              	<div class="suggestionList" id="popSuggestionsList"> &nbsp;</div>
                               </div>
							   <block visible="error.TUG_BOAT1"><span class="form-field-error">{$error.TUG_BOAT1}</span></block>
                        </td>
                        <td width="14%">Nomor PKK Tongkang 1</td>

                        <td width="37%">: 
                       <input name="TONGKANG1" type="text" id="TONGKANG1"size="15" value="{$row.TK1}"/>
                                    <img src="{$HOME}images/ico_help.gif" onclick="popup_TK1(this.value);">
                                    <div class="suggestionsBox" id="popsuggestions" style="display: none;">
                                      <div class="suggestionList" id="popSuggestionsList"> &nbsp;</div>
                                    </div>
                                  <block visible="error.TK1"><span class="form-field-error">{$error.TK1}</span></block>
                        </td>
                      </tr>
                      <tr>
                        <td>Nomor PKK Tugboat 2</td>
                        <td>:
                                  <input name="TUG_BOAT2" type="text" id="TUG_BOAT2" value="{$row.TUG_BOAT2}"size="15"/>
                                    <img src="{$HOME}images/ico_help.gif" onclick="popup_TUG_BOAT2(this.value);">
                                    <b><span id="ref_TUG_BOAT2">{$row.TUG_BOAT2}</span> </b>
                                    <div class="suggestionsBox" id="popsuggestions" style="display: none;">
                                      <div class="suggestionList" id="popSuggestionsList"> &nbsp;</div>
                                    </div>
									<block visible="error.TUG_BOAT2"><span class="form-field-error">{$error.TUG_BOAT2}</span></block>
									</td>
                     
                      <td>Nomor PKK Tongkang 2</td>
                        <td>:
                                    <input name="TONGKANG2" type="text" id="TONGKANG2"size="15" value="{$row.TK2}"/>
                                    <img src="{$HOME}images/ico_help.gif" onclick="popup_TK2(this.value);">
                                    <div class="suggestionsBox" id="popsuggestions" style="display: none;">
                                      <div class="suggestionList" id="popSuggestionsList"> &nbsp;</div>
                                    </div>
                                  <block visible="error.TK2"><span class="form-field-error">{$error.TK2}</span></block> 
									</td>
                        </tr>
                      <tr>
                        <td>Nomor PKK Tugboat 3</td>
                        <td>:
                                  <input name="TUG_BOAT3" type="text" id="TUG_BOAT3" value="{$row.TUG_BOAT3}"size="15"/>
                                    <img src="{$HOME}images/ico_help.gif" onclick="popup_TUG_BOAT3(this.value);">
                                    <b><span id="ref_TUG_BOAT3">{$row.TUG_BOAT3}</span> </b>
                                    <div class="suggestionsBox" id="popsuggestions" style="display: none;">
                                      <div class="suggestionList" id="popSuggestionsList"> &nbsp;</div>
                                    </div>
									<block visible="error.TUG_BOAT3"><span class="form-field-error">{$error.TUG_BOAT3}</span></block>
									</td>
                                    <td></td>
                        <td>:
                                  <input name="TONGKANG2" type="text" id="TONGKANG2" value="{$row.TONGKANG2}"size="15"/>
                                    <img src="{$HOME}images/ico_help.gif" onclick="popup_TUG_BOAT2(this.value);">
                                    <b><span id="ref_TUG_BOAT2">{$row.TUG_BOAT2}</span> </b>
                                    <div class="suggestionsBox" id="popsuggestions" style="display: none;">
                                      <div class="suggestionList" id="popSuggestionsList"> &nbsp;</div>
                                    </div>
									<block visible="error.TUG_BOAT2"><span class="form-field-error">{$error.TUG_BOAT2}</span></block>
									</td>
                                   
                      </tr>
            </table>
                    	</fieldset>
                        
       
      	<table width="898" border="0">
        <tr>
          <td height="25" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="892" height="70" colspan="2" align="center" class="form-footer"><div align="left"><a onClick="validateTunda()" class="link-button" ><img src='images/valid.png' border='0' />&nbsp;Simpan</a>&nbsp;&nbsp;<a onClick="cancelForm('dataForm')" class="link-button" ><img src='images/batal.png' border='0' />&nbsp;Batal</a>&nbsp;</div></td>
        </tr>
      </table>	<!--tombol-->
	</td>
  </tr>
  </table>
  
  </form>

</block>
<block name='nodata'>
  </block>
</div>


<script type="text/javascript">
	function myFunction() {
		var TGL_JAM_PMT_PANDU_D = document.getElementById("TGL_JAM_PMT_PANDU_D").value;
		var penetapanpandu_date = new Date(TGL_JAM_PMT_PANDU_D);
		var penetapanpandu_d = penetapanpandu_date.getDate();
		if(penetapanpandu_d<10){
    		penetapanpandu_d='0'+penetapanpandu_d;
		}
		var penetapanpandu_m = penetapanpandu_date.getMonth()+1;
		if(penetapanpandu_m<10){
    		penetapanpandu_m='0'+penetapanpandu_m;
		}
		var penetapanpandu_y = penetapanpandu_date.getFullYear();
		var penetapanpandu_hh = penetapanpandu_date.getHours();
		var penetapanpandu_mm = penetapanpandu_date.getMinutes();

		var pandunaik_d = document.getElementById("cal_JAM_PANDU_NAIK_day").value;
		var pandunaik_m = document.getElementById("cal_JAM_PANDU_NAIK_month").value;
		var pandunaik_y = document.getElementById("cal_JAM_PANDU_NAIK").value;
		var pandunaik_hh = document.getElementById("cal_JAM_PANDU_NAIK_hh").value;
		var pandunaik_mm = document.getElementById("cal_JAM_PANDU_NAIK_mm").value;

		var pandugerak_d = document.getElementById("cal_JAM_KAPAL_GERAK_day").value;
		var pandugerak_m = document.getElementById("cal_JAM_KAPAL_GERAK_month").value;
		var pandugerak_y = document.getElementById("cal_JAM_KAPAL_GERAK").value;
		var pandugerak_hh = document.getElementById("cal_JAM_KAPAL_GERAK_hh").value;
		var pandugerak_mm = document.getElementById("cal_JAM_KAPAL_GERAK_mm").value;

		var panduselesai_d = document.getElementById("cal_TGL_SPANDU_day").value;
		var panduselesai_m = document.getElementById("cal_TGL_SPANDU_month").value;
		var panduselesai_y = document.getElementById("cal_TGL_SPANDU").value;
		var panduselesai_hh = document.getElementById("cal_TGL_SPANDU_hh").value;
		var panduselesai_mm = document.getElementById("cal_TGL_SPANDU_mm").value;

		var panduturun_d = document.getElementById("cal_JAM_PANDU_TURUN_day").value;
		var panduturun_m = document.getElementById("cal_JAM_PANDU_NAIK_month").value;
		var panduturun_y = document.getElementById("cal_JAM_PANDU_TURUN").value;
		var panduturun_hh = document.getElementById("cal_JAM_PANDU_TURUN_hh").value;
		var panduturun_mm = document.getElementById("cal_JAM_PANDU_TURUN_mm").value;


		var confirmed = confirm("Anda Yakin ??"
			+"\n"+"Apakah tanggal realisasi sudah sesuai dengan tanggal penetapan penetapan pandu??"

			+"\n"
			+"\n"+"Tanggal Penetapan Pandu : "+ penetapanpandu_d + "-" + penetapanpandu_m + "-" + penetapanpandu_y + " " + penetapanpandu_hh + ":" + penetapanpandu_mm + ":00"
			+"\n"+"Tanggal Jam Pandu Naik : "+ pandunaik_d + "-" + pandunaik_m + "-" + pandunaik_y + " " + pandunaik_hh + ":" + pandunaik_mm + ":00"
			+"\n"+"Tanggal Jam Pandu Gerak : "+ pandugerak_d + "-" + pandugerak_m + "-" + pandugerak_y + " " + pandugerak_hh + ":" + pandugerak_mm + ":00"
			+"\n"+"Tanggal Jam Pandu Selesai : "+ panduselesai_d + "-" + panduselesai_m + "-" + panduselesai_y + " " + panduselesai_hh + ":" + panduselesai_mm + ":00"
			+"\n"+"Tanggal Jam Pandu Turun : "+ panduturun_d + "-" + panduturun_m + "-" + panduturun_y + " " + panduturun_hh + ":" + panduturun_mm + ":00"
			);
		if(confirmed)
		{
  			submitForm('dataForm'); // will sumbit the form. Do a redirect on the server side
		}
		else
		{
			return false;	
		}
	}

</script>


<script src="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.js"></script>
<link href="https://cdn.jsdelivr.net/sweetalert2/5.3.8/sweetalert2.css" rel="stylesheet"/>
