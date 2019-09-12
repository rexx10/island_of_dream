function checkdata() {
	var frmObj = window.document.form1;	

	var em = frmObj.myemail.value;
	var len = em.length;
	for(var i = 0; i < len; i++) 
	{
    	var c = em.charAt(i);
    	if(!((c >= "A" && c <= "Z")||(c >= "a" && c <= "z")||(c >= "0" && c <= "9")||(c == "-")||(c == "_")||(c == ".")||(c == "@"))) 
		{
      		alert("請輸入限用英文，數字，點，'@'，橫線及底線的電子郵件");		
			frmObj.myemail.focus();
			return false;
    	}
  	}
	
	if((em.indexOf("@")==-1)||(em.indexOf("@")==0)||(em.indexOf("@")==(len-1))) 
	{
    	alert("請輸入正確的電子郵件");	

		frmObj.myemail.focus();
		return false;
	}
  	if((em.indexOf("@")!=-1)&&(em.substring(em.indexOf("@")+1,len).indexOf("@")!=-1)) 
	{
    	alert("請輸入正確的電子郵件");	
		frmObj.myemail.focus();
		return false; 
  	}
  	
	if((em.indexOf(".")==-1)||(em.indexOf(".")==0)||(em.lastIndexOf(".")==(len-1))) 
	{
    	alert("請輸入正確的電子郵件");
		frmObj.myemail.focus();
		return false;
  	}
	
	if(frmObj.checknum.value.length == 0 ){
		alert("請輸入安全驗證碼！");
		frmObj.checknum.focus();
		return false;
	}
	
	frmObj.submit();
}



(function(){
// 重新載入圖形的函數，適用於任何圖形
var reloadImg = function(dImg) {
     // 取得圖形原本的來源 url
     var sOldUrl = dImg.src;
     // 在原本的 url 後面加上亂數的參數，變成新的 url
     var sNewUrl = sOldUrl + "?rnd=" + Math.random();
    //將圖形的來源改為新的 url，就會重新載入圖形了
     dImg.src = sNewUrl;
};
 
// 取得重新載入的超連結元素
var dReloadLink = document.getElementById("reload-img");
 
// 取得驗證碼圖形元素
var dImg = document.getElementById("rand-img");
 
// 定義這個超連結的 onclick 事件
dReloadLink.onclick = function(e) {
      // 呼叫函數重新載入驗證碼圖形
      reloadImg(dImg);
      //停止事件預設的動作，也就是不要跳到超連結的網址
      if(e) e.preventDefault();
      return false;
};
})();