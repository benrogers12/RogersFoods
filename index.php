<html>
<head>
<meta charset=UTF-8>
<title>Rogers/Kaiser Family Recipes</title>
</head>
<body>
<form method='POST' action="/index.php">		<!-- Sets the post return action-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE = "Text" VALUE ="" NAME = "search">

<input type="submit" name="submit" value="Search!" />		<!--Creates the Search button-->
<br><strong>Search by entering the name, type, or indegredients in the search box</strong>
<br><br>
</form>

<?php
$link = mysqli_connect(localhost, "admin29Krb6S", "vCeKcj5hjSAt","recipes");
if(mysqli_connect_errno()) {
        echo "<p>Failed to connect to DB. Contact Ben Rogers.</p>";             //Echo's if the connection fails
        exit();
         }



 if(isset($_POST['submit'])){           //Checks for the button to be pressed

        $data=$_POST['search'];
		$query = "SELECT * FROM food WHERE rName LIKE '%$data%' OR ingredients LIKE '%$data%' OR category LIKE '%$data%' OR category2 LIKE '%$data%';";
        $result = mysqli_query($link,$query) or die('Query failed: ');  //Checks for errors with the query 
        $rows = mysqli_num_rows($result);                       //Counts the rows in the query
        if($rows==0){
                echo "There were no recipes found.<br><br>";
        }
        elseif($rows==1){
                echo "There was 1 recipe found.<br><br>";
        }
        else{
                echo "There were $rows recipes found <br><br>";
        }
		 while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                printf("<h4>%s</h4><br>%s - %s<br><br><b>Ingredients</b><br><br>%s<br><br><b>Instructions</b><br><br>%s<br><br><br>", $row['rName'], $row['category'], $row['category2'], $row['ingredients'], $row['instructions']);
        }
        mysql_free_result($result);             //Free's the query
 }
?>

<form method='POST' action="/index.php">        <!-- Sets the post return action-->
<br><b>Enter a new recipe below.</b><br>
Recipe Name: <INPUT TYPE = "Text" VALUE ="" NAME = "rName"><br>
Category 1:  
<select name="cat1">                            
    <option value="Appetizer" >Appetizer</option>
    <option value="Bread" >Bread</option>
    <option value="Breakfast" >Breakfast</option>
    <option value="Dessert" >Dessert</option>
    <option value="Drink" >Drink</option>
    <option value="Main Course" >Main Course</option>
    <option value="Pasta" >Pasta</option>
    <option value="Sauce" >Sauce</option>
    <option value="Side Dish" >Side Dish</option>
    <option value="Soups" >Soups</option>
</select>
<br>Category 2:  
<select name="cat2">                            
    <option value="Beef" >Beef</option>
    <option value="Breads" >Breakfast</option>
    <option value="Casserole" >Casserole</option>
    <option value="Chicken" >Chicken</option>
    <option value="Fish" >Fish</option>
    <option value="Pork" >Pork</option>
    <option value="Salad" >Salad</option>
    <option value="Other" >Other</option>
</select>
<br>
Ingredients: <textarea rows="15" cols="80" id="ingredients" NAME = "ingredients" VALUE = "">
</textarea><br>
Instructions: <textarea rows="20" cols="80" id ="instructions" VALUE ="" NAME = "instructions"></textarea><br><br>
<input type="submit" name="add" value="Add New!" />     <!--Creates the Search button-->
</form>

<br />
<?php
 if(isset($_POST['add'])){           //Checks for the button to be pressed
                $name=$_POST['rName'];
                $cat1=$_POST['cat1'];
                $cat2=$_POST['cat2'];
                $ingredients  = $_POST['ingredients'];
                $ingredients  = nl2br($ingredients);
                $instructions = $_POST['instructions'];
                $instructions = nl2br($instructions);
                $rowQuery = mysqli_query($link,"SELECT id FROM food;");
                $id = mysqli_num_rows($rowQuery);
                $query = "INSERT INTO food VALUES ('$id','$name','$cat1','$cat2','$ingredients','$instructions');";
        $result = mysqli_query($link,$query) or die('Query failed: ');  //Checks for errors with the query 
        mysql_free_result($rowQuery);
        mysql_free_result($result);             //Free's the query
 }
mysql_close();		//Closes the connection to the databse
?>
</body>
</html>

