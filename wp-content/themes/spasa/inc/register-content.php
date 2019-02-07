<div class="content center">
	<?php if(get_field('site_status', options) == '1'): ?>
		<?php
			global $wpdb,$user_id;
			if($_POST) {
				$error = 0;
				$username = esc_sql($_REQUEST['username']);
				$password = esc_sql($_REQUEST['password']);
				$confirm = esc_sql($_REQUEST['confirm']);
				$first_name = esc_sql($_REQUEST['first_name']);
				$last_name = esc_sql($_REQUEST['last_name']);
				$business = esc_sql($_REQUEST['business']);
				$email = esc_sql($_REQUEST['email']);
				$state_awards = esc_sql($_REQUEST['state_awards']);
				$address_line_1 = esc_sql($_REQUEST['address_line_1']);
				$address_line_2 = esc_sql($_REQUEST['address_line_2']);
				$address_city = esc_sql($_REQUEST['address_city']);
				$address_state = esc_sql($_REQUEST['address_state']);
				$address_country = esc_sql($_REQUEST['address_country']);
				$address_postcode = esc_sql($_REQUEST['address_postcode']);
				$telephone = esc_sql($_REQUEST['telephone']);
				$website = esc_sql($_REQUEST['website']);
				if (empty($username)) {
					$error = 1;
				}
				$email = esc_sql($_REQUEST['email']);
				if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $email)) {
					$error = 1;
				}
				if($error == 1) {
					echo '<div class="error-message">There was a problem with your registration - please check your details before submitting again</div>';
				}
				if($error == 0) {
					$user_id = wp_create_user($username, $password, $email);
					if (is_wp_error($user_id)) {
						echo '<div class="error-message">Username or email address have already been registered - please try again</div>';
					} else {
						$user_data = wp_update_user(
							array(
								'ID' => $user_id, 
								'user_nicename' => $first_name.' '.$last_name,
								'display_name' => $first_name.' '.$last_name,
								'nickname' => $first_name.' '.$last_name,
								'first_name' => $first_name,
								'last_name' => $last_name,
								'user_url' => $website,
								'role' => 'member',
							)
						);
						update_user_meta($user_id, 'member_business', $business);
						update_user_meta($user_id, 'member_address_line_1', $address_line_1);
						update_user_meta($user_id, 'member_address_line_2', $address_line_2);
						update_user_meta($user_id, 'member_city', $address_city);
						update_user_meta($user_id, 'member_state', $address_state);
						update_user_meta($user_id, 'member_country', $address_country);
						update_user_meta($user_id, 'member_postcode', $address_postcode);
						update_user_meta($user_id, 'member_telephone', $telephone);
						update_user_meta($user_id, 'member_website', $website);
						
						update_user_meta($user_id, 'member_state_awards', $state_awards);
						
						$member_to = $email;
						$member_subject = 'Successful Registration - SPASA Awards';
						$member_message = 'Thank you for registering for The SPASA Awards.'."\n\n".'Your login details are:'."\n\n".'Username: '.$username."\n".'Password: '.str_repeat('*', strlen($password)-4) . substr($password, -4)."\n\n".'To log in please visit '.get_bloginfo('url').'/login/';
						wp_mail($member_to, $member_subject, $member_message);
						$admin_to = get_option('admin_email');
						$admin_subject = 'New Registration - SPASA Awards';
						if(empty($address_line_2)) {
							$admin_message = 'A new member has registered for the SPASA Awards.'."\n\n".'Name: '.$first_name.' '.$last_name."\n".'Business: '.$business."\n".'Email: '.$email."\n".'Telephone: '.$telephone."\n".'Website: '.$website."\n\n".'State awards they wish to enter: '.$state_awards."\n\n".'Address: '.$address_line_1."\n".$address_city."\n".$address_state."\n".$address_country."\n".$address_postcode;
						} else {
							$admin_message = 'A new member has registered for the SPASA Awards.'."\n\n".'Name: '.$first_name.' '.$last_name."\n".'Business: '.$business."\n".'Email: '.$email."\n".'Telephone: '.$telephone."\n".'Website: '.$website."\n\n".'State awards they wish to enter: '.$state_awards."\n\n".'Address: '.$address_line_1."\n".$address_line_2."\n".$address_city."\n".$address_state."\n".$address_country."\n".$address_postcode;
						}
						wp_mail($admin_to, $admin_subject, $admin_message);
						echo '<h2>Thank you for registering for the SPASA Awards.</h2><p>Please check your email for confirmation of your login details.</p><p><a href="'.get_bloginfo('url').'/login/">Click here to log in</a></p>';
						$error = 2;
					}
				}
			}
			if ($error != 2) {
				if(get_option('users_can_register')) {		
		?>
			<form action="" method="post">
				<h2>Log In Details</h2>
				<div class="columns-3">
					<p> 
						<label for="username">Username <span class="required">*</span></label><br />
						<input type="text" id="username" name="username" value="<?php if(!empty($username)) { echo $username; } ?>" required="required" />
						<span class="smalltext">Can contain a mix of letters (a-z) and numbers</span>
					</p>
					<p> 
						<label for="password">Password <span class="required">*</span></label><br />
						<input type="password" id="password" name="password" value="<?php if(!empty($password)) { echo $password; } ?>" required="required" />
						<span class="smalltext password-strength">Must contain a mix of letters (a-z) and numbers</span>
					</p>
					<p> 
						<label for="confirm">Confirm password <span class="required">*</span></label><br />
						<input type="password" id="confirm" name="confirm" value="<?php if(!empty($confirm)) { echo $confirm; } ?>" required="required" />
					</p>
				</div>
				<hr />
				<h2>About You</h2>
				<div class="columns-3">
					<p> 
						<label for="first_name">First name <span class="required">*</span></label><br />
						<input type="text" id="first_name" name="first_name" value="<?php if(!empty($first_name)) { echo $first_name; } ?>" required="required" />
					</p>
					<p> 
						<label for="last_name">Last name <span class="required">*</span></label><br />
						<input type="text" id="last_name" name="last_name" value="<?php if(!empty($last_name)) { echo $last_name; } ?>" required="required" />
					</p>
					<p> 
						<label for="business">SPASA member business name <span class="required">*</span></label><br />
						<input type="text" id="business" name="business" value="<?php if(!empty($business)) { echo $business; } ?>" required="required" />
					</p>
					<p> 
						<label for="email">Email <span class="required">*</span></label><br />
						<input type="email" id="email" name="email" value="<?php if(!empty($email)) { echo $email; } ?>" required="required" />
					</p>
					<p> 
						<label for="state_awards">Which state awards do you wish to enter? <span class="required">*</span></label><br />
						<select id="state_awards" name="state_awards" required="required">
							<option value=""> </option>
							<option value="New South Wales"<?php if(!empty($state_awards) && $state_awards == 'New South Wales'): ?> selected="selected"<?php endif; ?>>New South Wales</option>
							<option value="South Australia"<?php if(!empty($state_awards) && $state_awards == 'South Australia'): ?> selected="selected"<?php endif; ?>>South Australia</option>
							<option value="Queensland"<?php if(!empty($state_awards) && $state_awards == 'Queensland'): ?> selected="selected"<?php endif; ?>>Queensland</option>
							<option value="Victoria"<?php if(!empty($state_awards) && $state_awards == 'Victoria'): ?> selected="selected"<?php endif; ?>>Victoria</option>
							<option value="Western Australia"<?php if(!empty($state_awards) && $state_awards == 'Western Australia'): ?> selected="selected"<?php endif; ?>>Western Australia</option>
						</select>
					</p>
				</div>
				<hr />
				<h2>Your Address</h2>
				<div class="columns-3">
					<p> 
						<label for="address_line_1">Street address <span class="required">*</span></label><br />
						<input type="text" id="address_line_1" name="address_line_1" value="<?php if(!empty($address_line_1)) { echo $address_line_1; } ?>" required="required" />
					</p>
					<p> 
						<label for="address_line_2">Address line 2</label><br />
						<input type="text" id="address_line_2" name="address_line_2" value="<?php if(!empty($address_line_2)) { echo $address_line_2; } ?>" />
					</p>
					<p> 
						<label for="address_city">City <span class="required">*</span></label><br />
						<input type="text" id="address_city" name="address_city" value="<?php if(!empty($address_city)) { echo $address_city; } ?>" required="required" />
					</p>
					<p> 
						<label for="address_state">State <span class="required">*</span></label><br />
						<input type="text" id="address_state" name="address_state" value="<?php if(!empty($address_state)) { echo $address_state; } ?>" required="required" />
					</p>
					<p> 
						<label for="address_country">Country <span class="required">*</span></label><br />
						<select id="address_country" name="address_country" required="required">
							<option value=""> </option>
							<option value="Australia"<?php if(!empty($address_country) && $address_country == 'Australia'): ?> selected="selected"<?php endif; ?>>Australia</option>
							<option value=""> </option>
							<option value="Afghanistan"<?php if(!empty($address_country) && $address_country == 'Afghanistan'): ?> selected="selected"<?php endif; ?>>Afghanistan</option>
							<option value="Albania"<?php if(!empty($address_country) && $address_country == 'Albania'): ?> selected="selected"<?php endif; ?>>Albania</option>
							<option value="Algeria"<?php if(!empty($address_country) && $address_country == 'Algeria'): ?> selected="selected"<?php endif; ?>>Algeria</option>
							<option value="American Samoa"<?php if(!empty($address_country) && $address_country == 'American Samoa'): ?> selected="selected"<?php endif; ?>>American Samoa</option>
							<option value="Andorra"<?php if(!empty($address_country) && $address_country == 'Andorra'): ?> selected="selected"<?php endif; ?>>Andorra</option>
							<option value="Angola"<?php if(!empty($address_country) && $address_country == 'Angola'): ?> selected="selected"<?php endif; ?>>Angola</option>
							<option value="Antigua and Barbuda"<?php if(!empty($address_country) && $address_country == 'Antigua and Barbuda'): ?> selected="selected"<?php endif; ?>>Antigua and Barbuda</option>
							<option value="Argentina"<?php if(!empty($address_country) && $address_country == 'Argentina'): ?> selected="selected"<?php endif; ?>>Argentina</option>
							<option value="Armenia"<?php if(!empty($address_country) && $address_country == 'Armenia'): ?> selected="selected"<?php endif; ?>>Armenia</option>
							<option value="Austria"<?php if(!empty($address_country) && $address_country == 'Austria'): ?> selected="selected"<?php endif; ?>>Austria</option>
							<option value="Azerbaijan"<?php if(!empty($address_country) && $address_country == 'Azerbaijan'): ?> selected="selected"<?php endif; ?>>Azerbaijan</option>
							<option value="Bahamas"<?php if(!empty($address_country) && $address_country == 'Bahamas'): ?> selected="selected"<?php endif; ?>>Bahamas</option>
							<option value="Bahrain"<?php if(!empty($address_country) && $address_country == 'Bahrain'): ?> selected="selected"<?php endif; ?>>Bahrain</option>
							<option value="Bangladesh"<?php if(!empty($address_country) && $address_country == 'Bangladesh'): ?> selected="selected"<?php endif; ?>>Bangladesh</option>
							<option value="Barbados"<?php if(!empty($address_country) && $address_country == 'Barbados'): ?> selected="selected"<?php endif; ?>>Barbados</option>
							<option value="Belarus"<?php if(!empty($address_country) && $address_country == 'Belarus'): ?> selected="selected"<?php endif; ?>>Belarus</option>
							<option value="Belgium"<?php if(!empty($address_country) && $address_country == 'Belgium'): ?> selected="selected"<?php endif; ?>>Belgium</option>
							<option value="Belize"<?php if(!empty($address_country) && $address_country == 'Belize'): ?> selected="selected"<?php endif; ?>>Belize</option>
							<option value="Benin"<?php if(!empty($address_country) && $address_country == 'Benin'): ?> selected="selected"<?php endif; ?>>Benin</option>
							<option value="Bermuda"<?php if(!empty($address_country) && $address_country == 'Bermuda'): ?> selected="selected"<?php endif; ?>>Bermuda</option>
							<option value="Bhutan"<?php if(!empty($address_country) && $address_country == 'Bhutan'): ?> selected="selected"<?php endif; ?>>Bhutan</option>
							<option value="Bolivia"<?php if(!empty($address_country) && $address_country == 'Bolivia'): ?> selected="selected"<?php endif; ?>>Bolivia</option>
							<option value="Bosnia and Herzegovina"<?php if(!empty($address_country) && $address_country == 'Bosnia and Herzegovina'): ?> selected="selected"<?php endif; ?>>Bosnia and Herzegovina</option>
							<option value="Botswana"<?php if(!empty($address_country) && $address_country == 'Botswana'): ?> selected="selected"<?php endif; ?>>Botswana</option>
							<option value="Brazil"<?php if(!empty($address_country) && $address_country == 'Brazil'): ?> selected="selected"<?php endif; ?>>Brazil</option>
							<option value="Brunei"<?php if(!empty($address_country) && $address_country == 'Brunei'): ?> selected="selected"<?php endif; ?>>Brunei</option>
							<option value="Bulgaria"<?php if(!empty($address_country) && $address_country == 'Bulgaria'): ?> selected="selected"<?php endif; ?>>Bulgaria</option>
							<option value="Burkina Faso"<?php if(!empty($address_country) && $address_country == 'Burkina Faso'): ?> selected="selected"<?php endif; ?>>Burkina Faso</option>
							<option value="Burundi"<?php if(!empty($address_country) && $address_country == 'Burundi'): ?> selected="selected"<?php endif; ?>>Burundi</option>
							<option value="Cambodia"<?php if(!empty($address_country) && $address_country == 'Cambodia'): ?> selected="selected"<?php endif; ?>>Cambodia</option>
							<option value="Cameroon"<?php if(!empty($address_country) && $address_country == 'Cameroon'): ?> selected="selected"<?php endif; ?>>Cameroon</option>
							<option value="Canada"<?php if(!empty($address_country) && $address_country == 'Canada'): ?> selected="selected"<?php endif; ?>>Canada</option>
							<option value="Cape Verde"<?php if(!empty($address_country) && $address_country == 'Cape Verde'): ?> selected="selected"<?php endif; ?>>Cape Verde</option>
							<option value="Cayman Islands"<?php if(!empty($address_country) && $address_country == 'Cayman Islands'): ?> selected="selected"<?php endif; ?>>Cayman Islands</option>
							<option value="Central African Republic"<?php if(!empty($address_country) && $address_country == 'Central African Republic'): ?> selected="selected"<?php endif; ?>>Central African Republic</option>
							<option value="Chad"<?php if(!empty($address_country) && $address_country == 'Chad'): ?> selected="selected"<?php endif; ?>>Chad</option>
							<option value="Chile"<?php if(!empty($address_country) && $address_country == 'Chile'): ?> selected="selected"<?php endif; ?>>Chile</option>
							<option value="China"<?php if(!empty($address_country) && $address_country == 'China'): ?> selected="selected"<?php endif; ?>>China</option>
							<option value="Colombia"<?php if(!empty($address_country) && $address_country == 'Colombia'): ?> selected="selected"<?php endif; ?>>Colombia</option>
							<option value="Comoros"<?php if(!empty($address_country) && $address_country == 'Comoros'): ?> selected="selected"<?php endif; ?>>Comoros</option>
							<option value="Congo, Democratic Republic of the"<?php if(!empty($address_country) && $address_country == 'Congo, Democratic Republic of the'): ?> selected="selected"<?php endif; ?>>Congo, Democratic Republic of the</option>
							<option value="Congo, Republic of the"<?php if(!empty($address_country) && $address_country == 'Congo, Republic of the'): ?> selected="selected"<?php endif; ?>>Congo, Republic of the</option>
							<option value="Costa Rica"<?php if(!empty($address_country) && $address_country == 'Costa Rica'): ?> selected="selected"<?php endif; ?>>Costa Rica</option>
							<option value="Cote d'Ivoire"<?php if(!empty($address_country) && $address_country == 'Cote d\'Ivoire'): ?> selected="selected"<?php endif; ?>>Cote d'Ivoire</option>
							<option value="Croatia"<?php if(!empty($address_country) && $address_country == 'Croatia'): ?> selected="selected"<?php endif; ?>>Croatia</option>
							<option value="Cuba"<?php if(!empty($address_country) && $address_country == 'Cuba'): ?> selected="selected"<?php endif; ?>>Cuba</option>
							<option value="Curaçao"<?php if(!empty($address_country) && $address_country == 'Curaçao'): ?> selected="selected"<?php endif; ?>>Curaçao</option>
							<option value="Cyprus"<?php if(!empty($address_country) && $address_country == 'Cyprus'): ?> selected="selected"<?php endif; ?>>Cyprus</option>
							<option value="Czech Republic"<?php if(!empty($address_country) && $address_country == 'Czech Republic'): ?> selected="selected"<?php endif; ?>>Czech Republic</option>
							<option value="Denmark"<?php if(!empty($address_country) && $address_country == 'Denmark'): ?> selected="selected"<?php endif; ?>>Denmark</option>
							<option value="Djibouti"<?php if(!empty($address_country) && $address_country == 'Djibouti'): ?> selected="selected"<?php endif; ?>>Djibouti</option>
							<option value="Dominica"<?php if(!empty($address_country) && $address_country == 'Dominica'): ?> selected="selected"<?php endif; ?>>Dominica</option>
							<option value="Dominican Republic"<?php if(!empty($address_country) && $address_country == 'Dominican Republic'): ?> selected="selected"<?php endif; ?>>Dominican Republic</option>
							<option value="East Timor"<?php if(!empty($address_country) && $address_country == 'East Timor'): ?> selected="selected"<?php endif; ?>>East Timor</option>
							<option value="Ecuador"<?php if(!empty($address_country) && $address_country == 'Ecuador'): ?> selected="selected"<?php endif; ?>>Ecuador</option>
							<option value="Egypt"<?php if(!empty($address_country) && $address_country == 'Egypt'): ?> selected="selected"<?php endif; ?>>Egypt</option>
							<option value="El Salvador"<?php if(!empty($address_country) && $address_country == 'El Salvador'): ?> selected="selected"<?php endif; ?>>El Salvador</option>
							<option value="Equatorial Guinea"<?php if(!empty($address_country) && $address_country == 'Equatorial Guinea'): ?> selected="selected"<?php endif; ?>>Equatorial Guinea</option>
							<option value="Eritrea"<?php if(!empty($address_country) && $address_country == 'Eritrea'): ?> selected="selected"<?php endif; ?>>Eritrea</option>
							<option value="Estonia"<?php if(!empty($address_country) && $address_country == 'Estonia'): ?> selected="selected"<?php endif; ?>>Estonia</option>
							<option value="Ethiopia"<?php if(!empty($address_country) && $address_country == 'Ethiopia'): ?> selected="selected"<?php endif; ?>>Ethiopia</option>
							<option value="Faroe Islands"<?php if(!empty($address_country) && $address_country == 'Faroe Islands'): ?> selected="selected"<?php endif; ?>>Faroe Islands</option>
							<option value="Fiji"<?php if(!empty($address_country) && $address_country == 'Fiji'): ?> selected="selected"<?php endif; ?>>Fiji</option>
							<option value="Finland"<?php if(!empty($address_country) && $address_country == 'Finland'): ?> selected="selected"<?php endif; ?>>Finland</option>
							<option value="France"<?php if(!empty($address_country) && $address_country == 'France'): ?> selected="selected"<?php endif; ?>>France</option>
							<option value="French Polynesia"<?php if(!empty($address_country) && $address_country == 'French Polynesia'): ?> selected="selected"<?php endif; ?>>French Polynesia</option>
							<option value="Gabon"<?php if(!empty($address_country) && $address_country == 'Gabon'): ?> selected="selected"<?php endif; ?>>Gabon</option>
							<option value="Gambia"<?php if(!empty($address_country) && $address_country == 'Gambia'): ?> selected="selected"<?php endif; ?>>Gambia</option>
							<option value="Georgia"<?php if(!empty($address_country) && $address_country == 'Georgia'): ?> selected="selected"<?php endif; ?>>Georgia</option>
							<option value="Germany"<?php if(!empty($address_country) && $address_country == 'Germany'): ?> selected="selected"<?php endif; ?>>Germany</option>
							<option value="Ghana"<?php if(!empty($address_country) && $address_country == 'Ghana'): ?> selected="selected"<?php endif; ?>>Ghana</option>
							<option value="Greece"<?php if(!empty($address_country) && $address_country == 'Greece'): ?> selected="selected"<?php endif; ?>>Greece</option>
							<option value="Greenland"<?php if(!empty($address_country) && $address_country == 'Greenland'): ?> selected="selected"<?php endif; ?>>Greenland</option>
							<option value="Grenada"<?php if(!empty($address_country) && $address_country == 'Grenada'): ?> selected="selected"<?php endif; ?>>Grenada</option>
							<option value="Guam"<?php if(!empty($address_country) && $address_country == 'Guam'): ?> selected="selected"<?php endif; ?>>Guam</option>
							<option value="Guatemala"<?php if(!empty($address_country) && $address_country == 'Guatemala'): ?> selected="selected"<?php endif; ?>>Guatemala</option>
							<option value="Guinea"<?php if(!empty($address_country) && $address_country == 'Guinea'): ?> selected="selected"<?php endif; ?>>Guinea</option>
							<option value="Guinea-Bissau"<?php if(!empty($address_country) && $address_country == 'Guinea-Bissau'): ?> selected="selected"<?php endif; ?>>Guinea-Bissau</option>
							<option value="Guyana"<?php if(!empty($address_country) && $address_country == 'Guyana'): ?> selected="selected"<?php endif; ?>>Guyana</option>
							<option value="Haiti"<?php if(!empty($address_country) && $address_country == 'Haiti'): ?> selected="selected"<?php endif; ?>>Haiti</option>
							<option value="Honduras"<?php if(!empty($address_country) && $address_country == 'Honduras'): ?> selected="selected"<?php endif; ?>>Honduras</option>
							<option value="Hong Kong"<?php if(!empty($address_country) && $address_country == 'Hong Kong'): ?> selected="selected"<?php endif; ?>>Hong Kong</option>
							<option value="Hungary"<?php if(!empty($address_country) && $address_country == 'Hungary'): ?> selected="selected"<?php endif; ?>>Hungary</option>
							<option value="Iceland"<?php if(!empty($address_country) && $address_country == 'Iceland'): ?> selected="selected"<?php endif; ?>>Iceland</option>
							<option value="India"<?php if(!empty($address_country) && $address_country == 'India'): ?> selected="selected"<?php endif; ?>>India</option>
							<option value="Indonesia"<?php if(!empty($address_country) && $address_country == 'Indonesia'): ?> selected="selected"<?php endif; ?>>Indonesia</option>
							<option value="Iran"<?php if(!empty($address_country) && $address_country == 'Iran'): ?> selected="selected"<?php endif; ?>>Iran</option>
							<option value="Iraq"<?php if(!empty($address_country) && $address_country == 'Iraq'): ?> selected="selected"<?php endif; ?>>Iraq</option>
							<option value="Ireland"<?php if(!empty($address_country) && $address_country == 'Ireland'): ?> selected="selected"<?php endif; ?>>Ireland</option>
							<option value="Israel"<?php if(!empty($address_country) && $address_country == 'Israel'): ?> selected="selected"<?php endif; ?>>Israel</option>
							<option value="Italy"<?php if(!empty($address_country) && $address_country == 'Italy'): ?> selected="selected"<?php endif; ?>>Italy</option>
							<option value="Jamaica"<?php if(!empty($address_country) && $address_country == 'Jamaica'): ?> selected="selected"<?php endif; ?>>Jamaica</option>
							<option value="Japan"<?php if(!empty($address_country) && $address_country == 'Japan'): ?> selected="selected"<?php endif; ?>>Japan</option>
							<option value="Jordan"<?php if(!empty($address_country) && $address_country == 'Jordan'): ?> selected="selected"<?php endif; ?>>Jordan</option>
							<option value="Kazakhstan"<?php if(!empty($address_country) && $address_country == 'Kazakhstan'): ?> selected="selected"<?php endif; ?>>Kazakhstan</option>
							<option value="Kenya"<?php if(!empty($address_country) && $address_country == 'Kenya'): ?> selected="selected"<?php endif; ?>>Kenya</option>
							<option value="Kiribati"<?php if(!empty($address_country) && $address_country == 'Kiribati'): ?> selected="selected"<?php endif; ?>>Kiribati</option>
							<option value="North Korea"<?php if(!empty($address_country) && $address_country == 'North Korea'): ?> selected="selected"<?php endif; ?>>North Korea</option>
							<option value="South Korea"<?php if(!empty($address_country) && $address_country == 'South Korea'): ?> selected="selected"<?php endif; ?>>South Korea</option>
							<option value="Kosovo"<?php if(!empty($address_country) && $address_country == 'Kosovo'): ?> selected="selected"<?php endif; ?>>Kosovo</option>
							<option value="Kuwait"<?php if(!empty($address_country) && $address_country == 'Kuwait'): ?> selected="selected"<?php endif; ?>>Kuwait</option>
							<option value="Kyrgyzstan"<?php if(!empty($address_country) && $address_country == 'Kyrgyzstan'): ?> selected="selected"<?php endif; ?>>Kyrgyzstan</option>
							<option value="Laos"<?php if(!empty($address_country) && $address_country == 'Laos'): ?> selected="selected"<?php endif; ?>>Laos</option>
							<option value="Latvia"<?php if(!empty($address_country) && $address_country == 'Latvia'): ?> selected="selected"<?php endif; ?>>Latvia</option>
							<option value="Lebanon"<?php if(!empty($address_country) && $address_country == 'Lebanon'): ?> selected="selected"<?php endif; ?>>Lebanon</option>
							<option value="Lesotho"<?php if(!empty($address_country) && $address_country == 'Lesotho'): ?> selected="selected"<?php endif; ?>>Lesotho</option>
							<option value="Liberia"<?php if(!empty($address_country) && $address_country == 'Liberia'): ?> selected="selected"<?php endif; ?>>Liberia</option>
							<option value="Libya"<?php if(!empty($address_country) && $address_country == 'Libya'): ?> selected="selected"<?php endif; ?>>Libya</option>
							<option value="Liechtenstein"<?php if(!empty($address_country) && $address_country == 'Liechtenstein'): ?> selected="selected"<?php endif; ?>>Liechtenstein</option>
							<option value="Lithuania"<?php if(!empty($address_country) && $address_country == 'Lithuania'): ?> selected="selected"<?php endif; ?>>Lithuania</option>
							<option value="Luxembourg"<?php if(!empty($address_country) && $address_country == 'Luxembourg'): ?> selected="selected"<?php endif; ?>>Luxembourg</option>
							<option value="Macedonia"<?php if(!empty($address_country) && $address_country == 'Macedonia'): ?> selected="selected"<?php endif; ?>>Macedonia</option>
							<option value="Madagascar"<?php if(!empty($address_country) && $address_country == 'Madagascar'): ?> selected="selected"<?php endif; ?>>Madagascar</option>
							<option value="Malawi"<?php if(!empty($address_country) && $address_country == 'Malawi'): ?> selected="selected"<?php endif; ?>>Malawi</option>
							<option value="Malaysia"<?php if(!empty($address_country) && $address_country == 'Malaysia'): ?> selected="selected"<?php endif; ?>>Malaysia</option>
							<option value="Maldives"<?php if(!empty($address_country) && $address_country == 'Maldives'): ?> selected="selected"<?php endif; ?>>Maldives</option>
							<option value="Mali"<?php if(!empty($address_country) && $address_country == 'Mali'): ?> selected="selected"<?php endif; ?>>Mali</option>
							<option value="Malta"<?php if(!empty($address_country) && $address_country == 'Malta'): ?> selected="selected"<?php endif; ?>>Malta</option>
							<option value="Marshall Islands"<?php if(!empty($address_country) && $address_country == 'Marshall Islands'): ?> selected="selected"<?php endif; ?>>Marshall Islands</option>
							<option value="Mauritania"<?php if(!empty($address_country) && $address_country == 'Mauritania'): ?> selected="selected"<?php endif; ?>>Mauritania</option>
							<option value="Mauritius"<?php if(!empty($address_country) && $address_country == 'Mauritius'): ?> selected="selected"<?php endif; ?>>Mauritius</option>
							<option value="Mexico"<?php if(!empty($address_country) && $address_country == 'Mexico'): ?> selected="selected"<?php endif; ?>>Mexico</option>
							<option value="Micronesia"<?php if(!empty($address_country) && $address_country == 'Micronesia'): ?> selected="selected"<?php endif; ?>>Micronesia</option>
							<option value="Moldova"<?php if(!empty($address_country) && $address_country == 'Moldova'): ?> selected="selected"<?php endif; ?>>Moldova</option>
							<option value="Monaco"<?php if(!empty($address_country) && $address_country == 'Monaco'): ?> selected="selected"<?php endif; ?>>Monaco</option>
							<option value="Mongolia"<?php if(!empty($address_country) && $address_country == 'Mongolia'): ?> selected="selected"<?php endif; ?>>Mongolia</option>
							<option value="Montenegro"<?php if(!empty($address_country) && $address_country == 'Montenegro'): ?> selected="selected"<?php endif; ?>>Montenegro</option>
							<option value="Morocco"<?php if(!empty($address_country) && $address_country == 'Morocco'): ?> selected="selected"<?php endif; ?>>Morocco</option>
							<option value="Mozambique"<?php if(!empty($address_country) && $address_country == 'Mozambique'): ?> selected="selected"<?php endif; ?>>Mozambique</option>
							<option value="Myanmar"<?php if(!empty($address_country) && $address_country == 'Myanmar'): ?> selected="selected"<?php endif; ?>>Myanmar</option>
							<option value="Namibia"<?php if(!empty($address_country) && $address_country == 'Namibia'): ?> selected="selected"<?php endif; ?>>Namibia</option>
							<option value="Nauru"<?php if(!empty($address_country) && $address_country == 'Nauru'): ?> selected="selected"<?php endif; ?>>Nauru</option>
							<option value="Nepal"<?php if(!empty($address_country) && $address_country == 'Nepal'): ?> selected="selected"<?php endif; ?>>Nepal</option>
							<option value="Netherlands"<?php if(!empty($address_country) && $address_country == 'Netherlands'): ?> selected="selected"<?php endif; ?>>Netherlands</option>
							<option value="New Zealand"<?php if(!empty($address_country) && $address_country == 'New Zealand'): ?> selected="selected"<?php endif; ?>>New Zealand</option>
							<option value="Nicaragua"<?php if(!empty($address_country) && $address_country == 'Nicaragua'): ?> selected="selected"<?php endif; ?>>Nicaragua</option>
							<option value="Niger"<?php if(!empty($address_country) && $address_country == 'Niger'): ?> selected="selected"<?php endif; ?>>Niger</option>
							<option value="Nigeria"<?php if(!empty($address_country) && $address_country == 'Nigeria'): ?> selected="selected"<?php endif; ?>>Nigeria</option>
							<option value="Northern Mariana Islands"<?php if(!empty($address_country) && $address_country == 'Northern Mariana Islands'): ?> selected="selected"<?php endif; ?>>Northern Mariana Islands</option>
							<option value="Norway"<?php if(!empty($address_country) && $address_country == 'Norway'): ?> selected="selected"<?php endif; ?>>Norway</option>
							<option value="Oman"<?php if(!empty($address_country) && $address_country == 'Oman'): ?> selected="selected"<?php endif; ?>>Oman</option>
							<option value="Pakistan"<?php if(!empty($address_country) && $address_country == 'Pakistan'): ?> selected="selected"<?php endif; ?>>Pakistan</option>
							<option value="Palau"<?php if(!empty($address_country) && $address_country == 'Palau'): ?> selected="selected"<?php endif; ?>>Palau</option>
							<option value="Palestine, State of"<?php if(!empty($address_country) && $address_country == 'Palestine, State of'): ?> selected="selected"<?php endif; ?>>Palestine, State of</option>
							<option value="Panama"<?php if(!empty($address_country) && $address_country == 'Panama'): ?> selected="selected"<?php endif; ?>>Panama</option>
							<option value="Papua New Guinea"<?php if(!empty($address_country) && $address_country == 'Papua New Guinea'): ?> selected="selected"<?php endif; ?>>Papua New Guinea</option>
							<option value="Paraguay"<?php if(!empty($address_country) && $address_country == 'Paraguay'): ?> selected="selected"<?php endif; ?>>Paraguay</option>
							<option value="Peru"<?php if(!empty($address_country) && $address_country == 'Peru'): ?> selected="selected"<?php endif; ?>>Peru</option>
							<option value="Philippines"<?php if(!empty($address_country) && $address_country == 'Philippines'): ?> selected="selected"<?php endif; ?>>Philippines</option>
							<option value="Poland"<?php if(!empty($address_country) && $address_country == 'Poland'): ?> selected="selected"<?php endif; ?>>Poland</option>
							<option value="Portugal"<?php if(!empty($address_country) && $address_country == 'Portugal'): ?> selected="selected"<?php endif; ?>>Portugal</option>
							<option value="Puerto Rico"<?php if(!empty($address_country) && $address_country == 'Puerto Rico'): ?> selected="selected"<?php endif; ?>>Puerto Rico</option>
							<option value="Qatar"<?php if(!empty($address_country) && $address_country == 'Qatar'): ?> selected="selected"<?php endif; ?>>Qatar</option>
							<option value="Romania"<?php if(!empty($address_country) && $address_country == 'Romania'): ?> selected="selected"<?php endif; ?>>Romania</option>
							<option value="Russia"<?php if(!empty($address_country) && $address_country == 'Russia'): ?> selected="selected"<?php endif; ?>>Russia</option>
							<option value="Rwanda"<?php if(!empty($address_country) && $address_country == 'Rwanda'): ?> selected="selected"<?php endif; ?>>Rwanda</option>
							<option value="Saint Kitts and Nevis"<?php if(!empty($address_country) && $address_country == 'Saint Kitts and Nevis'): ?> selected="selected"<?php endif; ?>>Saint Kitts and Nevis</option>
							<option value="Saint Lucia"<?php if(!empty($address_country) && $address_country == 'Saint Lucia'): ?> selected="selected"<?php endif; ?>>Saint Lucia</option>
							<option value="Saint Vincent and the Grenadines"<?php if(!empty($address_country) && $address_country == 'Saint Vincent and the Grenadines'): ?> selected="selected"<?php endif; ?>>Saint Vincent and the Grenadines</option>
							<option value="Samoa"<?php if(!empty($address_country) && $address_country == 'Samoa'): ?> selected="selected"<?php endif; ?>>Samoa</option>
							<option value="San Marino"<?php if(!empty($address_country) && $address_country == 'San Marino'): ?> selected="selected"<?php endif; ?>>San Marino</option>
							<option value="Sao Tome and Principe"<?php if(!empty($address_country) && $address_country == 'Sao Tome and Principe'): ?> selected="selected"<?php endif; ?>>Sao Tome and Principe</option>
							<option value="Saudi Arabia"<?php if(!empty($address_country) && $address_country == 'Saudi Arabia'): ?> selected="selected"<?php endif; ?>>Saudi Arabia</option>
							<option value="Senegal"<?php if(!empty($address_country) && $address_country == 'Senegal'): ?> selected="selected"<?php endif; ?>>Senegal</option>
							<option value="Serbia"<?php if(!empty($address_country) && $address_country == 'Serbia'): ?> selected="selected"<?php endif; ?>>Serbia</option>
							<option value="Seychelles"<?php if(!empty($address_country) && $address_country == 'Seychelles'): ?> selected="selected"<?php endif; ?>>Seychelles</option>
							<option value="Sierra Leone"<?php if(!empty($address_country) && $address_country == 'Sierra Leone'): ?> selected="selected"<?php endif; ?>>Sierra Leone</option>
							<option value="Singapore"<?php if(!empty($address_country) && $address_country == 'Singapore'): ?> selected="selected"<?php endif; ?>>Singapore</option>
							<option value="Sint Maarten"<?php if(!empty($address_country) && $address_country == 'Sint Maarten'): ?> selected="selected"<?php endif; ?>>Sint Maarten</option>
							<option value="Slovakia"<?php if(!empty($address_country) && $address_country == 'Slovakia'): ?> selected="selected"<?php endif; ?>>Slovakia</option>
							<option value="Slovenia"<?php if(!empty($address_country) && $address_country == 'Slovenia'): ?> selected="selected"<?php endif; ?>>Slovenia</option>
							<option value="Solomon Islands"<?php if(!empty($address_country) && $address_country == 'Solomon Islands'): ?> selected="selected"<?php endif; ?>>Solomon Islands</option>
							<option value="Somalia"<?php if(!empty($address_country) && $address_country == 'Somalia'): ?> selected="selected"<?php endif; ?>>Somalia</option>
							<option value="South Africa"<?php if(!empty($address_country) && $address_country == 'South Africa'): ?> selected="selected"<?php endif; ?>>South Africa</option>
							<option value="Spain"<?php if(!empty($address_country) && $address_country == 'Spain'): ?> selected="selected"<?php endif; ?>>Spain</option>
							<option value="Sri Lanka"<?php if(!empty($address_country) && $address_country == 'Sri Lanka'): ?> selected="selected"<?php endif; ?>>Sri Lanka</option>
							<option value="Sudan"<?php if(!empty($address_country) && $address_country == 'Sudan'): ?> selected="selected"<?php endif; ?>>Sudan</option>
							<option value="Sudan, South"<?php if(!empty($address_country) && $address_country == 'Sudan, South'): ?> selected="selected"<?php endif; ?>>Sudan, South</option>
							<option value="Suriname"<?php if(!empty($address_country) && $address_country == 'Suriname'): ?> selected="selected"<?php endif; ?>>Suriname</option>
							<option value="Swaziland"<?php if(!empty($address_country) && $address_country == 'Swaziland'): ?> selected="selected"<?php endif; ?>>Swaziland</option>
							<option value="Sweden"<?php if(!empty($address_country) && $address_country == 'Sweden'): ?> selected="selected"<?php endif; ?>>Sweden</option>
							<option value="Switzerland"<?php if(!empty($address_country) && $address_country == 'Switzerland'): ?> selected="selected"<?php endif; ?>>Switzerland</option>
							<option value="Syria"<?php if(!empty($address_country) && $address_country == 'Syria'): ?> selected="selected"<?php endif; ?>>Syria</option>
							<option value="Taiwan"<?php if(!empty($address_country) && $address_country == 'Taiwan'): ?> selected="selected"<?php endif; ?>>Taiwan</option>
							<option value="Tajikistan"<?php if(!empty($address_country) && $address_country == 'Tajikistan'): ?> selected="selected"<?php endif; ?>>Tajikistan</option>
							<option value="Tanzania"<?php if(!empty($address_country) && $address_country == 'Tanzania'): ?> selected="selected"<?php endif; ?>>Tanzania</option>
							<option value="Thailand"<?php if(!empty($address_country) && $address_country == 'Thailand'): ?> selected="selected"<?php endif; ?>>Thailand</option>
							<option value="Togo"<?php if(!empty($address_country) && $address_country == 'Togo'): ?> selected="selected"<?php endif; ?>>Togo</option>
							<option value="Tonga"<?php if(!empty($address_country) && $address_country == 'Tonga'): ?> selected="selected"<?php endif; ?>>Tonga</option>
							<option value="Trinidad and Tobago"<?php if(!empty($address_country) && $address_country == 'Trinidad and Tobago'): ?> selected="selected"<?php endif; ?>>Trinidad and Tobago</option>
							<option value="Tunisia"<?php if(!empty($address_country) && $address_country == 'Tunisia'): ?> selected="selected"<?php endif; ?>>Tunisia</option>
							<option value="Turkey"<?php if(!empty($address_country) && $address_country == 'Turkey'): ?> selected="selected"<?php endif; ?>>Turkey</option>
							<option value="Turkmenistan"<?php if(!empty($address_country) && $address_country == 'Turkmenistan'): ?> selected="selected"<?php endif; ?>>Turkmenistan</option>
							<option value="Tuvalu"<?php if(!empty($address_country) && $address_country == 'Tuvalu'): ?> selected="selected"<?php endif; ?>>Tuvalu</option>
							<option value="Uganda"<?php if(!empty($address_country) && $address_country == 'Uganda'): ?> selected="selected"<?php endif; ?>>Uganda</option>
							<option value="Ukraine"<?php if(!empty($address_country) && $address_country == 'Ukraine'): ?> selected="selected"<?php endif; ?>>Ukraine</option>
							<option value="United Arab Emirates"<?php if(!empty($address_country) && $address_country == 'United Arab Emirates'): ?> selected="selected"<?php endif; ?>>United Arab Emirates</option>
							<option value="United Kingdom"<?php if(!empty($address_country) && $address_country == 'United Kingdom'): ?> selected="selected"<?php endif; ?>>United Kingdom</option>
							<option value="United States"<?php if(!empty($address_country) && $address_country == 'United States'): ?> selected="selected"<?php endif; ?>>United States</option>
							<option value="Uruguay"<?php if(!empty($address_country) && $address_country == 'Uruguay'): ?> selected="selected"<?php endif; ?>>Uruguay</option>
							<option value="Uzbekistan"<?php if(!empty($address_country) && $address_country == 'Uzbekistan'): ?> selected="selected"<?php endif; ?>>Uzbekistan</option>
							<option value="Vanuatu"<?php if(!empty($address_country) && $address_country == 'Vanuatu'): ?> selected="selected"<?php endif; ?>>Vanuatu</option>
							<option value="Vatican City"<?php if(!empty($address_country) && $address_country == 'Vatican City'): ?> selected="selected"<?php endif; ?>>Vatican City</option>
							<option value="Venezuela"<?php if(!empty($address_country) && $address_country == 'Venezuela'): ?> selected="selected"<?php endif; ?>>Venezuela</option>
							<option value="Vietnam"<?php if(!empty($address_country) && $address_country == 'Vietnam'): ?> selected="selected"<?php endif; ?>>Vietnam</option>
							<option value="Virgin Islands, British"<?php if(!empty($address_country) && $address_country == 'Virgin Islands, British'): ?> selected="selected"<?php endif; ?>>Virgin Islands, British</option>
							<option value="Virgin Islands, U.S."<?php if(!empty($address_country) && $address_country == 'Virgin Islands, U.S.'): ?> selected="selected"<?php endif; ?>>Virgin Islands, U.S.</option>
							<option value="Yemen"<?php if(!empty($address_country) && $address_country == 'Yemen'): ?> selected="selected"<?php endif; ?>>Yemen</option>
							<option value="Zambia"<?php if(!empty($address_country) && $address_country == 'Zambia'): ?> selected="selected"<?php endif; ?>>Zambia</option>
							<option value="Zimbabwe"<?php if(!empty($address_country) && $address_country == 'Zimbabwe'): ?> selected="selected"<?php endif; ?>>Zimbabwe</option>
						</select>
					</p>
					<p> 
						<label for="address_postcode">ZIP / Postal code <span class="required">*</span></label><br />
						<input type="text" id="address_postcode" name="address_postcode" value="<?php if(!empty($address_postcode)) { echo $address_postcode; } ?>" required="required" />
					</p>
				</div>
				<hr />
				<h2>Contact Details</h2>
				<div class="columns-3">
					<p> 
						<label for="telephone">Telephone <span class="required">*</span></label><br />
						<input type="tel" id="telephone" name="telephone" value="<?php if(!empty($telephone)) { echo $telephone; } ?>" required="required" />
					</p>
					<p> 
						<label for="website">Website <span class="required">*</span></label><br />
						<input type="url" id="website" name="website" value="<?php if(!empty($website)) { echo $website; } ?>" required="required" />
					</p>
				</div>
				<p><span class="smalltext">NB: If you win an award the contact details you enter above will appear on your winners page</span></p>
				<p><button type="submit" disabled="disabled">Register</button></p>
			</form>
		<?php		
				} else {
					echo '<div class="error-message">Registration is currently disabled - please try again later</div>';
				}
			}
		?>
	<?php else: ?>
		<p>Sorry, new registrations to enter the SPASA Awards are now closed.</p>
	<?php endif; ?>
</div>
