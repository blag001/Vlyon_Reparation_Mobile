<?php
if(!empty($_SESSION['tampon']['js']) and is_array($_SESSION['tampon']['js']))
	foreach ($_SESSION['tampon']['js'] as $value)
		echo $_SESSION['tampon']['js'] . "\n";
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="toolBootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
