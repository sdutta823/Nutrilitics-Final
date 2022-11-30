<head>
    <title>Nutrilitics</title>
    <link rel="stylesheet" href="admin.css">
</head>

<input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
  	<label for="dark-light"></label>

  	<div class="light-back"></div> 


  	<div class="sec-center"> 	
	  	<input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
	  	<label class="for-dropdown" for="dropdown">Nutrilitics Menu <i class="uil uil-arrow-down"></i></label>

      <div class="section-dropdown"> 
  			<a href="index.php">Home</a>
			<a href="mealForm.php">Meals</a>
  			<a href="recipeForm.php">Recipes</a>
  			<a href="ingredients.php">Ingredients</a>
			<a href="logout.php">Logout</a>

  		</div>

  		</div>
  	</div>
    <?php
require("connect-db.php");   
require("recipeMethod.php");
// include("connect-db.php");
session_start();
if( empty($_SESSION['recipeID']) ) {
     $_SESSION['recipeID'] = null;
}
$list_of_recipes = getRecipes();
$recipe_print = null;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['btnAction'] =='Add') 
  {
      addRecipe($_POST['Recipe_Directions']);
      $list_of_recipes = getRecipes();
  }
  else if ($_POST['btnAction'] == 'Update')
  {
     $_SESSION['recipeID'] = $_POST['recipe_to_update'];
     getRecipeByID($_POST['recipe_to_update']);
  }
  else if ($_POST['btnAction'] == 'Confirm update')
  {
     updateRecipe($_SESSION['recipeID'],$_POST['Recipe_Directions']);
     $_SESSION['recipeID'] = null;
     $list_of_recipes = getRecipes();
  }
  else if ($_POST['btnAction'] == 'Delete')
  {
     deleteRecipe($_POST['recipe_to_delete']);
     $list_of_recipes = getRecipes();
  }
  else if ($_POST['btnAction'] == 'Search')
  {
     $recipe_print = getRecipeByID($_POST['RecipeID']);
   
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<div class=container-4>
  <h2>Add or Update a Recipe</h2> 
</head>
  

<form name="mainForm" action="recipeForm.php" method="post">
  <div class="row mb-3 mx-3">
    Recipe Direction:
    <input type="text" class="form-control" name="Recipe_Directions" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Add" name="btnAction" class="button-orange2" 
           title="Insert a Recipe" />
    <input type="submit" value="Confirm update" name="btnAction" class="button-orange2" 
           title="Update a Recipe" />  
  </div>  

</form>
<form name="mainForm" action="recipeForm.php" method="post">
  <div class="row mb-3 mx-3">
    RecipeID:
    <input type="text" class="form-control" name="RecipeID" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Search" name="btnAction" class="button-orange2" 
           title="Search" /> 
  </div>  

</form>
<?php echo $recipe_print['RecipeID'];
echo ": ";?>

<?php echo $recipe_print['Recipe_Directions'];?>
<h2>List of recipes</h2>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">

<thead>

  <tr>
    <th>
  <div class="stuff">
    Recipe
  </div>
</th>

<th>
  <div class="stuff">
    Recipe Direction
  </div>
</th>

<th>
<div class="stuff">
Update?
</div>
</th>

<th>
<div class="stuff">
Delete?
</div>
</th>
    

  </thead>
  <?php foreach ($list_of_recipes as $recipe_info): ?>
  <tr>
     <td><?php echo $recipe_info['RecipeID']; ?></td>
     <td><?php echo $recipe_info['Recipe_Directions']; ?></td>
     <td>
             <form action="recipeForm.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="button-orange" 
                title="Click to update this recipe" />
          <input type="hidden" name="recipe_to_update" 
                value="<?php echo $recipe_info['RecipeID']; ?>"
          />                
        </form>
	     </td>
	          <td>
             <form action="recipeForm.php" method="post">
          <input type="submit" value="Delete" name="btnAction" class="button-orange" 
                title="Click to delete this recipe" />
          <input type="hidden" name="recipe_to_delete" 
                value="<?php echo $recipe_info['RecipeID']; ?>"
          />                
        </form>
	     </td>
  </tr>
<?php endforeach; ?>
</table>
</div>   
            </div>