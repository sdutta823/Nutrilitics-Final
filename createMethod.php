<?php
function addUser($Username, $Passwrd, $Calories_Goal)
{
    global $db;
    $query = "INSERT INTO Users(Username, Passwrd, Calories_Goal) VALUES (:Username,:Passwrd,:Calories_Goal)";  
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Username', $Username);
        // $statement->bindValue(':UserID', $UserID);
        $statement->bindValue(':Passwrd', $Passwrd);
        $statement->bindValue(':Calories_Goal', $Calories_Goal);
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
		   echo "Failed to add a User <br/>";
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function getUsers()
{
    global $db; 
    $query = "SELECT Username,UserID,Passwrd,Calories_Goal FROM Users";
    $statement = $db->prepare($query);
     $statement->execute();
    $result = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $result;
}

function getUserLogin($Username)
{
    global $db; 
    $query = "SELECT COUNT(Username) FROM Users WHERE Username=:Username";
    $statement = $db->prepare($query);
    $statement->bindValue(':Username', $Username);
    $statement->execute();
    $result = $statement->fetch();   // fetch()
    $statement->closeCursor();
    //echo $result;
    return $result;
}

function getCreateAccount($Username)
{
    global $db; 
    $query = "SELECT COUNT(Username) FROM Users WHERE Username=:Username";
    //echo $query;
    $statement = $db->prepare($query);
    $statement->bindValue(':Username', $Username);
    $statement->execute();
    $result = $statement->fetch();   // fetch()
    $statement->closeCursor();
    echo $result;
    return $result;
}

function getHashPass($Username, $Passwrd)
{
    global $db; 
    $query = "SELECT Passwrd FROM Users WHERE Username=:Username";
    //echo $query;
    $statement = $db->prepare($query);
    $statement->bindValue(':Username', $Username);
    $statement->execute();
    $result = $statement->fetch();   // fetch()
    $statement->closeCursor();
    //echo $result;
    return password_verify($Passwrd, $result[0]);
}

function getUserID($Username)
{
    global $db; 
    $query = "SELECT UserID FROM Users WHERE Username=:Username";
    //echo $query;
    $statement = $db->prepare($query);
    $statement->bindValue(':Username', $Username);
    $statement->execute();
    $result = $statement->fetch();   // fetch()
    $statement->closeCursor();
    //echo $result;
    return $result[0];
}

/*function getUserByID($UserID)  
{
    global $db;
    $query = "SELECT * FROM Users where UserID = :UserID";
    $statement = $db->prepare($query);
    $statement->bindValue(':UserID', $UserID);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();    
    return $result;
}*/
function updateUser($Username, $UserID, $Passwrd, $Calories_Goal)
{
    // get instance of PDO
    // prepare statement
    //  1) prepare 
    //  2) bindValue, execute
    global $db;
    $query = "UPDATE Users SET Username=:Username, UserID=:UserID, Passwrd=:Passwrd, Calories_Goal=:Calories_Goal,  WHERE UserID=:UserID";
    $statement = $db->prepare($query);
    $statement->bindValue(':Username', $Username);
    $statement->bindValue(':UserID', $UserID);
    $statement->bindValue(':Passwrd', $Passwrd);
    $statement->bindValue(':Calories_Goal', $Calories_Goal);
    $statement->execute();
    $statement->closeCursor();

    // $statement->query()
    
}
/*function deleteMeal($MealID)
{
    global $db;
    $query = "DELETE FROM Meal WHERE MealID=:MealID";
    $statement = $db->prepare($query);
    $statement->bindValue(':MealID', $MealID);
    $statement->execute();
    $statement->closeCursor();
}*/
?>