<?php 
    $title = '403'; 
    ob_start(); 
 ?>
 
<div class="container">
<h1>403 : Page interdite</h1>
</div>

<?php 
    $content = ob_get_clean(); 
    require('template.php'); 
?>