//创建一个showhidediv的方法，直接跟ID属性
function showhidediv(id){
var btn00=document.getElementById("btn00-1");
var btn01=document.getElementById("btn01-1");
var btn02=document.getElementById("btn02-1");
var btn03=document.getElementById("btn03-1");
var btn04=document.getElementById("btn04-1");
var btn05=document.getElementById("btn05-1");
var btn06=document.getElementById("btn06-1");
var btn07=document.getElementById("btn07-1");
if (id == 'btn00') {
   if (btn00.style.display=='none') {
    btn01.style.display='none';
    btn00.style.display='block';
   }
} 
else if(id == 'btn01')
{
   if (btn01.style.display=='none') {
    btn00.style.display='none';
    btn01.style.display='block';
   }
}
else if(id == 'btn02')
{
   if (btn02.style.display=='none') {
    btn03.style.display='none';
    btn02.style.display='block';
   }
}
else if(id == 'btn03')
{
   if (btn03.style.display=='none') {
    btn02.style.display='none';
    btn03.style.display='block';
   }
}
else if(id == 'btn04')
{
   if (btn04.style.display=='none') {
    btn05.style.display='none';
    btn04.style.display='block';
   }
}
else if(id == 'btn05')
{
   if (btn05.style.display=='none') {
    btn04.style.display='none';
    btn05.style.display='block';
   }
}
else if(id == 'btn06')
{
   if (btn06.style.display=='none') {
    btn07.style.display='none';
    btn06.style.display='block';
   }
}
else if(id == 'btn07')
{
   if (btn07.style.display=='none') {
    btn06.style.display='none';
    btn07.style.display='block';
   }
}
}