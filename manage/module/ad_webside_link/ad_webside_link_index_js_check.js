
function check_keyin_box() //檢查是否有輸入資料
{
	  if(document.getElementById("keyin_box00").value.length == 0)
	  {
	 	  alert("警告！尚未輸入廣告主或友站名稱！");
		  return false;
      }
	  if(document.getElementById("keyin_box01").value.length == 0)
      {
		  alert("警告！尚未輸入廣告主或友站網址！");
		  return false;
	  } // doucment.form1.radioid[i].value
	  //if(document.getElementById("raido_sel_this_yes").checked  == false)
	  //{
          if(document.getElementById("keyin_box02").value.length == 0)
		  {
		      alert("警告！尚未選擇廣告主或友站圖檔！");
			  return false;
	      }
	  //}  
      form1.submit();			
}


function check_keyin_box2() //檢查是否有輸入資料
{
          if(document.getElementById("keyin_box02").value.length == 0)
		  {
		      alert("警告！尚未選擇廣告主或友站圖檔！");
			  return false;
	      }
      form1.submit();			
}