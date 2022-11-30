
<?php session_start(); // make sessions available ?>

<head>
    <title>Nutrilitics</title>
    <link rel="stylesheet" href="admin.css">
</head>

<input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
  	<label for="dark-light"></label>

  	<div class="light-back"></div> 


  	<div class="sec-center"> 	
	  	<input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
	  	<label class="for-dropdown" for="dropdown">Nutrilitics Menu</label>

      <div class="section-dropdown"> 
  			<a href="index.php">Home</a>
			<a href="mealForm.php">Meals</a>
  			<a href="recipeForm.php">Recipes</a>
  			<a href="ingredients.php">Ingredients</a>
			<a href="logout.php">Logout</a>

  		</div>
  	</div>
	 
</html>


<?php
require("connect-db.php");   
require("recipeMethod.php");
require("mealMethod.php");
// include("connect-db.php");
//session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <div class=container-3>
  <h2>Welcome to Nutrilitics!</h2>
  <h3>Please Navigate Our Site Through the Menu</h3>
</div> 
</head>
<div class="container-3">
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
 
  <div class=container-3>
<tr>
    <th>
  <div class="stuff">
  Meals Added
  </div>
</th>
<th>
  <div class="stuff">
  Calories
  </div>
</th>
<th>
  <div class="stuff">
  Serving Size
  </div>
</th>
</tr>
<br>
<br>
<?php
$list_of_yourMeals = getMealsFromUser($_SESSION['UserID']);
 foreach ($list_of_yourMeals as $yourMeals): ?>
  <tr>
     <td><?php echo $yourMeals['MealName']; ?></td>
     <td><?php echo $yourMeals['Calories']; ?></td>
     <td><?php echo $yourMeals['Serving_Size']; ?></td>

</tr>
     <?php endforeach; ?>
</div>

<div class="container-3">

<tr>
<th>
  <div class="stuff">
  Meals Eaten
  </div>
</th>
<th>
  <div class="stuff">
  Calories
  </div>
</th>
 </tr>

<?php
$list_of_MealsEaten = getMealsEaten($_SESSION['UserID']);
 foreach ($list_of_MealsEaten as $MealsEaten): ?>
  <tr>
     <td><?php echo $MealsEaten['Eat_Name']; ?></td>
     <td><?php echo $MealsEaten['Calories']; ?></td>


</tr>
     <?php endforeach; ?>
</div>
</div>