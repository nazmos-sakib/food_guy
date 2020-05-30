<?php 

if(!isset($_GET['restaurant_id']) or !isset($_GET['restaurant_name']))
{
	header("location:index.php");
}
else
{
	require_once('includes/dataBase.php');

	$db = new database();

}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_GET['restaurant_name']; ?></title>
	<link rel="stylesheet" type="text/css" href="bd-default.css">
</head>
<body>

	<div>
		<img src="<?php echo "./Image/restaurant_cover/".$db->extract_cover_image($_GET["restaurant_id"]);  ?>" style="height: 300px; width: 100%">
	</div>

	<div class="ratings-component">
		<span class="stars">
			<img alt="" src="" />
		</span>

	</div>

	<picture>
		<div class="vendor-picture b-lazy" data-src="Image/kfc/KFC_banner.jpg">
			
		</div>
	</picture>

	<?php echo $_GET['restaurant_name']; ?>
	<figure class="vendor-tile  item">
	<div class="tag-container">
        <span class="multi-tag">25% OFF</span>
    </div>
</figure>

<div> rating</div>
<br>




<div class="restaurants-container js-restaurants-container"
	data-vendors-count="60">

	<div class="restaurants__list">


		<section class="vendor-list-section  ">

			<span class="title-flat">
				All Food Items
			</span>

			<ul class="vendor-list "
			data-title-pickup=""
			data-title-delivery="Popular restaurants"
			data-title-background="In your city"
			data-show-mov="false"
			data-show-df="true"
			data-show-pick-up-distance="false">

			<?php 

			$row["restaurant_id"] = 2;

			 //echo "./Image/restaurant_cover/".$db->extract_cover_image($row["restaurant_id"]); 

			$result = $db->fetch_food_item($_GET['restaurant_id']);

			while($row = $result->fetch_assoc()) 
			{
				?>
				<li>

					<a href="restaurants_single.php?<?php echo "food_id=".$row["food_id"]."&food_name=".$row["food_name"]; ?>"
						data-flood-closed-message=""
						class="hreview-aggregate url"
						data-vendor-id='11229'>        
						<figure class="vendor-tile  item">         
							<picture>
								<div class="vendor-picture b-lazy" data-src="">

								</div>
							</picture>
							<figcaption class="vendor-info">
								<span class="headline">
									<span class="name fn"><?php echo $row["food_name"]; ?></span>
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
										<span class="budget-symbol--filled">BDT</span>
										<span><?php echo $row["price"]; ?></span>
									</li>
									<li class="vendor-characteristic">
										<span><?php echo $row["description"]; ?></span>
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



	<div style="height: 100px; ">
		offer
	</div>

	<div style="height: 100px; ">
		catagory list
	</div>

	<div style="height: 100px; ">
		chicken
	</div>

	<div style="height: 100px; ">
		Hot & Crispy Chicken Bucket
	</div>

	  
	 <div style="height: 100px; ">
		Burgers
	</div>

	<div style="height: 100px; ">
		A La Carte
	</div>

	<div style="height: 100px; ">
		Hot & Crispy Chicken Bucket
	</div>



</body>
</html>