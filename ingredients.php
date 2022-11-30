<head>
    <title>Nutrilitics</title>
    <link rel="stylesheet" href="admin.css">
</head>

<input class="dark-light" type="checkbox" id="dark-light" name="dark-light"/>
  	<label for="dark-light"></label>

  	<div class="light-back"></div> 


  	<div class="sec-center"> 	
	  	<input class="dropdown" type="checkbox" id="dropdown" name="dropdown"/>
	  	<label class="for-dropdown" for="dropdown">Nutrilitics Menu </label>

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
require("ingredientMethod.php");
// include("connect-db.php");
session_start();
if( empty($_SESSION['IngredientID']) ) {
     $_SESSION['IngredientID'] = null;
}
$list_of_ingredient = getIngredient();
$ingredient_print = null;
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['btnAction'] =='Add') 
  {
      addIngredient($_POST['Ingredient_Name']);
      $list_of_ingredient = getIngredient();
  }
  else if ($_POST['btnAction'] == 'Update')
  {
     $_SESSION['IngredientID'] = $_POST['ingredient_to_update'];
     getIngredientByID($_POST['ingredient_to_update']);
  }
  else if ($_POST['btnAction'] == 'Confirm update')
  {
     updateIngredient($_SESSION['IngredientID'],$_POST['Ingredient_Name']);
     $_SESSION['rIngredientID'] = null;
     $list_of_ingredient = getIngredient();
  }
  else if ($_POST['btnAction'] == 'Delete')
  {
     deleteIngredient($_POST['ingredient_to_delete']);
     $list_of_ingredient = getIngredient();
  }
  else if ($_POST['btnAction'] == 'Search')
  {
    $ingredient_print = getIngredientByID($_POST['IngredientID']);
    echo $ingredient_print['IngredientID'];
    echo "  ";
    echo $ingredient_print['Ingredient_Name'];
    
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<div class=container-4>
  <h2>Add or Update an Ingredient</h2> 
</head>
  

<form name="mainForm" action="ingredients.php" method="post">
  <div class="row mb-3 mx-3">
    Ingredient Name:
    <input type="text" class="form-control" name="Ingredient_Name" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Add" name="btnAction" class="button-orange2" 
           title="Insert a Ingredient" />
    <input type="submit" value="Confirm update" name="btnAction" class="button-orange2" 
           title="Update a Ingredient" />  
  </div>  

</form>
<form name="mainsForm" action="ingredients.php" method="post">
  <div class="row mb-3 mx-3">
    IngredientID:
    <input type="text" class="form-control" name="IngredientID" required
    />            
  </div>  
  <div class="row mb-3 mx-3">    
    <input type="submit" value="Search" name="btnAction" class="button-orange2" 
           title="Search" /> 
  </div>  

</form>

<h3>List of Ingredients</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
<thead>

<tr>
  <th>
<div class="stuff">
  Ingredient
</div>
</th>

<th>
<div class="stuff">
  Ingredient Name
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
<?php foreach ($list_of_ingredient as $Ingredient_info): ?>
  <tr>
     <td><?php echo $Ingredient_info['IngredientID'];?></td>
     
     <td><?php echo $Ingredient_info['Ingredient_Name']; ?></td>
     <td>
             <form action="ingredients.php" method="post">
          <input type="submit" value="Update" name="btnAction" class="button-orange" 
                title="Click to update this Ingredient" />
          <input type="hidden" name="ingredient_to_update" 
                value="<?php echo $Ingredient_info['IngredientID']; ?>"
          />                
        </form>

	     </td>
	          <td>
           
             <form action="ingredients.php" method="post"><br>
            <input type="submit" value="Delete" name="btnAction" class="button-orange" 
                title="Click to delete this Ingredient" />
          <input type="hidden" name="ingredient_to_delete" 
                value="<?php echo $Ingredient_info['IngredientID']; ?>"
          />                
        </form>
	     </td>
  </tr>
<?php endforeach; ?>
</table>
</div>   
</table>
</div>   

<!DOCTYPE html>
<html>
<head>
  
