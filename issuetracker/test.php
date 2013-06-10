<html>
<head>
<script type="text/javascript">
function changeVis(id) {
   if (document.getElementById(id).style.display == 'none') {document.getElementById(id).style.display = 'block';}
   else {document.getElementById(id).style.display = 'none';}
}
</script>
</head>

<body>

<a href="javascript:changeVis('div1')">Show</a>
<div id='div1' style='display:none'>This is the content.</div>

</body>

<?php
?>

</html>
