

<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
			<div>
			<form method="post">
				
				<p>Write your dairy or your thought here</p>
				<textarea name="noteS" id="note" ></textarea>
			<input type="submit" name="submit" value="Submit">
			</form>
			</div>
<script>
    CKEDITOR.replace('note');
</script>
<a href="secret.php">GoToSecretPage</a>
<?php
include("call.php");
?>