<?php
$string1 = "";
$string2 = "";
$origString1 = "";
$origString2 = "";

if (isset($_POST['string1']) && isset($_POST['string2'])) {
    $string1 = $_POST['string1'];
    $string2 = $_POST['string2'];

    // save the original strings (with spaces & everything, to show it after form submission)
    $origString1 = $_POST['string1'];
    $origString2 = $_POST['string2'];

    // remove apostrophe from the strings
    $string1 = str_replace("'", "", $string1);
    $string2 = str_replace("'", "", $string2);

    // remove whitespace from the strings
    $string1 = str_replace(" ", "", $string1);
    $string2 = str_replace(" ", "", $string2);

    // convert strings to lowercase
    $string1 = strtolower($string1);
    $string2 = strtolower($string2);

    // sort the strings by converting them to arrays
    $string1Array = str_split($string1);
    $string2Array = str_split($string2);
    sort($string1Array);
    sort($string2Array);

    // convert the arrays back to strings
    $sortedString1 = "";
    $sortedString2 = "";
    foreach ($string1Array as $string1Char) {
        $sortedString1 .= $string1Char;
    }
    foreach ($string2Array as $string2Char) {
        $sortedString2 .= $string2Char;
    }

    // compare the new sorted strings
    if ($sortedString1 == $sortedString2)
        header("location: " . $_SERVER['REQUEST_URI'] . "?a=1&string1=$origString1&string2=$origString2");
    else
        header("location: " . $_SERVER['REQUEST_URI'] . "?a=0&string1=$origString1&string2=$origString2");
}

$qMark = "?";
if (isset($_GET['a']) && $_GET['a'] == 1)
    $qMark = " is an anagram of ";
else if (isset($_GET['a']) && $_GET['a'] == 0)
    $qMark = " is NOT an anagram of ";

if (isset($_GET['string1']))
    $string1 = $_GET['string1'];
if (isset($_GET['string2']))
    $string2 = $_GET['string2'];
?>

<html>

    <head>
        <title>Anagram Checker</title>
    </head>

    <body>
        <h1>Anagram Checker</h1>
        <form method="post" action="">
            <input type="text" name="string1" value="<?= (!empty($string1) ? $string1 : '') ?>" placeholder="String 1">
            <span id="qMark"><?= $qMark ?></span>
            <input type="text" name="string2" value="<?= (!empty($string2) ? $string2 : '') ?>" placeholder="String 2">
            <input type="<?= (isset($_GET['a']) ? 'hidden' : 'submit')?>" value="Submit">
        </form>

        <?php if (isset($_GET['a'])): ?>
        <input type="button" value="Reset" onclick="window.location='<?= $_SERVER['PHP_SELF'] ?>'">
        <?php endif; ?>
    </body>

</html>