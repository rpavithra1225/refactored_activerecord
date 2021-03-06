<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


//instantiate the program object

//Class to load classes it finds the file when the progrm starts to fail for calling a missing class
class Manage {
    public static function autoload($class) {
        //echo $class . '<br>';
        $path = 'classes/' .  str_replace('\\', '/', $class). '.php';
        //echo $path . '<br>';
        if(file_exists($path))
        include $path;
    }
}
spl_autoload_register(array('Manage', 'autoload'));

$findall_accounts = \collections\accounts::findAll();
$findone_account = \collections\accounts::findOne(13);
$findall_todos = \collections\todos::findAll();
$findone_todo = \collections\todos::findOne(1);
?>
<html>
<link rel='stylesheet' href='styles.css'>
<h1>Select all records : Accounts</h1>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\accounts::printHeaders($findall_accounts[0]);
        ?>
    </tr>

<?php 
    \collections\accounts::printAll($findall_accounts);
       
?>

<hr>

<h1>Select One Record : Accounts </h1>
<p> Selected id: 1 </p>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\accounts::printHeaders($findone_account);
        ?>
    </tr>

<?php 
    \collections\accounts::printOne($findone_account); 
?>
<hr>

<h1>Select all records : Todos</h1>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\todos::printHeaders($findall_todos[0]);
        ?>
    </tr>

<?php 
    \collections\todos::printAll($findall_todos);
?>
<hr>

<h1>Select one records : Todos</h1>
<p> Selected id: 1 </p>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\todos::printHeaders($findone_todo);
        ?>
    </tr>

<?php 
    \collections\todos::printOne($findone_todo);


/*$new_account = new \models\accounts();
$new_account->id = '';
$new_account->email = 'wer345@gmail.com';
$new_account->fname = 'Welcome';
$new_account->lname = 'WSD';
$new_account->phone = '12345678';
$new_account->birthday= '2000-11-12';
$new_account->gender = 'male';
$new_account->password = '345';
if(is_object($new_account)){
$new_account->save();}*/
$findall_accounts = \collections\accounts::findAll();
?>
<hr>
<h1>Select all records with newly added record: Accounts</h1>
<p> Please find newly added record at the last</p>

<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\accounts::printHeaders($findall_accounts[0]);
        ?>
    </tr>

<?php 
    \collections\accounts::printAll($findall_accounts);
    ?>

 <hr>

<?php
$record = new \models\todos();
$record->id = '';
//echo 'hiiiiiiiiiiiiii'.$new_account->email;
$record->owneremail = 'wer345@gmail.com';
$record->ownerid = '23';
$record->createddate = '2016-4-3';
$record->duedate = '2018-3-3';
$record->message = 'todos added';
$record->isdone = 0;
$lastinserted=$record->save();
$all_todos = \collections\todos::findAll();
?>

<h1>Select all records with newly added record: Todos</h1>
<p> Please find newly added record at the last</p>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\todos::printHeaders($findall_todos[0]);
        ?>
    </tr>

<?php 
    \collections\todos::printAll($findall_todos);
?>


<?php
$new_account = \collections\accounts::findOne(1);
if($new_account != null)
{    
?>
<hr>
<h1>Before Accounts Update </h1>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\accounts::printHeaders($new_account);
        ?>
    </tr>
    

<?php 
    \collections\accounts::printOne($new_account);

$new_account->email='new@gmail.com';
$new_account->save();

?>
<hr>
<h1>After Accounts Update </h1>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\accounts::printHeaders($new_account);
        ?>
    </tr>

<?php 
    \collections\accounts::printOne($new_account);
}
else 
    echo "<h3>No record found</h3>";
?>
<hr>
<?php
$record=\collections\todos::findOne(4);
print_r($record);
if($record != null){
?>

<h1>Before Todos Update </h1>
<table border="1">
    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\todos::printHeaders($record);
        ?>
    </tr>

<?php 
    \collections\todos::printOne($record);

$record->owneremail='';
if(is_object($record)){
$lastUpdated=$record->save();
}
if($lastUpdated){
    echo "Successfully edited";
}
else {
    echo "Task failed";
}

?>
<hr>
<h1>After Todos Update </h1>
<table border="1">

    
    <tr COLSPAN=2 BGCOLOR="#f2dacd">
        <?php
            \collections\todos::printHeaders($record);
        ?>
    </tr>

<?php 
    \collections\todos::printOne($record);
}
else 
    echo "<h3>No record found </h3>";

$new_account = \collections\accounts::findOne(13);
if($new_account != null){
    if(is_object($new_account)){
    $new_account->delete();}
    $findall_accounts = \collections\accounts::findAll();
    ?>
    <hr>
    <h1>Before Accounts Delete </h1>
	<table border="1">
 
        
        <tr COLSPAN=2 BGCOLOR="#f2dacd">
            <?php
                \collections\accounts::printHeaders($findall_accounts[0]);
            ?>
        </tr>

    <?php 
        \collections\accounts::printAll($findall_accounts);

    $findall_accounts = \collections\accounts::findAll();
    ?>
<hr>
    <h1>After Accounts Delete </h1>
    <table border="1">
        
        <tr COLSPAN=2 BGCOLOR="#f2dacd">
            <?php
                \collections\accounts::printHeaders($findall_accounts[0]);
            ?>
        </tr>

    <?php 
        \collections\accounts::printAll($findall_accounts);
}
else
    echo "<h1>No record found. Check if the record has been deleted already</h1>";

$record = \collections\todos::findOne(4);
if($record != null){
    if(is_object($record)){
    $record->delete();}
    $all_todos = \collections\todos::findAll();
    ?>
    <hr>
    <h1>Before Todos Delete </h1>
    <table border="1">
        
        <tr COLSPAN=2 BGCOLOR="#f2dacd">
            <?php
                \collections\todos::printHeaders($findall_todos[0]);
            ?>
        </tr>

    <?php 
        \collections\todos::printAll($findall_todos);
        $all_todos = \collections\todos::findAll();
    ?>
    <hr>
    <h1>After Todos Delete </h1>
    <table border="1">
        <tr><th>After deleting in Todos</th></tr>
        <tr COLSPAN=2 BGCOLOR="#f2dacd">
            <?php
                \collections\todos::printHeaders($findall_todos[0]);
            ?>
        </tr>

    <?php 
        \collections\todos::printAll($findall_todos);
}

else
    echo "<h1>No record found. Check if the record has been deleted already</h1>";

?>