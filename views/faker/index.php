<?php
$this->title = 'Faker Demo';
$faker = Faker\Factory::create();
?>
<div class="site-index">
	<?=$faker->name?>
	<?='<br>'.$faker->email?>
	<br>
	<?=$faker->streetName?>
	<br>
	<?=$faker->address. ', '.$faker->country?>
</div>
