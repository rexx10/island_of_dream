<form action="post_edit.php" method="post">
	<textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
	<input type="submit" value="Sumbit">
</form>


<?php
include_once "ckeditor/ckeditor.php";
$CKEditor = new CKEditor();
$CKEditor->basePath = 'ckeditor/';
$CKEditor->replace("editor1");
?>