<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
        .error {
            color: #ff0000;
        }
    </style>
</head>

<body>

    <?php
    // define variables and set empty values
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $name = $email = $gender = $comment = $website = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate Name
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }

        // Validate Email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate Gender
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        // Validate Website
        if (empty($_POST["website"])) {
            $websiteErr = "Website is required";
        } else {
            $website = test_input($_POST["website"]);
            // check if URL is valid
            if (!filter_var($website, FILTER_VALIDATE_URL)) {
                $websiteErr = "Invalid URL format";
            }
        }

        // Validate Comment (optional)
        if (!empty($_POST["comment"])) {
            $comment = test_input($_POST["comment"]);
        }
    }

    // Function to sanitize input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>Form Validation Example</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <!-- Name Input -->
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>

        <!-- Email Input -->
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>

        <!-- Gender Input -->
        Gender:
        <input type="radio" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?>> Female
        <input type="radio" name="gender" value="male" <?php if ($gender == "male") echo "checked"; ?>> Male
        <span class="error">* <?php echo $genderErr; ?></span>
        <br><br>

        <!-- Website Input -->
        Website: <input type="text" name="website" value="<?php echo $website; ?>">
        <span class="error">* <?php echo $websiteErr; ?></span>
        <br><br>

        <!-- Comment Input -->
        Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
        <br><br>

        <input type="submit" value="Submit">

    </form>

    <?php
    // Display entered data if no errors
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nameErr && !$emailErr && !$genderErr && !$websiteErr) {
        echo "<h2>Your Input:</h2>";
        echo "Name: " . $name . "<br>";
        echo "E-mail: " . $email . "<br>";
        echo "Gender: " . $gender . "<br>";
        echo "Website: " . $website . "<br>";
        echo "Comment: " . $comment . "<br>";
    }
    ?>

</body>

</html>
