<!DOCTYPE html>
<html>
<head>
	<title>home</title>

	<link rel="stylesheet" type="text/css" href="bd-default.css">
	<!--link rel="stylesheet" href="https://assets.foodora.com/a4a2d27/css/dist/bd-default.css?a4a2d27" /-->
</head>
<body>


	
	<div>

		<button type="button" autofocus onclick="asd()">restaurants!</button>

		<button type="button">stores!</button>
	</div>
	<br>
	
	<form>
		<input type="text" name="search_key" placeholder="e.g. burger, chinese..">
	</form>

	<br>
	<br>

	<div style="height: 100px; ">
		Order again from
	</div>

	<div style="height: 100px; ">
		Best rated
	</div>

	<div style="height: 100px; ">
		Recommended for you
	</div>

	<div  style="height: 100px; ">
		Discount Foods
	</div>

	<div  style="height: 100px; ">
		New of food guy
	</div>

	<div  style="height: 100px; ">
		
	</div>


	<br>
	

	<div class="restaurants-container js-restaurants-container"
	data-vendors-count="60">

	<div class="restaurants__list">


		<section class="vendor-list-section  ">

			<span class="title-flat">
				All restaurants
			</span>

			<ul class="vendor-list "
			data-title-pickup=""
			data-title-delivery="Popular restaurants"
			data-title-background="In your city"
			data-show-mov="false"
			data-show-df="true"
			data-show-pick-up-distance="false">

			<?php 

			require_once('includes/dataBase.php');

			$db = new database();
			$row["restaurant_id"] = 2;

			 //echo "./Image/restaurant_cover/".$db->extract_cover_image($row["restaurant_id"]); 

			$result = $db->fetch_restaurant_list();

			while($row = $result->fetch_assoc()) 
			{
				?>
				<li>

					<a href="restaurants_single.php?<?php echo "restaurant_id=".$row["restaurant_id"]."&restaurant_name=".$row["restaurant_name"]; ?>"
						data-flood-closed-message=""
						class="hreview-aggregate url"
						data-vendor-id='11229'>        
						<figure class="vendor-tile  item">         
							<picture>
								<div class="vendor-picture b-lazy" data-src="./Image/kfc/KFC_banner.jpg">

								</div>
							</picture>
							<figcaption class="vendor-info">
								<span class="headline">
									<span class="name fn"><?php echo $row["restaurant_name"]; ?></span>
									<div class="ratings-component">
										<span class="stars">
											<img alt="" src="" />
										</span>
										<span class="rating"><strong><?php echo "3"; ?></strong>/<?php echo "5"; ?></span>
										<span class="count" data-count="(16)">
											16
										</span>
									</div>
								</span>
								<ul class="categories summary">
									<li>
										<span class="budget-symbol--filled">$</span>
										<span>$</span>
										<span>$</span>
									</li>
									<li class="vendor-characteristic">
										<span>Chicken</span>
										<span>Pasta</span>
										<span>Iftar</span>
										<span>Burgers</span>
										<span>Juice Corner</span>
										<span>Fast Food</span>
									</li>
								</ul>
								<ul class="extra-info mov-df-extra-info">
									<li class="delivery-fee">
										<strong>Free</strong> delivery
									</li>
								</ul>


							</figcaption>


							<div class="tag-container">
								<span class="multi-tag">25% OFF</span>
							</div>
						</figure>
					</a>
				</li>

			<?php } ?>

		</ul>
	</section>
</div>


</div>






<div class="restaurants-container js-restaurants-container"
data-vendors-count="260">

<div class="restaurants__list">


	<section class="vendor-list-section  ">

		<span class="title-flat">
			Popular restaurants
		</span>

		<ul class="vendor-list "
		data-title-pickup=""
		data-title-delivery="Popular restaurants"
		data-title-background="In your city"
		data-show-mov="false"
		data-show-df="true"
		data-show-pick-up-distance="false">

		<?php for ($i=0; $i < 5; $i++)
		{
			?>
			<li>

				<a href="/restaurant/t2ip/cafe-black-heaven"
				data-flood-closed-message=""
				class="hreview-aggregate url"
				data-vendor-id='11229'>         <figure class="vendor-tile  item">         <picture>
					<div class="vendor-picture b-lazy" data-src="https://images.deliveryhero.io/image/fd-bd/LH/t2ip-listing.jpg?width=400&amp;height=292|https://images.deliveryhero.io/image/fd-bd/LH/t2ip-listing.jpg?width=800&amp;height=584"></div>
				</picture>
				<figcaption class="vendor-info">
					<span class="headline">
						<span class="name fn">Cafe Black Heaven</span>
						<div class="ratings-component">
							<span class="stars">
								<img alt="" src="https://assets.foodora.com/a4a2d27/img/icons/ic-star-sm.svg?a4a2d27" />
							</span>
							<span class="rating"><strong>3</strong>/5</span>
							<span class="count" data-count="(16)">
								16
							</span>
						</div>
					</span>
					<ul class="categories summary">
						<li>
							<span class="budget-symbol--filled">$</span>
							<span>$</span>
							<span>$</span>
						</li>
						<li class="vendor-characteristic">
							<span>Chicken</span>
							<span>Pasta</span>
							<span>Iftar</span>
							<span>Burgers</span>
							<span>Juice Corner</span>
							<span>Fast Food</span>
						</li>
					</ul>
					<ul class="extra-info mov-df-extra-info">
						<li class="delivery-fee">
							<strong>Free</strong> delivery
						</li>
					</ul>


				</figcaption>


				<div class="tag-container">
					<span class="multi-tag">25% OFF</span>
				</div>
			</figure>
		</a>
	</li>

<?php } ?>

