
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
					<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/booking.jpg)"></div>
						<div class="home_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="home_content text-center">
											<div class="home_title">Book a room</div>
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

						<!-- Booking -->
						<div class="booking">
							<div class="container">
								<div class="row">
									<div class="col">
										<!-- Booking Slider -->
										<div class="booking_slider_container">
											<div class="owl-carousel owl-theme booking_slider">

											<!-- Slide -->
											<div class="booking_item">
												<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/booking_1.jpg)"></div>
												<div class="booking_overlay trans_200"></div>
												<div class="booking_item_content">
													<div class="booking_item_list">
														<ul>
															<li>27 m² Patio</li>
															<li>Balcony with view</li>
															<li>Garden / Mountain view</li>
															<li>Flat-screen TV</li>
															<li>Air conditioning</li>
															<li>Soundproofing</li>
															<li>Private bathroom</li>
															<li>Free WiFi</li>
														</ul>
													</div>
												</div>
												<div class="booking_price">$120/Night</div>
												<div class="booking_link"><a href="booking.html">Family Room</a></div>
										</div>

										<!-- Slide -->
										<div class="booking_item">
											<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/booking_2.jpg)"></div>
											<div class="booking_overlay trans_200"></div>
											<div class="booking_item_content">
												<div class="booking_item_list">
													<ul>
														<li>27 m² Patio</li>
														<li>Balcony with view</li>
														<li>Garden / Mountain view</li>
														<li>Flat-screen TV</li>
														<li>Air conditioning</li>
														<li>Soundproofing</li>
														<li>Private bathroom</li>
														<li>Free WiFi</li>
													</ul>
												</div>
											</div>
											<div class="booking_price">$120/Night</div>
											<div class="booking_link"><a href="booking.html">Deluxe Room</a></div>
										</div>

										<!-- Slide -->
										<div class="booking_item">
											<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/booking_3.jpg)"></div>
											<div class="booking_overlay trans_200"></div>
											<div class="booking_item_content">
												<div class="booking_item_list">
													<ul>
														<li>27 m² Patio</li>
														<li>Balcony with view</li>
														<li>Garden / Mountain view</li>
														<li>Flat-screen TV</li>
														<li>Air conditioning</li>
														<li>Soundproofing</li>
														<li>Private bathroom</li>
														<li>Free WiFi</li>
													</ul>
												</div>
											</div>
											<div class="booking_price">$120/Night</div>
											<div class="booking_link"><a href="booking.html">Single Room</a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Details Right -->
				<div class="details">
					<div class="container">
						<div class="row">
							<!-- Details Image -->
							<div class="col-xl-7 col-lg-6">
								<div class="details_image">
									<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/details_1.jpg)"></div>
								</div>
							</div>

							<!-- Details Content -->
							<div class="col-xl-5 col-lg-6">
								<div class="details_content">
									<div class="details_title">Family Room</div>
									<div class="details_list">
										<ul>
											<li>27 m² Patio</li>
											<li>Balcony with view</li>
											<li>Garden / Mountain view</li>
											<li>Flat-screen TV</li>
											<li>Air conditioning</li>
											<li>Soundproofing</li>
											<li>Private bathroom</li>
											<li>Free WiFi</li>
										</ul>
									</div>
									<div class="details_long_list">
										<ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
											<li>Balcony</li>
											<li>Mountain view</li>
											<li>Terrace</li>
											<li>TV</li>
											<li>Satellite Channels</li>
											<li>Safety Deposit Box</li>
											<li>Heating</li>
											<li>Sofa</li>
											<li>Tile/Marble floor</li>
											<li>Mosquito net</li>
											<li>Wardrobe/Closet</li>
											<li>Sofa bed</li>
											<li>Shower</li>
											<li>Hairdryer</li>
											<li>Free toiletries</li>
											<li>Toilet</li>
											<li>Bath or Shower</li>
											<li>Toilet paper</li>
											<li>Tea/Coffee Maker</li>
											<li>Minibar</li>
											<li>Dining area</li>
											<li>Electric kettle</li>
											<li>Dining table</li>
											<li>Outdoor furniture</li>
											<li>Outdoor dining area</li>
											<li>Towels</li>
											<li>Linen</li>
											<li>Upper floors accessible by lift</li>
										</ul>
									</div>
									<div class="book_now_button"><a href="#">Book Now</a></div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Details Left -->

				<div class="details">
					<div class="container">
						<div class="row">

							<!-- Details Content -->
							<div class="col-xl-5 col-lg-6 order-lg-1 order-2">
								<div class="details_content">
									<div class="details_title">Double Room</div>
									<div class="details_list">
										<ul>
											<li>27 m² Patio</li>
											<li>Balcony with view</li>
											<li>Garden / Mountain view</li>
											<li>Flat-screen TV</li>
											<li>Air conditioning</li>
											<li>Soundproofing</li>
											<li>Private bathroom</li>
											<li>Free WiFi</li>
										</ul>
									</div>
									<div class="details_long_list">
										<ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
											<li>Balcony</li>
											<li>Mountain view</li>
											<li>Terrace</li>
											<li>TV</li>
											<li>Satellite Channels</li>
											<li>Safety Deposit Box</li>
											<li>Heating</li>
											<li>Sofa</li>
											<li>Tile/Marble floor</li>
											<li>Mosquito net</li>
											<li>Wardrobe/Closet</li>
											<li>Sofa bed</li>
											<li>Shower</li>
											<li>Hairdryer</li>
											<li>Free toiletries</li>
											<li>Toilet</li>
											<li>Bath or Shower</li>
											<li>Toilet paper</li>
											<li>Tea/Coffee Maker</li>
											<li>Minibar</li>
											<li>Dining area</li>
											<li>Electric kettle</li>
											<li>Dining table</li>
											<li>Outdoor furniture</li>
											<li>Outdoor dining area</li>
											<li>Towels</li>
											<li>Linen</li>
											<li>Upper floors accessible by lift</li>
										</ul>
									</div>
									<div class="book_now_button"><a href="#">Book Now</a></div>
								</div>
							</div>

							<!-- Details Image -->
							<div class="col-xl-7 col-lg-6 order-lg-2 order-1">
								<div class="details_image">
									<div class="background_image" style="background-image:url(<?php echo constant('ASSETS_WEB_URL') ?>img/details_2.jpg)"></div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Special -->

				<div class="special">
					<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?php echo constant('ASSETS_WEB_URL') ?>img/special.jpg" data-speed="0.8"></div>
					<div class="container">
						<div class="row">
							<div class="col-xl-6 offset-xl-6 col-lg-8 offset-lg-2">
								<div class="special_content">
									<div class="details_title">Special Offer - Family Room</div>
									<div class="details_list">
										<ul>
											<li>27 m² Patio</li>
											<li>Balcony with view</li>
											<li>Garden / Mountain view</li>
											<li>Flat-screen TV</li>
											<li>Air conditioning</li>
											<li>Soundproofing</li>
											<li>Private bathroom</li>
											<li>Free WiFi</li>
										</ul>
									</div>
									<div class="details_long_list">
										<ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
											<li>Balcony</li>
											<li>Mountain view</li>
											<li>Terrace</li>
											<li>TV</li>
											<li>Satellite Channels</li>
											<li>Safety Deposit Box</li>
											<li>Heating</li>
											<li>Sofa</li>
											<li>Tile/Marble floor</li>
											<li>Mosquito net</li>
											<li>Wardrobe/Closet</li>
											<li>Sofa bed</li>
											<li>Shower</li>
											<li>Hairdryer</li>
											<li>Free toiletries</li>
											<li>Toilet</li>
											<li>Bath or Shower</li>
											<li>Toilet paper</li>
											<li>Tea/Coffee Maker</li>
											<li>Minibar</li>
											<li>Dining area</li>
											<li>Electric kettle</li>
											<li>Dining table</li>
											<li>Outdoor furniture</li>
											<li>Outdoor dining area</li>
											<li>Towels</li>
											<li>Linen</li>
											<li>Upper floors accessible by lift</li>
										</ul>
									</div>
									<div class="book_now_button"><a href="#">Book Now</a></div>
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