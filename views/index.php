
	<?php
		/**
		* @Description: Documento que contiene la estructura HTML del 'home'
		* @User: luis.chamorro
		* @Date: 06-10-2019
		*/
	?>

	<!DOCTYPE html>
	<html lang="es">
	
		<!-- Nós incluímos o <head> -->
		<?php include (dirname(__FILE__).'/includes/site-header.php'); ?>

		<body>
			<div class="super_container">
				<!-- Header - Nav (Menú) -->
				<?php include (dirname(__FILE__).'/includes/nav.php'); ?>

				<!-- Home -->
				<div class="home">
					<div class="home_slider_container">
						<div class="owl-carousel owl-theme home_slider">

							<!-- Slide -->
							<div class="slide">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/kitchen.jpg)"></div>
								<div class="home_container">
									<div class="container">
										<div class="row">
											<div class="col">
												<div class="home_content text-center">
													<div class="home_title">Café da manhã</div>
													<div class="booking_form_container">
														<form action="#" class="booking_form">
															<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">
																<div class="booking_input_container d-flex flex-lg-row flex-column align-items-start justify-content-start">
																	<div>
																		<input type="text" class="datepicker booking_input booking_input_a booking_in" placeholder="Check-in" required="required">
																	</div>
																	<div>
																		<input type="text" class="datepicker booking_input booking_input_a booking_out" placeholder="Check-out" required="required">
																	</div>
																	<div>
																		<input type="number" class="booking_input booking_input_b" placeholder="Crianças" required="required">
																	</div>
																	<div>
																		<input type="number" class="booking_input booking_input_b" placeholder="Quartos" required="required">
																	</div>
																</div>
																<div><button class="booking_button trans_200">Reserve agora</button></div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide -->
							<div class="slide">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/room.jpg)"></div>
								<div class="home_container">
									<div class="container">
										<div class="row">
											<div class="col">
												<div class="home_content text-center">
													<div class="home_title">Estadia confortável</div>
													<div class="booking_form_container">
														<form action="#" class="booking_form">
															<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">
																<div class="booking_input_container d-flex flex-lg-row flex-column align-items-start justify-content-start">
																	<div>
																		<input type="text" class="datepicker booking_input booking_input_a booking_in" placeholder="Check-in" required="required">
																	</div>
																	<div>
																		<input type="text" class="datepicker booking_input booking_input_a booking_out" placeholder="Check-out" required="required">
																	</div>
																	<div>
																		<input type="number" class="booking_input booking_input_b" placeholder="Crianças" required="required">
																	</div>
																	<div>
																		<input type="number" class="booking_input booking_input_b" placeholder="Quartos" required="required">
																	</div>
																</div>
																<div><button class="booking_button trans_200">Reserve agora</button></div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Slide -->
							<div class="slide">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/reception.jpg)"></div>
								<div class="home_container">
									<div class="container">
										<div class="row">
											<div class="col">
												<div class="home_content text-center">
													<div class="home_title">Ótimo serviço</div>
													<div class="booking_form_container">
														<form action="#" class="booking_form">
															<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">
																<div class="booking_input_container d-flex flex-lg-row flex-column align-items-start justify-content-start">
																	<div>
																		<input type="text" class="datepicker booking_input booking_input_a booking_in" placeholder="Check-in" required="required">
																	</div>
																	<div>
																		<input type="text" class="datepicker booking_input booking_input_a booking_out" placeholder="Check-out" required="required">
																	</div>
																	<div>
																		<input type="number" class="booking_input booking_input_b" placeholder="Crianças" required="required">
																	</div>
																	<div>
																		<input type="number" class="booking_input booking_input_b" placeholder="Quartos" required="required">
																	</div>
																</div>
																<div><button class="booking_button trans_200">Reserve agora</button></div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

						<!-- Home Slider Dots -->
						<div class="home_slider_dots_container">
							<div class="home_slider_dots">
								<ul id="home_slider_custom_dots" class="home_slider_custom_dots d-flex flex-row align-items-start justify-content-start">
									<li class="home_slider_custom_dot active">1 -</li>
									<li class="home_slider_custom_dot">2 -</li>
									<li class="home_slider_custom_dot">3</li>
								</ul>
							</div>
						</div>

					</div>
				</div>

				<!-- Features -->
				<div class="features">
					<div class="container">
						<div class="row">

							<!-- Icon Box -->
							<div class="col-lg-4 icon_box_col">
								<div class="icon_box d-flex flex-column align-items-center justify-content-start text-center">
									<div class="icon_box_icon"><img src="<?php echo constant('ASSETS_WEB_URL') ?>img/icon_1.svg" class="svg" alt="https://www.flaticon.com/authors/monkik"></div>
									<div class="icon_box_title"><h2>Fabuloso Resort</h2></div>
									<div class="icon_box_text">
										<p>Espaço, conforto e tranquilidade que oferecemos aos nossos clientes, você pode ter certeza de que no Hotel Litoral você aproveitará ao máximo sua estadia em Aracaju.</p>
									</div>
								</div>
							</div>

							<!-- Icon Box -->
							<div class="col-lg-4 icon_box_col">
								<div class="icon_box d-flex flex-column align-items-center justify-content-start text-center">
									<div class="icon_box_icon"><img src="<?php echo constant('ASSETS_WEB_URL') ?>img/icon_4.svg" class="svg" alt="https://www.flaticon.com/authors/monkik"></div>
									<div class="icon_box_title"><h2>Acomodação</h2></div>
									<div class="icon_box_text">
										<p>Camas confortáveis, TV, ar condicionado split, secador de cabelo, frigobar e WIFI estão à sua disposição.</p>
									</div>
								</div>
							</div>

							<!-- Icon Box -->
							<div class="col-lg-4 icon_box_col">
								<div class="icon_box d-flex flex-column align-items-center justify-content-start text-center">
									<div class="icon_box_icon"><img src="<?php echo constant('ASSETS_WEB_URL') ?>img/icon_3.svg" class="svg" alt="https://www.flaticon.com/authors/monkik"></div>
									<div class="icon_box_title"><h2>Excelente localização</h2></div>
									<div class="icon_box_text">
										<p>O Hotel Litoral fica muito perto da orla de Aracaju. Você pode chegar à praia em apenas 5 minutos a pé. Além disso, você pode aproveitar seu fim de semana curtindo os shows de música ao vivo encontrados ao longo da costa.</p>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Gallery -->
				<div class="gallery">
					<div class="gallery_slider_container">
						<div class="owl-carousel owl-theme gallery_slider">

							<!-- Slide -->
							<div class="gallery_item">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/mainFacade.jpg)"></div>
								<a class="colorbox" href="<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/mainFacade.jpg"></a>
							</div>

							<!-- Slide -->
							<div class="gallery_item">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/dinningroom.jpg)"></div>
								<a class="colorbox" href="<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/dinningroom.jpg"></a>
							</div>

							<!-- Slide -->
							<div class="gallery_item">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/bathroom.jpg)"></div>
								<a class="colorbox" href="<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/bathroom.jpg"></a>
							</div>

							<!-- Slide -->
							<div class="gallery_item">
								<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/livingroom.jpg)"></div>
								<a class="colorbox" href="<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/livingroom.jpg"></a>
							</div>

						</div>
					</div>
				</div>

				<!-- About -->
				<div class="about">
					<div class="container">
						<div class="row">				
							<!-- About Content -->
							<div class="col-lg-6">
								<div class="about_content">
									<div class="about_title">
										<h2>Hotel Litoral / 14 anos de excelencia</h2>
									</div>
									<div class="about_text">
										<p>Llevamos 14 años ofreciendo el mejor servicio posible a turistas tanto brasileros como extranjeros, ubicado a tan solo 100mts de la playa, con una excelente calidad humana y unas instalaciones sencillas, pero realmente cómodas; nos preocupamos porque usted se sienta a gusto en nuestro hotel, ofrecemos un excelente desayuno en donde puede usted comer a gusto y empezar su día con la mejor actitud.</p>
									</div>
								</div>
							</div>

							<!-- About Images -->
							<div class="col-lg-6">
								<div class="about_images d-flex flex-row align-items-center justify-content-between flex-wrap">
									<img src="<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/facade-hotel.jpg" alt="Facade Hotel">
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Testimonials -->
				<div class="testimonials">
					<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?php echo constant('ASSETS_WEB_URL') ?>img/testimonials.jpg" data-speed="0.8"></div>
					<div class="testimonials_overlay"></div>
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="testimonials_slider_container">

									<!-- Testimonials Slider -->
									<div class="owl-carousel owl-theme test_slider">

										<!-- Slide -->
										<div  class="test_slider_item text-center">
											<div class="rating rating_5 d-flex flex-row align-items-start justify-content-center"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="testimonial_title"><a href="#">Perfect Stay</a></div>
											<div class="testimonial_text">
												<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic.</p>
											</div>
											<div class="testimonial_image"><img src="<?php echo constant('ASSETS_WEB_URL') ?>img/user_1.jpg" alt=""></div>
											<div class="testimonial_author"><a href="#">Samantha Smith</a>, Greece</div>
										</div>

										<!-- Slide -->
										<div  class="test_slider_item text-center">
											<div class="rating rating_5 d-flex flex-row align-items-start justify-content-center"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="testimonial_title"><a href="#">Nice place</a></div>
											<div class="testimonial_text">
												<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic.</p>
											</div>
											<div class="testimonial_image"><img src="<?php echo constant('ASSETS_WEB_URL') ?>img/user_2.jpg" alt=""></div>
											<div class="testimonial_author"><a href="#">Michael Doe</a>, Italy</div>
										</div>

										<!-- Slide -->
										<div  class="test_slider_item text-center">
											<div class="rating rating_5 d-flex flex-row align-items-start justify-content-center"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="testimonial_title"><a href="#">We loved it</a></div>
											<div class="testimonial_text">
												<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic.</p>
											</div>
											<div class="testimonial_image"><img src="<?php echo constant('ASSETS_WEB_URL') ?>img/user_3.jpg" alt=""></div>
											<div class="testimonial_author"><a href="#">Luis Garcia</a>, Spain</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Booking -->
				<div class="booking">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="booking_title text-center"><h2>Reserve um quarto</h2></div>
								<div class="booking_text text-center">
									<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit.</p>
								</div>

								<!-- Booking Slider -->
								<div class="booking_slider_container">
									<div class="owl-carousel owl-theme booking_slider">

										<!-- Slide -->
										<div class="booking_item">
											<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/triple-room.jpg)"></div>
											<div class="booking_overlay trans_200"></div>
											<div class="booking_price">R$ 185,00/Noite</div>
											<div class="booking_link"><a href="booking.html">Apto. Triplo</a></div>
										</div>

										<!-- Slide -->
										<div class="booking_item">
											<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/married-room.jpg)"></div>
											<div class="booking_overlay trans_200"></div>
											<div class="booking_price">R$ 145,00/Noite</div>
											<div class="booking_link"><a href="booking.html">Apto. Duplo/Casal</a></div>
										</div>

										<!-- Slide -->
										<div class="booking_item">
											<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/HotelLitoral/single-room.jpg)"></div>
											<div class="booking_overlay trans_200"></div>
											<div class="booking_price">R$ 115,00/Noite</div>
											<div class="booking_link"><a href="booking.html">Apto. Single</a></div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Blog -->
				<div class="blog">

					<!-- Blog Slider -->
					<div class="blog_slider_container">
						<div class="owl-carousel owl-theme blog_slider">

							<!-- Slide -->
							<div class="blog_slide">
								<div class="background_image" style="background-image:url(images/index_blog_1.jpg)"></div>
								<div class="blog_content">
									<div class="blog_date"><a href="#">Oct 20, 2018</a></div>
									<div class="blog_title"><a href="#">How to book your stay</a></div>
								</div>
							</div>

							<!-- Slide -->
							<div class="blog_slide">
								<div class="background_image" style="background-image:url(images/index_blog_2.jpg)"></div>
								<div class="blog_content">
									<div class="blog_date"><a href="#">Oct 20, 2018</a></div>
									<div class="blog_title"><a href="#">10 restaurants in town</a></div>
								</div>
							</div>

							<!-- Slide -->
							<div class="blog_slide">
								<div class="background_image" style="background-image:url(images/index_blog_3.jpg)"></div>
								<div class="blog_content">
									<div class="blog_date"><a href="#">Oct 20, 2018</a></div>
									<div class="blog_title"><a href="#">A perfect wedding</a></div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Footer -->
				<?php include (dirname(__FILE__).'/includes/footer.php'); ?>
			</div>

			<!-- Nós incluímos o <head> -->
			<?php include (dirname(__FILE__).'/includes/footer-scripts.php'); ?>
		</body>
	</html>