<?php
include 'includes/sessions.php';
include 'includes/header-member.php';

require_login($logged_in);
?>

<h1>My Profiles</h1>

<?php
//include 'includes/header.php';

$name = $age = $email = $bio = '';
$formVaid = [
    'nameValid' => false,
    'ageValid' => false,
    'emailValid' => false,
    'bioValid' => false
];

$formVaidMsg = [
    'name' => '',
    'age' => false,
    'email' => false,
    'bio' => false
];

$formInVaidMsg = [
    'name' => '',
    'age' => false,
    'email' => false,
    'bio' => false
];

function is_number($number, int $min = 0, int $max = 100): bool {
    return ($number >= $min and $number <= $max);
}

function is_text($text, int $min = 0, int $max = 1000): bool {
    $length = mb_strlen($text);
    return ($length >= $min and $length <= $max);
}

function is_password(string $password): bool {
    if (
            mb_strlen($password) >= 8
            and preg_match('/[A-Z]/', $password)
            and preg_match('/[a-z]/', $password)
            and preg_match('/[0-9]/', $password)
    ) {
        return true;  // Passed all tests
    }
    return false;     // Invalid
}

//$valid   = in_array($stars, $star_ratings);

$errors = false;

if ($_POST) {


    $isNameAvail = mb_strlen(htmlspecialchars($_POST['name']));

    if ($isNameAvail > 5) {
        $formVaid['nameValid'] = true;
        $formVaidMsg['name'] = "Input accepted";
        $_SESSION['name'] = $_POST['name'];
    } else {
        $formInVaidMsg['name'] = "Input Incorrecet.";
    }

    $age = $_POST['age'];

    $validateAge = is_number($age, 18, 100);

    if ($validateAge) {
        $formVaid['ageValid'] = true;
        $formVaidMsg['age'] = "Age Input accepted";

        $_SESSION['age'] = $_POST['age'];
    } else {
        $formInVaidMsg['age'] = "Age Input Incorrecet.";
    }
    //  die();
    // email@nbn.cmm


    $email = $_POST['email'];
    if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
        $emailValidMsgE = "Email is not valid";
    } else {
        $emailValidMsg = "Email is valid";
        $emailValid = true;
        $_SESSION['email'] = $_POST['email'];
    }



    $name = htmlspecialchars($_POST['name']);
    $bio = htmlspecialchars($_POST['bio']);

    $validatebio = is_text($bio, 500);

    if ($validatebio) {
        $bioValid = true;
        $bioValidMsgS = "Bio Input accepted";

        $_SESSION['bio'] = $_POST['name'];
    } else {
        $bioValidMsgE = "Bio Input Incorrecet.";
    }
} else {
    // echo "Form is not submitted yet.";
}



// regex
// 

if (isset($_SESSION['name'])) {
    ?>
<div style="text-align: left
     "> 
        <?php
        foreach ($_SESSION as $key => $value) {
            ?>
            <p>Name:     
                <label> 
        <?php echo $key; ?> :: <?php echo $value; ?>
                </label>
            </p>

        <?php
    }
    ?>
    </div>
        <?php
    } else {
        ?>



    <form action="" method="POST">
        <p>Name:     
            <input type="text" value="<?php echo $name; ?>"    class="invalid" name="name">
            <label style="color: red; border: 1px solid red">
    <?php echo $formVaid['nameValid'] === true ? $formVaidMsg['name'] : $formInVaidMsg['name'] ?>

            </label>
        </p>


        <p>Age:      <input type="number" name="age" value="<?php echo $age; ?>" >
            <label style="color: red; border: 1px solid red">
    <?php echo $formVaid['ageValid'] === true ? $formVaidMsg['age'] : $formInVaidMsg['age'] ?>

            </label>
        </p>


        <p>Email:    <input type="text" name="email" value="<?php echo $email; ?>" >

            <label style="color: red; border: 1px solid red">
    <?php echo $formVaid['emailValid'] === true ? $formVaidMsg['email'] : $formInVaidMsg['email'] ?>

            </label>
        </p>


        <p>Password: <input type="password" name="pwd"></p>


        <p>Bio:      <textarea name="bio"> <?php echo $bio ?></textarea>


            <label style="color: red; border: 1px solid red">
    <?php echo $formVaid['bioValid'] === true ? $formVaidMsg['bio'] : $formInVaidMsg['bio'] ?>

            </label>
        </p>

        <p><input type="submit" value="Save"></p>
    </form>

<?php } ?>
<?php include 'includes/footer.php'; ?>