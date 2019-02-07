<div class="content center">
	<ul class="tabs">
		<li><a href="#build-installation" class="active">Build &amp; Installation</a></li>
		<li><a href="#company-business">Company / Business</a></li>
		<li><a href="#individual-employee">Individual / Employee</a></li>
		<li><a href="#industry-product">Industry &amp; Product</a></li>
	</ul>
	<div class="tabs-info category-info active" id="build-installation">
		<?php the_field('build_installation_category_info'); ?>
	</div>
	<div class="tabs-info category-info" id="company-business">
		<?php the_field('company_business_category_info'); ?>
	</div>
	<div class="tabs-info category-info" id="individual-employee">
		<?php the_field('individual_employee_category_info'); ?>
	</div>
	<div class="tabs-info category-info" id="industry-product">
		<?php the_field('industry_product_category_info'); ?>
	</div>
</div>
