//创建一个showhidediv的方法，直接跟ID属性
function showhidediv(id){
var raido_sel_yes=document.getElementById("raido_sel_yes"); //使用
var raido_sel_no=document.getElementById("raido_sel_no");  //不使用

if (id == 'raido_sel_yes') {
    raido_sel_no.style.display='none';
	keyin_box02.value='';
} 
else if(id == 'raido_sel_no')
{
   //if (raido_sel_no.style.display=='none') {
    //btn00.style.display='none';
    raido_sel_no.style.display='block';
   //}
}

}


