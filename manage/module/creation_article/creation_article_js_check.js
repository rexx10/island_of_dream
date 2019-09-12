
function check_keyin_box() //檢查是否有輸入資料
{
	  if(document.getElementById("keyin_box00").value.length == 0)
	  {
	 	  alert("警告！尚未輸入作者代號！");
		  return false;
      }
	  if(document.getElementById("keyin_box01").value.length == 0)
      {
		  alert("警告！尚未輸入作者姓名！");
		  return false;
	  } // doucment.form1.radioid[i].value
	  //if(document.getElementById("raido_sel_this_yes").checked  == false)
	  //{
          if(document.getElementById("keyin_box02").value.length == 0)
		  {
		      alert("警告！尚未選擇作者代表圖檔！");
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

function check_ck_works_data_config_keyin_box() //檢查是否有輸入資料
{
          if(document.getElementById("keyin_box03").value.length == 0)
		  {
		      alert("警告！尚未輸入作品名稱！");
			  return false;
	      }		  
      form1.submit();			
}

function check_creation_article_chapters_b_keyin_box() //檢查是否有輸入資料
{
          if(document.getElementById("keyin_box00").value.length == 0)
		  {
		      alert("警告！章回名稱尚未輸入！");
			  return false;
	      }
		  if(document.getElementById("keyin_box02").value.length == 0)
		  {
		      alert("警告！刊登日尚未輸入！");
			  return false;
	      }
		  if(document.getElementById("keyin_box03").value.length == 0)
		  {
		      alert("警告！章回內容尚未輸入！");
			  return false;
	      }
      form1.submit();			
}

function check_ca_works_data_uni_edit_config_keyin_box() //檢查是否有輸入資料
{

		  if(document.getElementById("ch_ca_works_img_id").value.length == 0)
		  {
		     
			  if(document.getElementById("ca_works_title_key_in_box").value.length == 0)
		      {
		          alert("未變更任何資料，將不進行任何動作!");
			      return false;
	          }
			  if(document.getElementById("ca_works_title_key_in_box").value == document.getElementById("old_ca_works_title_key_in_box").value)
		      {
		          alert("未變更任何資料，將不進行任何動作!");
			      return false;
	          }
	      }
		  if(document.getElementById("ch_ca_works_img_id").value.length == 0)
		  {
		     
			  if(document.getElementById("ca_works_title_key_in_box").value.length == 0)
		      {
		          alert("未變更任何資料，將不進行任何動作!");
			      return false;
	          }
	      }
      form1.submit();			
}

function check_creation_article_chapters_uni_edit_keyin_box() //檢查是否有輸入資料
{
		  if(document.getElementById("keyin_box05").value.length == 0)
		  {
		          alert("未變更任何資料，將不進行任何動作!");
			      return false;
	      }
      form1.submit();			
}

function check_ca_authors_data_configuni_edit_img_keyin_box() //檢查是否有輸入資料
{
		  if(document.getElementById("ch_authors_data_config_img").value.length == 0)
		  {
		          alert("未變更任何資料，將不進行任何動作!");
			      return false;
	      }
      form1.submit();			
}


