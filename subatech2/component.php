<?php
// No direct access.
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/subatech2/css/print.css" type="text/css" media="print,screen,projection" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<body class="contentpane">
	<div id="all">
		<div id="topbanner">
		<img src="<?php echo $this->baseurl ?>/templates/subatech2/images/logo_subatech_for_print.png" width="200px" height="81px" />
		</div>
		<div id="main">
				<jdoc:include type="message" />
				<jdoc:include type="component" />
		</div>
	</div>
</body>
</html>