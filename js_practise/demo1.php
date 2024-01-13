<!DOCTYPE html>
<html lang="en">
 
<body>
<form>
<?php
for($i = 0; $i < 10; $i++) { ?>
<input type="button" id="button-<?php echo $i; ?>" class="elementclass" value="click"><br/>
<?php } ?>
</form>
	<script>
	const form = document.querySelector('form');
	form.addEventListener('click', (e) => {
  if (e.target.tagName === 'INPUT'  && e.target.className == 'elementclass') {
     e.target.style.color = 'red';
		 e.target.style.backgroundColor = "green";
		 e.stopPropagation();
  }
});

</script>
 </body>
</html>