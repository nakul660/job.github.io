<!DOCTYPE html>
<html>
<head>
  <title>Online Application Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color:yellow;
    }
    
    h1 {
      text-align: center;
    }
    
    .form-container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 0 5px #ccc;
      background-color:aqua;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
      margin-top:10px;
    }
    
    input[type="text"],
    input[type="date"],
    select {
      width: 100%;
      padding: 8px;
      border: 3px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top:10px;
    }
    
    select {
      height: 40px;


    }
    
    .error {
      color: red;
    }
    
    button {
      padding: 10px 20px;
      background-color: #000000;;
      color: white;
      border: none;
      cursor: pointer;

    }
    
    #output {
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 10px;
    }
    .submit {
      border-radius:20px;
      margin-top:10px;
    }
  </style>
</head>
<body>
  <h1>JOB APPLICATION FORM</h1>

  <?php
  // Define variables and set to empty values
  $nameErr = $emailErr = $dobErr = $experienceErr = $positionErr = "";
  $name = $email = $dob = $experience = $position = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // Check if name contains only letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    // Validate email
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // Check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    // Validate date of birth
    if (empty($_POST["dob"])) {
      $dobErr = "Date of Birth is required";
    } else {
      $dob = test_input($_POST["dob"]);
    }

    // Validate job experience
    if (empty($_POST["experience"])) {
      $experienceErr = "Job Experience is required";
    } else {
      $experience = test_input($_POST["experience"]);
    }

    // Validate position selection
    if (empty($_POST["position"])) {
      $positionErr = "Position is required";
    } else {
      $position = test_input($_POST["position"]);
    }
  }

  // Helper function to sanitize and validate input data
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <div class="form-container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo $name; ?>">
      <span class="error"><?php echo $nameErr; ?></span>

      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>">
      <span class="error"><?php echo $dobErr; ?></span>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="<?php echo $email; ?>">
      <span class="error"><?php echo $emailErr; ?></span>

      

      <label for="experience">Job Experience:</label>
      <input type="text" id="experience" name="experience" value="<?php echo $experience; ?>">
      <span class="error"><?php echo $experienceErr; ?></span>

      <label for="position">Position:</label>
      <select id="position" name="position">
        <option value="">Select Position</option>
        <option value="Data Entry" <?php if($position === "data entry clerk") echo "selected"; ?>>Data Entry Clerk</option>
        <option value="developer" <?php if ($position === "developer") echo "selected"; ?>>Developer</option>
        <option value="Sales" <?php if ($position === "Sales") echo "selected"; ?>>Sales</option>
        <option value="designer" <?php if ($position === "designer") echo "selected"; ?>>Designer</option>
        <option value="manager" <?php if ($position === "manager") echo "selected"; ?>>Manager</option>
      </select>
      <span class="error"><?php echo $positionErr; ?></span>

      <button class="submit" type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($emailErr) && empty($dobErr) && empty($experienceErr) && empty($positionErr)) {
      // Display the submitted information with formatting
      echo '<div id="output">';
      echo '<h2>Submitted Information:</h2>';
      echo '<p><strong>Name:</strong> ' . $name . '</p>';
      echo '<p><strong>Email:</strong> ' . $email . '</p>';
      echo '<p><strong>Date of Birth:</strong> ' . $dob . '</p>';
      echo '<p><strong>Job Experience:</strong> ' . $experience . '</p>';
      echo '<p><strong>Position:</strong> ' . $position . '</p>';
      echo '</div>';
    }
    ?>
  </div>

</body>
</html>
