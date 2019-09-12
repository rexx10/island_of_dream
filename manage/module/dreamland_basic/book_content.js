function more(){
	var acc = document.getElementById('copy').cloneNode(true);
	acc.style.display = 'block';
	var ins = document.getElementById('write');
	ins.parentNode.insertBefore(acc,ins);
	//document.forms.button.disabled=true;
	document.getElementById('add_more').disabled = true; //使用ID控制
	
}

function del_main_all_data(author_code, book_name_code, del_data){
	if(confirm("請再次確認是否要刪除作品編號："+book_name_code))
	  location.href = "author_book_main_data_sql.php?del_author_code="+ author_code + "&del_book_name_code="+ book_name_code +"&author_book_data_type="+ del_data;
	  //"author_book_main_data_sql.php?del_author_code="+ author_code + "&del_book_name_code="+ book_name_code +";//&author_book_img_type="+ del_data+;
	//, book_name_code, del_data
}

function check_keyin_box2() //檢查是否有輸入資料
{
          if(document.getElementById("authors_group_list_authors_name").value.length == 0)
		  {
		      alert("警告！尚未輸入作者名稱！");
			  return false;
	      }
		  if(document.getElementById("authors_group_list_authors_code").value.length == 0)
		  {
		      alert("警告！尚未輸入作者代號！");
			  return false;
	      }
		  if(document.getElementById("group_authors_webside_name").value.length == 0)
		  {
		      alert("警告！尚未輸入作者網站名稱！");
			  return false;
	      }
		  if(document.getElementById("group_authors_webside").value.length == 0)
		  {
		      alert("警告！尚未輸入作者網站網址！");
			  return false;
	      }
		  if(document.getElementById("group_authors_img").value.length == 0)
		  {
		      alert("警告！尚未輸入作者網站圖片！");
			  return false;
	      }
		  if(document.getElementById("group_authors_img").value.length == 0)
		  {
		      alert("警告！尚未輸入作者網站圖片！");
			  return false;
	      }
      form1.submit();			
}