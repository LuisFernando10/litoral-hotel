	
	<!DOCTYPE html>
	<html lang="en">
		<!-- Nós incluímos o <head> -->
		<?php include (dirname(__FILE__).'/includes/site-header.php'); ?>

		<body>
			<div class="super_container">
				<!-- Header - Nav (Menú) -->
				<?php include (dirname(__FILE__).'/includes/nav.php'); ?>

				<!-- Home -->
				<div class="home">
					<div class="background_image" style="background-image:url(<?php echo constant('IMAGES_WEB_URL'); ?>about.jpg)"></div>
					<div class="home_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content text-center">
										<div class="home_title">About us</div>
										<div class="booking_form_container">
											<form action="#" class="booking_form" id="booking_form">
												<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">
													<div class="booking_input_container d-flex flex-row align-items-start justify-content-start flex-wrap">
														<div><input type="text" class="datepicker booking_input booking_input_a booking_in" placeholder="Check in" required="required"></div>
														<div><input type="text" class="datepicker booking_input booking_input_a booking_out" placeholder="Check out" required="required"></div>
														<div><input type="number" class="booking_input booking_input_b" placeholder="Children" required="required"></div>
														<div><input type="number" class="booking_input booking_input_b" placeholder="Room" required="required"></div>
													</div>
													<div><button class="booking_button trans_200">Book Now</button></div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- About -->

				<div class="about">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<div class="about_title"><h2>The River / 10 years of excellence</h2></div>
							</div>
						</div>
						<div class="row about_row">

							<!-- About Content -->
							<div class="col-lg-6">
								<div class="about_content">
									<div class="about_text">
										<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit.</p>
									</div>
									<div class="about_sig"><img src="<?php echo constant('IMAGES_WEB_URL') ?>sig.png" alt=""></div>
								</div>
							</div>

							<!-- About Images -->
							<div class="col-lg-6">
								<div class="about_images d-flex flex-row align-items-start justify-content-between flex-wrap">
									<img src="<?php echo constant('IMAGES_WEB_URL') ?>about_1.png" alt="">
									<img src="<?php echo constant('IMAGES_WEB_URL') ?>about_2.png" alt="">
									<img src="<?php echo constant('IMAGES_WEB_URL') ?>about_3.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Split Section Right -->

				<div class="split_section_right container_custom">
					<div class="container">
						<div class="row row-xl-eq-height">

							<div class="col-xl-6 order-xl-1 order-2">
								<div class="split_section_image">
									<div class="background_image" style="background-image:url(images/milestones.jpg)"></div>
								</div>
							</div>

							<div class="col-xl-6 order-xl-2 order-1">
								<div class="split_section_right_content">
									<div class="split_section_title"><h1>Luxury Resort</h1></div>
									<div class="split_section_text">
										<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci.</p>
									</div>

									<!-- Milestones -->
									<div class="milestones_container d-flex flex-row align-items-start justify-content-start flex-wrap">
										
										<!-- Milestone -->
										<div class="milestone d-flex flex-row align-items-start justify-content-start">
											<div class="milestone_content">
												<div class="milestone_counter" data-end-value="45">0</div>
												<div class="milestone_title">Rooms available</div>
											</div>
										</div>

										<!-- Milestone -->
										<div class="milestone d-flex flex-row align-items-start justify-content-start">
											<div class="milestone_content">
												<div class="milestone_counter" data-end-value="21" data-sign-after="K">0</div>
												<div class="milestone_title">Tourists this year</div>
											</div>
										</div>

										<!-- Milestone -->
										<div class="milestone d-flex flex-row align-items-start justify-content-start">
											<div class="milestone_content">
												<div class="milestone_counter" data-end-value="2">0</div>
												<div class="milestone_title">Swimming pools</div>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Split Section Left -->

				<div class="split_section_left container_custom">
					<div class="container">
						<div class="row">
							<div class="col-xl-6">
								<div class="split_section_left_content">
									<div class="split_section_title"><h1>Wedding venue</h1></div>
									<div class="split_section_text">
										<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci ipsum, a bibendum lacus suscipit sit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse nec faucibus velit. Quisque eleifend orci.</p>
									</div>

									<!-- Loaders -->
									<div class="loaders_container d-flex flex-row align-items-start justify-content-start flex-wrap">

										<!-- Loader -->
										<div class="loader_container text-center">
											<div class="loader text-center" data-perc="0.9">
												<div class="loader_content">
													<div class="loader_title">Good Services</div>
												</div>
											</div>
										</div>

										<!-- Loader -->
										<div class="loader_container text-center">
											<div class="loader text-center" data-perc="0.8">
												<div class="loader_content">
													<div class="loader_title">Tourists</div>
												</div>
											</div>
										</div>

										<!-- Loader -->
										<div class="loader_container text-center">
											<div class="loader text-center" data-perc="1.0">
												<div class="loader_content">
													<div class="loader_title">Satisfaction</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

							<!-- Loaders Image -->
							<div class="col-xl-6">
								<div class="split_section_image split_section_left_image">
									<div class="background_image" style="background-image:url(images/loaders.jpg)"></div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Testimonials -->

				<div class="testimonials">
					<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?php echo constant('IMAGES_WEB_URL') ?>testimonials.jpg" data-speed="0.8"></div>
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
											<div class="testimonial_image"><img src="<?php echo constant('IMAGES_WEB_URL') ?>user_1.jpg" alt=""></div>
											<div class="testimonial_author"><a href="#">Samantha Smith</a>, Greece</div>
										</div>

										<!-- Slide -->
										<div  class="test_slider_item text-center">
											<div class="rating rating_5 d-flex flex-row align-items-start justify-content-center"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="testimonial_title"><a href="#">Nice place</a></div>
											<div class="testimonial_text">
												<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic.</p>
											</div>
											<div class="testimonial_image"><img src="<?php echo constant('IMAGES_WEB_URL') ?>user_2.jpg" alt=""></div>
											<div class="testimonial_author"><a href="#">Michael Doe</a>, Italy</div>
										</div>

										<!-- Slide -->
										<div  class="test_slider_item text-center">
											<div class="rating rating_5 d-flex flex-row align-items-start justify-content-center"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="testimonial_title"><a href="#">We loved it</a></div>
											<div class="testimonial_text">
												<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic.</p>
											</div>
											<div class="testimonial_image"><img src="<?php echo constant('IMAGES_WEB_URL') ?>user_3.jpg" alt=""></div>
											<div class="testimonial_author"><a href="#">Luis Garcia</a>, Spain</div>
										</div>

									</div>
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