</ul>
</section>
</div>


</div>







<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>












<div class="restaurants-container js-restaurants-container"
data-vendors-count="260">

<div class="restaurants__list">


	<section class="vendor-list-section  ">

		<span class="title-flat">
			Popular restaurants
		</span>

		<ul class="vendor-list "
		data-title-pickup=""
		data-title-delivery="Popular restaurants"
		data-title-background="In your city"
		data-show-mov="false"
		data-show-df="true"
		data-show-pick-up-distance="false">

		<li>










			<a href="/restaurant/t1cv/juice-punch"
			data-flood-closed-message=""
			class="hreview-aggregate url"
			data-vendor-id='10786'>         <figure class="vendor-tile  item">         <picture>
				<div class="vendor-picture b-lazy" data-src="https://images.deliveryhero.io/image/fd-bd/LH/t1cv-listing.jpg?width=400&amp;height=292|https://images.deliveryhero.io/image/fd-bd/LH/t1cv-listing.jpg?width=800&amp;height=584"></div>
			</picture>
			<figcaption class="vendor-info">
				<span class="headline">
					<span class="name fn">Juice Punch</span>
					<div class="ratings-component">
						<span class="stars">
							<img alt="" src="https://assets.foodora.com/a4a2d27/img/icons/ic-star-sm.svg?a4a2d27" />
						</span>
						<span class="rating"><strong>2</strong>/5</span>
						<span class="count" data-count="(4)">
							4
						</span>
					</div>
				</span>
				<ul class="categories summary">
					<li>
						<span class="budget-symbol--filled">$</span>
						<span>$</span>
						<span>$</span>
					</li>
					<li class="vendor-characteristic">
						<span>Coffee</span>
						<span>Dessert</span>
						<span>Juice Corner</span>
					</li>
				</ul>
				<ul class="extra-info mov-df-extra-info">
					<li class="delivery-fee">
						<strong>Free</strong> delivery
					</li>
				</ul>


			</figcaption>


		</figure>
	</a>
</li>
<li>










	<a href="/restaurant/u7rw/pizza-club-mirpur"
	data-flood-closed-message=""
	class="hreview-aggregate url"
	data-vendor-id='14508'>         <figure class="vendor-tile  item">         <picture>
		<div class="vendor-picture b-lazy" data-src="https://images.deliveryhero.io/image/fd-bd/LH/u7rw-listing.jpg?width=400&amp;height=292|https://images.deliveryhero.io/image/fd-bd/LH/u7rw-listing.jpg?width=800&amp;height=584"></div>
	</picture>
	<figcaption class="vendor-info">
		<span class="headline">
			<span class="name fn">Pizza Club - Mirpur</span>
			<div class="ratings-component">
				<span class="stars">
					<img alt="" src="https://assets.foodora.com/a4a2d27/img/icons/ic-star-sm.svg?a4a2d27" />
				</span>
				<span class="rating"><strong>3.7</strong>/5</span>
				<span class="count" data-count="(4)">
					4
				</span>
			</div>
		</span>
		<ul class="categories summary">
			<li>
				<span class="budget-symbol--filled">$</span>
				<span class="budget-symbol--filled">$</span>
				<span class="budget-symbol--filled">$</span>
			</li>
			<li class="vendor-characteristic">
				<span>Set Menu</span>
				<span>Beverage</span>
				<span>Burgers</span>
				<span>Pizza</span>
				<span>Fast Food</span>
			</li>
		</ul>
		<ul class="extra-info mov-df-extra-info">
			<li class="delivery-fee">
				<strong>Free</strong> delivery
			</li>
		</ul>


	</figcaption>


	<div class="tag-container">
		<span class="multi-tag">New</span>
	</div>
