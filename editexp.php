<!-- hadiel aljadid /// this is the edit expense page -->
<?php
require_once 'conf.php';
$username = $_GET['username'];
$conn = mysqli_connect($host, $user, $pass, $db_name);
$id = $_GET['id'];// get id through query string
$query = "SELECT `cat_id`, `amount`, `comment`, `date`, `payment` FROM $expense_table WHERE id = '$id'"; // select query
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
if (isset($_POST['EDIT'])) { // when click on Update button
    $date = $_POST['date'];
    $comment = $_POST['comment'];
    $payment = $_POST['payment'];
    $amount = $_POST['amount'];
    $query = "UPDATE $expense_table SET date='$date', comment='$comment', payment='$payment', amount='$amount' WHERE id='$id'";
    $edit = mysqli_query($conn, $query);
    if ($edit) {
        mysqli_close($conn); // Close connection
        header("location: display.php"); // redirects to all records page
        exit;
    } else {
        echo "<p>Unable to execute the query.</p>";
        echo $query;
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
    <nav>
    <div class="menu">
        <div class="logo">
            <a href="expense.html">EXPENSE TRACKER</a>
        </div>
        <ul>
            <?php
            echo '<span style="color: white;">' . $username . '</span>';
            ?>
            <li><a target="_blank" href="expensehome.php">Homepage</a></li>
            <li><a target="_blank" href="login.php">Login</a></li>
            <li><a target="_blank" href="signup.php">Signup</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="addcategory.php">Add category</a></li>
            <li><a href="#">Reports</a></li> 
            <li><a target="_self" href="login.php">Logout</a></li>
            <li><a href="edituser.php?username=<?php echo $username; ?>">Edit info</a></td>
        </ul>
    </div>
</nav>
    <style>
    nav {
    margin-top: -0.5%;
    display : block;
    background : #1b1b1b;
    width : 90%;
    padding : 0px 80px;
  }
  nav .menu{
    max-width : 1290px;
    margin : auto;
    display : flex;
    align-items: center;
    justify-content: space-between;
    padding : 0 30px;
  }
  .menu .logo a{
    font-family: 'poppins', sans-serif;
    text-decoration: none;
    color: #fff;
    font-size: 35px;
    font-weight: 700;
    cursor: pointer;
  }
  .menu ul{
    font-family: 'poppins', sans-serif;
    display : inline-flex;
  }
  .menu ul li {
    list-style: none;
    margin-left : 7px;
  }
  .menu ul li a{
    font-family: 'poppins', sans-serif;
    text-decoration : none;
    color : #fff;
    font-size: 15px;
    font-weight: 500;
   
    padding : 8px 15px;
    border-radius:  5px;
    transition: all 0.3s ease;
  }
  .menu ul li a:hover{
    background : #fff;
    color : #000;
  
  }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #b2bec3 0%, #636e72 100%);
        }
        <style>
        /* Add styles for the navigation menu */
        nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: black;
  padding: 5px;
}

.menu {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1290px;
  margin: 0 auto;
}

.menu .logo a {
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  color: #fff;
  font-size: 35px;
  font-weight: 700;
  cursor: pointer;
}

.menu ul {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
}

.menu ul li {
  margin-left: 7px;
}

.menu ul li a {
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  color: #fff;
  font-size: 15px;
  font-weight: 500;
  padding: 8px 15px;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.menu ul li a:hover {
  background: #fff;
  color: #000;
}
        h3 {
            color: #333;
            text-align: center;
            margin-top: 30px;
        }
        form {
            margin: 30px auto;
            max-width: 500px;
            background-color: #FFF;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        input[type="date"],
        input[type="number"],
        input[type="text"],
        select {
            padding: 10px;
            border: 1px solid #CCC;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 20px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color:  #b2bec3 ; 
            color: #FFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #b2bec3;; 
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h3>Edit Expense</h3>
    <form method="POST" >
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $data['date'] ?>" required><br><br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo $data['amount'] ?>" min="0" step="0.01" required><br><br>
        <label for="comment">Comment:</label>
        <input type="text" name="comment" value="<?php echo $data['comment'] ?>" required><br><br>
        <label for="payment">Payment Method:</label>
        <select name="payment" required>
            <option value="">Select Payment Method</option>
            <option value="Cash" <?php if ($data['payment'] == 'Cash') echo 'selected' ?>>Cash</option>
            <option value="Credit Card" <?php if ($data['payment'] == 'Credit Card') echo 'selected' ?>>Credit Card</option>
            <option value="Debit Card" <?php if ($data['payment'] == 'Debit Card') echo 'selected' ?>>Debit Card</option>
            <option value="PayPal" <?php if ($data['payment'] == 'check') echo 'selected' ?>>check</option>
        </select><br><br>
        <input type="submit" name="EDIT" value="Save">
    </form>
</body>
</html>