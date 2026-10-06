<?php if ( get_field( 'hide_header_and_footer' ) == 1 || get_field( 'hide_header' ) == 1 )  { ?>
<?php } else { ?> 
	<?php $accessLink = get_field( 'access_the_portal_link', 'options'  ); ?>
	<?php if ( is_page_template( 'templates/template-pre-event.php' )) { ?>
		<header class="header clear" role="banner">
			<div class="container">
				<span class="logo-container">
					<span class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logoHeader">
							<?php $imagedark = get_field( 'icon', 'options' ); ?>
							<img class="dark logo" src="<?php echo esc_attr( $imagedark['url'] ); ?>" alt="<?php echo $imagedark['alt'] ? esc_attr( $imagedark['alt'] ) : 'Adapt'; ?>" width="<?php echo esc_attr( get_field('logo_width', 'options') );?>" loading="lazy"/>
						</a>
					</span>
					<span class="powered-by">Powered by ADAPT ®</span>
				</span>
			</div>
		</header>
	<?php } else { ?>
		<header class="header clear" role="banner">
			<div class="container">
				<span class="logo-container">
					<span class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logoHeader">
							<?php $imagedark = get_field( 'icon', 'options' ); ?>
							<img class="dark logo" src="<?php echo esc_attr( $imagedark['url'] ); ?>" alt="<?php echo $imagedark['alt'] ? esc_attr( $imagedark['alt'] ) : 'Adapt'; ?>" width="<?php echo esc_attr( get_field('logo_width', 'options') );?>" loading="lazy"/>
						</a>
					</span>
					<span class="powered-by">Powered by ADAPT ®</span>
				</span>
				<span class="headerRight">
					<span class="menu">
						<?php theme_nav('main'); ?>
					</span>
					<?php if(get_field('register_popup_button', 'options') == 1 ){ ?> 						
						<a href="#register" class="ticket-button register-button">
							Register Your Interest
						</a>
					<?php } else { ?> 
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>tickets" class="ticket-button">
							Tickets & Attendance
						</a>
					<?php } ?>
					
					<span class="buttonWrapper">
						<a class="nav">
							<span class="ham"></span>
							<span class="menu-title">Menu</span>
						</a>
					</span>
				</span>
			</div>
			<?php
			$linkedInLink = get_field( 'linked_in', 'options'  );
			$youtubeLink = get_field( 'you_tube', 'options'  );
			?>
			<div class="mobileMenu">
				<div class="mobileInner">
					<div class="v-wrap">
						<div class="v-box">
							<div class="container">
								<span class="large-left-square"></span>
								<span class="small-left-square"></span>
								<div class="column-container">
									<div class="column one-half">
										<?php theme_nav('main'); ?>
									</div>
									<div class="column one-half">
										<?php if ( have_rows( 'header_menu_small_links', 'options' ) ) : ?>
											<?php while ( have_rows( 'header_menu_small_links', 'options' ) ) : the_row(); ?>
												<span class="header-link-container">
													<a class="header-links" href="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" target="<?php echo esc_attr( get_sub_field( 'link_target' ) ); ?>"><?php echo get_sub_field( 'link_text' ); ?></a>
												</span>
											<?php endwhile; ?>
										<?php else : ?>
											<?php // no rows found ?>
										<?php endif; ?>
										<span class="registered">Registered already?</br><a class="portal" href="<?php echo esc_attr( $accessLink ); ?>" target="_blank">Access the portal</a></span>
									</div>
								</div>
								<span class="border-right-square"></span>
								<span class="red-right-square"></span>
							</div>
						</div>
					</div>
					<div class="menu-bottom">
						<div class="container">
							<?php $footer_icon = get_field( 'footer_icon', 'options'  ); ?>
							<?php if ( $footer_icon ) { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo" src="<?php echo esc_attr( $footer_icon['url'] ); ?>" alt="<?php echo esc_attr( $footer_icon['alt'] ); ?>" loading="lazy"/></a>
							<?php } ?>
							<span class="link-container"><a class="site-link" href="https://adapt.com.au" target="_blank">adapt.com.au</a><a class="mail-link" href="mailto:<?php echo esc_attr( get_field( 'email', 'options' ) ); ?>" target="_blank"><?php the_field( 'email', 'options' ); ?></a><a class="phone-link" href="tel:<?php echo esc_attr( get_field( 'phone_number', 'options' ) ); ?>"><?php the_field( 'phone_number', 'options' ); ?></a></span>
							<span class="social-links">
								<?php if ($linkedInLink) {?>
									<a class="social-link linkedin" href="<?php echo esc_attr( $linkedInLink );?>">
										<svg version="1.1" id="Group_193" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 14.9 15" style="enable-background:new 0 0 14.9 15;" xml:space="preserve">
										<style type="text/css">
										.st0{fill:#FFFFFF;}
										</style>
										<g id="Group_196" transform="translate(5.963 5.923)">
										<g id="Group_193-2" transform="translate(0.596 4.149)">
										<path id="Path_56" class="st0" d="M-2.9,4.4c0,0.3-0.2,0.5-0.5,0.5h-2.2c-0.3,0-0.5-0.2-0.5-0.5v-9c0-0.3,0.2-0.5,0.5-0.5h2.2
										c0.3,0,0.5,0.2,0.5,0.5L-2.9,4.4z"/>
										</g>
										<g id="Group_194" transform="translate(0 0)">
										<ellipse id="Ellipse_12" class="st0" cx="-3.9" cy="-3.9" rx="2" ry="2"/>
										</g>
										<g id="Group_195" transform="translate(4.23 4.033)">
										<path id="Path_57" class="st0" d="M4.7,4.5C4.7,4.8,4.5,5,4.2,5l0,0H1.9C1.6,5,1.4,4.8,1.4,4.5l0,0V0.3c0-0.6,0.2-2.8-1.6-2.8
										C-1.6-2.5-1.9-1-2-0.3v4.9C-2,4.8-2.2,5-2.5,5l0,0h-2.2C-5,5-5.2,4.8-5.2,4.5l0,0v-9.1C-5.2-4.8-4.9-5-4.7-5l0,0h2.2
										C-2.2-5-2-4.8-2-4.6l0,0v0.8c0.7-1,1.8-1.5,3-1.4c3.7,0,3.7,3.5,3.7,5.3V4.5L4.7,4.5z"/>
										</g>
										</g>
									</svg>
									</a>
								<?php } ?>
								<?php if ($youtubeLink) {?>
								<a class="social-link linkedin" href="<?php echo esc_attr( $youtubeLink );?>">
									<svg version="1.1" id="Group_194" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									viewBox="0 0 16.6 11.8" style="enable-background:new 0 0 16.6 11.8;" xml:space="preserve">
									<style type="text/css">
									.st0{fill:#FFFFFF;}
									</style>
									<g id="Group_200" transform="translate(4.703 6.866)">
									<path id="Path_60" class="st0" d="M8.5-6.9h-9.7c-1.9,0-3.5,1.5-3.5,3.5v4.9C-4.7,3.4-3.2,5-1.2,5h9.7C10.4,5,12,3.5,12,1.5v-4.9
									C11.9-5.3,10.4-6.9,8.5-6.9z M6.1-0.8L1.6,1.4c-0.1,0-0.2,0-0.2-0.1V1.2v-4.5c0-0.1,0.1-0.2,0.2-0.2h0.1l4.5,2.3
									C6.2-1,6.3-0.9,6.1-0.8C6.2-0.8,6.2-0.8,6.1-0.8z"/>
									</g>
									</svg>
								</a>
								<?php } ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</header>
	<?php }?>
<?php }?>
