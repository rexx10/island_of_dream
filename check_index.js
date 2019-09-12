$(function(){
$("#Submit").click(function(){
var name = $("#id_username").val();
var pass = $("#id_password").val();
if( name=='' ){
alert('提醒: 帳號未填!');
return false;
}
if( pass=='' ){
alert('提醒: 密碼未填!');
return false;
}
});
});