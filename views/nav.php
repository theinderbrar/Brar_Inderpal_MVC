<?php session_start() ?>
<header id="mainHeader">
	<div class="row">
		<div class="col-12 large-col-3">
			<img id="logo" src="images/logo.png" alt="logo">
		</div>
		<nav id="mainNav" class="col-12 large-col-9">
			<ul>
				<?php if (empty($_SESSION["role"])) {?>
					<li><a href="index.php?pg=home">Home</a></li>
					<li><a href="index.php?pg=about">About</a></li>
					<li><a href="index.php?pg=work">Work</a></li>
					<li><a href="index.php?pg=contact">Contact</a></li>
					<li><a href='index.php?pg=login'>Login</a></li>
				<?php } else{?>
					<li><a href="employee.php?pg=home">Home</a></li>
					<li><a href="index.php?pg=about">About</a></li>
					<li><a href="index.php?pg=work">Work</a></li>
					<li><a href="index.php?pg=contact">Contact</a></li>
					<li><a href='index.php?pg=logout'>Logout</a></li>
				<?php } ?>;
			</ul>
		</nav>
	</div>
</header>