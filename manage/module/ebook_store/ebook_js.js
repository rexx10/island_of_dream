
function check_input_box() //檢查是否有輸入資料
{
	  if(document.getElementById("input_box00").value.length == 0)
	  {
	 	  alert("警告！尚未輸入廠商名稱！");
		  return false;
      }
	  if(document.getElementById("input_box01").value.length == 0)
      {
		  alert("警告！尚未輸入 Ebook 網址！");
		  return false;
	  }
      Form1.submit();			
}