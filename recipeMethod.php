<?php
function addRecipe($Recipe_Directions)
{
    global $db;
    $query = "INSERT INTO Recipe(Recipe_Directions) VALUES (:Recipe_Directions)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Recipe_Directions', $Recipe_Directions);
        $statement->execute();
        $statement->closeCursor();

        // if ($statement->rowCount() == 0)
        //     echo "Failed to add a friend <br/>";
    }
    catch (PDOException $e) 
    {
        // echo $e->getMessage();
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        if (str_contains($e->getMessage(), "Duplicate"))
		   echo "Failed to add a recipe <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function getRecipes()
{
    global $db; 
    $query = "SELECT RecipeID,Recipe_Directions FROM Recipe";
    $statement = $db->prepare($query);
     $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}
function getRecipeByID($RecipeID)  
{
    global $db;
    $query = "SELECT * FROM Recipe where RecipeID = :RecipeID";

    $statement = $db->prepare($query);
    $statement->bindValue(':RecipeID', $RecipeID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();    
    return $result;
}
function updateRecipe($RecipeID, $Recipe_Directions)
{
    // get instance of PDO
    // prepare statement
    //  1) prepare 
    //  2) bindValue, execute
    global $db;
    $query = "UPDATE Recipe SET Recipe_Directions=:Recipe_Directions WHERE RecipeID=:RecipeID";
    $statement = $db->prepare($query);
    $statement->bindValue(':RecipeID', $RecipeID);
    $statement->bindValue(':Recipe_Directions', $Recipe_Directions);
    $statement->execute();
    $statement->closeCursor();

    // $statement->query()
    
}
function deleteRecipe($RecipeID)
{
    global $db;
    $query = "DELETE FROM Recipe WHERE RecipeID=:RecipeID";
    $statement = $db->prepare($query);
    $statement->bindValue(':RecipeID', $RecipeID);
    $statement->execute();
    $statement->closeCursor();
}
?>