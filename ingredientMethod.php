<?php
function addIngredient($Ingredient_Name)
{
    global $db;
    $query = "INSERT INTO Ingredient(Ingredient_Name) VALUES (:Ingredient_Name)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Ingredient_Name', $Ingredient_Name);
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
		   echo "Failed to add a friend <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function getIngredient()
{
    global $db; 
    $query = "SELECT IngredientID,Ingredient_Name FROM Ingredient";
    $statement = $db->prepare($query);
     $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}
function getIngredientByID($IngredientID)  
{
    global $db;
    $query = "SELECT * FROM Ingredient where IngredientID = :IngredientID";

    $statement = $db->prepare($query);
    $statement->bindValue(':IngredientID', $IngredientID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();    
    return $result;
}
function updateIngredient($IngredientID, $Ingredient_Name)
{
    // get instance of PDO
    // prepare statement
    //  1) prepare 
    //  2) bindValue, execute
    global $db;
    $query = "UPDATE Ingredient SET Ingredient_Name=:Ingredient_Name WHERE IngredientID=:IngredientID";
    $statement = $db->prepare($query);
    $statement->bindValue(':IngredientID', $IngredientID);
    $statement->bindValue(':Ingredient_Name', $Ingredient_Name);
    $statement->execute();
    $statement->closeCursor();

    // $statement->query()
    
}
function deleteIngredient($IngredientID)
{
    global $db;
    $query = "DELETE FROM Ingredient WHERE IngredientID=:IngredientID";
    $statement = $db->prepare($query);
    $statement->bindValue(':IngredientID', $IngredientID);
    $statement->execute();
    $statement->closeCursor();
}
?>