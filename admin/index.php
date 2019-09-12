	<?php
	SESSION_START();
	if(isset($_SESSION['adminuser'])){
	include('check_session.php');
	}
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=8" /> 
        <title>管理員登入頁面</title>
		  <link rel="shortcut icon" href="./../images/logo2.png">
          <link rel=stylesheet type="text/css" href="./index_login.css">
      </head>
      <body>
       <div id="main_container">
         <div id="main_header">
             
             <div id="breadcrumb" class="clear ">
</div>
         </div>
         <div id="main_login" class="frame clear narrow_item">
  <div class="frame_top">
    <h3 class="float_l">管理員登入</h3>
  </div>

  <div class="frame_body">
    <p></p>
        <form id="login_form" class="create" name="mylogin" action="myactionlogin.php" method="POST">
    <div class="table_container ">
  
  <table>
    <tbody>
        <tr>
            <td class="label" style="">
              <div class="label">
                帳號：
              </div>
            </td>
            <td class="value ">
                    <input id="username" type="text" name="username" class="" maxlength="" value="" tabindex="101" /> 
            </td>
        </tr>
        <tr>
            <td class="label" style="">
              <div class="label">
                密碼：
              </div>
            </td>
            <td class="value ">
                    <input id="password" type="password" name="password" />
            </td>
        </tr>
    </tbody>
  </table>
    </div>
	<input type="hidden" name="refer" value="<?php echo (isset($_GET['refer'])) ? $_GET['refer'] : 'index.php'; ?>">
    <div class="signupButton">
        <input type="submit" name="submit" id="login" value="登入" />
    </div>
    </form>

  </div>
</div>
       </div>



     </body>
   </html>





