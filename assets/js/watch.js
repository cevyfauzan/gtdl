	function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
	}
	window.setTimeout("waktu()",1000);
	function waktu()
	{
		var tanggal = new Date();
		setTimeout("waktu()",1000);
		document.getElementById("output").innerHTML = addZero(tanggal.getHours()) + ":" + addZero(tanggal.getMinutes()) + ":" + addZero(tanggal.getSeconds());
	}

	function waktu_maju()
	{
		var tanggal = new Date();
		setTimeout("waktu_maju()",1000);
		document.getElementById("output_maju").innerHTML = addZero(tanggal.getHours()) + ":" + addZero(tanggal.getMinutes()) + ":" + addZero(tanggal.getSeconds());
	}

	var tanggallengkap = new String();
	var namahari = ("Sunday Monday Tuesday Wednesday Thursday Friday Saturday");
	namahari = namahari.split(" ");
	var namabulan = ("January February March April May June July August September October November December");
	namabulan = namabulan.split(" ");
	var tgl = new Date();
	var hari = tgl.getDay();
	var tanggal = tgl.getDate();
	var bulan = tgl.getMonth();
	var tahun = tgl.getFullYear();
	tanggallengkap = namahari[hari] + ", " + namabulan[bulan] + " " +tanggal + ", " + tahun;
	tahunini = tahun;

	var popupWindow = null;
	function centeredPopup(url,winName,w,h,scroll)
	{
		LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
		TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
		settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
		popupWindow = window.open(url,winName,settings)
	}