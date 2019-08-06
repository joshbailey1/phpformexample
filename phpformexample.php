<!DOCTYPE HTML>
<html>
<head>
<link rel = "stylesheet" type="text/css" href="phpformstyle.css">
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_data($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_data($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_data($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_data($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_data($_POST["gender"]);
  }
}

function test_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>

<?php
//posts the form data to this same file
//htmlspecialchars to avoid SQL injection
?>
<div>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label> Name: </label> <input type="text" name="name" value="<?php
      if (isset($name)){echo $name;}?>">
  		<span class="error">* <?php
      if (isset($nameErr)){echo $nameErr;}?></span>
 	 <br><br>
  	<label> E-mail: </label> <input type="text" name="email" value="<?php
      if (isset($email)){echo $email;}?>">
  		<span class="error">* <?php
      if (isset($emailErr)){echo $emailErr;}?></span>
 	 <br><br>
	  <label> Website: </label> <input type="text" name="website" value="<?php
    if (isset($website)){echo $website;}?>">
  		<span class="error"><?php
      if (isset($websiteErr)){echo $websiteErr;}?></span>
 	 <br><br>
 	 <label> Comment: </label> <textarea name="comment" rows="5" cols="40"><?php
   if (isset($comment)){echo $comment;}?></textarea>
 	 <br><br>
 	 <label> Gender: </label>
	 <label class="container">Female
		<input type="radio" checked="checked" name="gender"
			<?php if (isset($gender) && $gender=="female") echo "checked";?>
		value="female">
		<span class="checkmark"></span>
	 </label>
 	 <label class="container">Male
 	 	<input type="radio" checked="checked" name="gender"
			<?php if (isset($gender) && $gender=="male") echo "checked";?>
		value="male">
		<span class="radio"></span>
	 </label>
	 <label class="container">Other
 	 	<input type="radio" checked="checked" name="gender"
			<?php if (isset($gender) && $gender=="other") echo "checked";?>
		value="other">
		<span class="checkmark"></span>
	 </label>
 		<span class="error">* <?php
    if (isset($genderErr)){echo $genderErr;}?></span>
	  <br><br>
  	<input type="submit" name="submit" value="Submit">
	</form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //displays user input
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comment;
    echo "<br>";
    echo $gender;
}
?>

</body>
</html>
