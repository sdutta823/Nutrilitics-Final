<?php
function addMeal($MealName, $Calories, $Serving_Size)
{
    global $db;
    $query = "INSERT INTO Meal(MealName, Calories, Serving_Size) VALUES (:MealName,:Calories,:Serving_Size)"; 
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':MealName', $MealName);
        $statement->bindValue(':Calories', $Calories);
        $statement->bindValue(':Serving_Size', $Serving_Size);
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
		   echo "Failed to add a meal <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
    $q2 = "SELECT MAX(MealID) FROM Meal"; 
    try{
        $statement = $db->prepare($q2);
        $statement->execute();
        $MealID = $statement->fetch();
        $statement->closeCursor();
        return $MealID;
    }
    catch (PDOException $e) 
    {
        // echo $e->getMessage();
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        if (str_contains($e->getMessage(), "Duplicate"))
		   echo "Failed to add a meal <br/>";
    }
}

function getMeals()
{
    global $db; 
    $query = "SELECT MealID,MealName,Calories,Serving_Size FROM Meal";
    $statement = $db->prepare($query);
     $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}


function getMealsFromUser($UserID)
{
    global $db; 
    $query = "SELECT MealName,Calories,Serving_Size FROM Users NATURAL JOIN Adds NATURAL JOIN Meal WHERE UserID=:UserID";
    $statement = $db->prepare($query);
    $statement->bindValue('UserID', $UserID);
    $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}

function getMealsEaten($UserID)
{
    global $db; 
    $query = "SELECT Eat_Name,Calories FROM Meals_Eaten NATURAL JOIN Eats NATURAL JOIN Users WHERE UserID=:UserID";
    $statement = $db->prepare($query);
    $statement->bindValue('UserID', $UserID);
    $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}

function getMealByID($MealID)  
{
    global $db;
    $query = "SELECT * FROM Meal where MealID = :MealID";

    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();  
    return $result;
}
function updateMeal($MealID, $MealName, $Calories, $Serving_Size)
{
    // get instance of PDO
    // prepare statement
    //  1) prepare 
    //  2) bindValue, execute
    global $db;
    $query = "UPDATE Meal SET MealName=:MealName, Calories=:Calories, Serving_Size=:Serving_Size WHERE MealID=:MealID";
    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->bindValue(':MealName', $MealName);
    $statement->bindValue(':Calories', $Calories);
    $statement->bindValue(':Serving_Size', $Serving_Size);
    $statement->execute();
    $statement->closeCursor();

    // $statement->query()
    
}
function deleteMeal($MealID)
{
    global $db;
    $query = "DELETE FROM Meal WHERE MealID=:MealID";
    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $statement->closeCursor();
}

function addAdds($UserID,$MealID)
{
    global $db;
    $query = "INSERT INTO Adds(UserID, MealID) VALUES (:UserID,:MealID)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':UserID', $UserID);
        $statement->bindValue(':MealID', $MealID);
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
		   echo "Failed to add a meal <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function addEaten($Eat_Name,$Calories)
{
    global $db;
    $query = "INSERT INTO Meals_Eaten(Eat_Name, Calories) VALUES (:Eat_Name,:Calories)";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Eat_Name', $Eat_Name);
        $statement->bindValue(':Calories', $Calories);
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
		   echo "Failed to add a meal <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
    $q2 = "SELECT MAX(EatID) FROM Meals_Eaten"; 
    try{
        $statement = $db->prepare($q2);
        $statement->execute();
        $EatID = $statement->fetch();
        $statement->closeCursor();
        return $EatID;
    }
    catch (PDOException $e) 
    {
        // echo $e->getMessage();
        // if there is a specific SQL-related error message
        //    echo "generic message (don't reveal SQL-specific message)";

        if (str_contains($e->getMessage(), "Duplicate"))
		   echo "Failed to add a meal <br/>";
    }
}

function getMealNameByID($MealID)  
{
    global $db;
    $query = "SELECT MealName FROM Meal where MealID = :MealID";

    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();  
    return $result[0];
}
function getMealCaloriesByID($MealID)  
{
    global $db;
    $query = "SELECT Calories FROM Meal where MealID = :MealID";

    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();  
    return $result[0];
}
function addEats($UserID,$EatID)
{
    global $db;
    $query = "INSERT INTO Eats(UserID, EatID) VALUES (:UserID,:EatID)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':UserID', $UserID);
        $statement->bindValue(':EatID', $EatID);
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
		   echo "Failed to add a meal <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

?>