</figure>
</a>
</li>
<li>










	<a href="/restaurant/u1vs/kolkata-kacchi-ghor-mirpur-1"
	data-flood-closed-message=""
	class="hreview-aggregate url"
	data-vendor-id='14584'>         <figure class="vendor-tile  item">         <picture>
		<div class="vendor-picture b-lazy" data-src="https://images.deliveryhero.io/image/fd-bd/LH/u1vs-listing.jpg?width=400&amp;height=292|https://images.deliveryhero.io/image/fd-bd/LH/u1vs-listing.jpg?width=800&amp;height=584"></div>
	</picture>
	<figcaption class="vendor-info">
		<span class="headline">
			<span class="name fn">Kolkata Kacchi Ghor - Mirpur 1</span>
		</span>
		<ul class="categories summary">
			<li>
				<span class="budget-symbol--filled">$</span>
				<span>$</span>
				<span>$</span>
			</li>
			<li class="vendor-characteristic">
				<span>Curry</span>
				<span>Fish</span>
				<span>Rice</span>
				<span>Set Menu</span>
				<span>Iftar</span>
				<span>Beverage</span>
				<span>Dessert</span>
				<span>Bangladeshi</span>
			</li>
		</ul>
		<ul class="extra-info mov-df-extra-info">
			<li class="delivery-fee">
				<strong>Free</strong> delivery
			</li>
		</ul>


	</figcaption>


	<div class="tag-container">
		<span class="multi-tag">New</span>
	</div>
</figure>
</a>
</li>
<li>










	<a href="/restaurant/s3ei/koi-pabda-resturent"
	data-flood-closed-message=""
	class="hreview-aggregate url"
	data-vendor-id='6269'>         <figure class="vendor-tile  item">         <picture>
		<div class="vendor-picture b-lazy" data-src="https://images.deliveryhero.io/image/fd-bd/LH/s3ei-listing.jpg?width=400&amp;height=292|https://images.deliveryhero.io/image/fd-bd/LH/s3ei-listing.jpg?width=800&amp;height=584"></div>
	</picture>
	<figcaption class="vendor-info">
		<span class="headline">
			<span class="name fn">Koi Pabda Restaurant &amp; Biriyani House</span>
			<div class="ratings-component">
				<span class="stars">
					<img alt="" src="https://assets.foodora.com/a4a2d27/img/icons/ic-star-sm.svg?a4a2d27" />
				</span>
				<span class="rating"><strong>3.7</strong>/5</span>
				<span class="count" data-count="(306)">
					306
				</span>
			</div>
		</span>
		<ul class="categories summary">
			<li>
				<span class="budget-symbol--filled">$</span>
				<span>$</span>
				<span>$</span>
			</li>
			<li class="vendor-characteristic">
				<span>Beef</span>
				<span>Chicken</span>
				<span>Curry</span>
				<span>Fish</span>
				<span>Meat</span>
				<span>Set Menu</span>
				<span>Bangladeshi</span>
				<span>Breakfast</span>
				<span>Chicken</span>
				<span>Kabab &amp; Grill</span>
				<span>Bengali</span>
			</li>
		</ul>
		<ul class="extra-info mov-df-extra-info">
			<li class="delivery-fee">
				<strong>Free</strong> delivery
			</li>
		</ul>


	</figcaption>


	<div class="tag-container">
		<span class="multi-tag">25% OFF</span>
	</div>
</figure>
</a>
</li>
<li>










	<a href="/restaurant/t2ip/cafe-black-heaven"
	data-flood-closed-message=""
	class="hreview-aggregate url"
	data-vendor-id='11229'>         <figure class="vendor-tile  item">         <picture>
		<div class="vendor-picture b-lazy" data-src="https://images.deliveryhero.io/image/fd-bd/LH/t2ip-listing.jpg?width=400&amp;height=292|https://images.deliveryhero.io/image/fd-bd/LH/t2ip-listing.jpg?width=800&amp;height=584"></div>
	</picture>
	<figcaption class="vendor-info">
		<span class="headline">
			<span class="name fn">Cafe Black Heaven</span>
			<div class="ratings-component">
				<span class="stars">
					<img alt="" src="https://assets.foodora.com/a4a2d27/img/icons/ic-star-sm.svg?a4a2d27" />
				</span>
				<span class="rating"><strong>3</strong>/5</span>
				<span class="count" data-count="(16)">
					16
				</span>
			</div>
		</span>
		<ul class="categories summary">
			<li>
				<span class="budget-symbol--filled">$</span>
				<span>$</span>
				<span>$</span>
			</li>
			<li class="vendor-characteristic">
				<span>Chicken</span>
				<span>Pasta</span>
				<span>Iftar</span>
				<span>Burgers</span>
				<span>Juice Corner</span>
				<span>Fast Food</span>
			</li>
		</ul>
		<ul class="extra-info mov-df-extra-info">
			<li class="delivery-fee">
				<strong>Free</strong> delivery
			</li>
		</ul>


	</figcaption>


	<div class="tag-container">
		<span class="multi-tag">25% OFF</span>
	</div>
</figure>
</a>
</li>
</ul>
</section>
</div>


</div>



















</body>
</html>