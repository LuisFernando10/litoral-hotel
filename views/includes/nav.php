	
	<header class="header">
		<div class="header_content d-flex flex-row align-items-center justify-content-start">
			<div class="logo">
				<a href="<?php echo constant('FULL_WEB_URL') ?>">
					Hotel <span>Litoral</span>
					<p>Espaço, Conforto e Tranquilidade</p>
				</a>
			</div>
			<div class="ml-auto d-flex flex-row align-items-center justify-content-start">
				<nav class="main_nav">
					<ul class="d-flex flex-row align-items-start justify-content-start">
						<li class="active"><a href="<?php echo constant('FULL_WEB_URL') ?>home/">Inicio</a></li>
						<li><a href="<?php echo constant('FULL_WEB_URL') ?>about/">Sobre nós</a></li>
						<li><a href="<?php echo constant('FULL_WEB_URL') ?>views/#">Quartos</a></li>
						<!-- <li><a href="<?php echo constant('FULL_WEB_URL') ?>views/blog.php">Blog</a></li> -->
						<li><a href="<?php echo constant('FULL_WEB_URL') ?>views/contact.php">Contato</a></li>
					</ul>
				</nav>
				<div class="book_button"><a href="<?php echo constant('FULL_WEB_URL') ?>views/booking.php">Reserva Online</a></div>
				<div class="header_phone d-flex flex-row align-items-center justify-content-center">
					<img src="<?php echo constant('ASSETS_WEB_URL'); ?>img/phone.png" alt="">
					<span>+55 79 9988-2442</span>
				</div>

				<!-- Hamburger Menu -->
				<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
			</div>
		</div>
	</header>

	<!-- Menu -->
	<div class="menu trans_400 d-flex flex-column align-items-end justify-content-start">
		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="menu_content">
			<nav class="menu_nav text-right">
				<ul>
					<li><a href="<?php echo constant('FULL_WEB_URL') ?>views/index.php">Inicio</a></li>
					<li><a href="<?php echo constant('FULL_WEB_URL') ?>views/about.php">Sobre nós</a></li>
					<li><a href="<?php echo constant('FULL_WEB_URL') ?>views/#">Quartos</a></li>
					<!-- <li><a href="<?php echo constant('FULL_WEB_URL') ?>views/blog.php">Blog</a></li> -->
					<li><a href="<?php echo constant('FULL_WEB_URL') ?>views/contact.php">Contato</a></li>
				</ul>
			</nav>
		</div>
		<div class="menu_extra">
			<div class="menu_book text-right"><a href="<?php echo constant('FULL_WEB_URL') ?>views/#">Reserva online</a></div>
			<div class="menu_phone d-flex flex-row align-items-center justify-content-center">
				<img src="<?php echo constant('ASSETS_WEB_URL'); ?>img/phone-2.png" alt="">
				<span>+55 79 9988-2442</span>
			</div>
		</div>
	</div>