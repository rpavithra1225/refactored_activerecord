<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


//instantiate the program object

//Class to load classes it finds the file when the progrm starts to fail for calling a missing class
class Manage {
    public static function autoload($class) {
        //you can put any file name or directory here
        include $class . '.php';
        //include_once 'db.php';
        //include 'htmlTagsHelper.php';
    }
}

spl_autoload_register(array('Manage', 'autoload'));

$findall_accounts = accounts::findAll();
$findone_account = accounts::findOne(1);
$findall_todos = todos::findAll();
$findone_todo = todos::findOne(1);
?>
<table border="0">
    <tr><th>Select all Account records</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            accounts::printHeaders($findall_accounts[0]);
        ?>
    </tr>

<?php 
    accounts::printAll($findall_accounts);
       
?>
<table border="0">
    <tr><th>Select One Account record </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            accounts::printHeaders($findone_account);
        ?>
    </tr>

<?php 
    accounts::printOne($findone_account); 
?>
<table border="0">
    <tr><th>Select all Todos records</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            todos::printHeaders($all_todos[0]);
        ?>
    </tr>

<?php 
    todos::printAll($all_todos);
?>
<table border="0">
    <tr><th>Select one todo record</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            todos::printHeaders($findone_todo);
        ?>
    </tr>

<?php 
    todos::printOne($findone_todo);


$new_account = new account();
$new_account->id = '';
$new_account->email = 'test1@gmail.com';
$new_account->fname = 'Test';
$new_account->lname = 'User1';
$new_account->phone = '87612367890';
$new_account->birthday= '1993-03-06';
$new_account->gender = 'female';
$new_account->password = '1234';
$new_account->save();
$findall_accounts = accounts::findAll();
?>
<table border="0">
    <tr><th>New Insterted record is at the bottom</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            accounts::printHeaders($findall_accounts[0]);
        ?>
    </tr>

<?php 
    accounts::printAll($findall_accounts);

$record = new todo();
$record->id = '';
$record->owneremail = $new_account->email;
$record->ownerid = $new_account->id;
$record->createddate = '2017-11-13';
$record->duedate = '2017-11-16';
$record->message = 'Updating todos';
$record->isdone = 0;
$record->save();
$all_todos = todos::findAll();
?>
<table border="0">
    <tr><th>Newly Insterted record is at the bottom</th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            todos::printHeaders($findall_todos[0]);
        ?>
    </tr>

<?php 
    todos::printAll($findall_todos);

$new_account = accounts::findOne(9);
if($new_account != null)
{    
?>
<table border="0">
    <tr><th>Before Accounts Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            accounts::printHeaders($new_account);
        ?>
    </tr>

<?php 
    accounts::printOne($new_account);

$new_account->email='newUpdatedEmail@gmail.com';
$new_account->save();

?>
<table border="0">
    <tr><th>After Accounts Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            accounts::printHeaders($new_account);
        ?>
    </tr>

<?php 
    accounts::printOne($new_account);
}
else 
    echo "<h3>No record found to update the account, for the ID passed.</h3>";

$record=todos::findOne(4);
if($record != null){
?>
<table border="0">
    <tr><th>Before Todos Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            todos::printHeaders($record);
        ?>
    </tr>

<?php 
    todos::printOne($record);

$record->isdone=1;
$record->save();

?>
<table border="0">
    <tr><th>After Todos Update </th></tr>
    <tr COLSPAN=2 BGCOLOR="#55ff00">
        <?php
            todos::printHeaders($record);
        ?>
    </tr>

<?php 
    todos::printOne($record);
}
else 
    echo "<h3>No record found to update the todo, for the ID passed.</h3>";

$new_account = accounts::findOne(31);
if($new_account != null){
    $new_account->delete();
    $findall_accounts = accounts::findAll();
    ?>
    <table border="0">
        <tr><th>Before deleting in Accounts</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                accounts::printHeaders($findall_accounts[0]);
            ?>
        </tr>

    <?php 
        accounts::printAll($findall_accounts);

    $findall_accounts = accounts::findAll();
    ?>
    <table border="0">
        <tr><th>After deleting in Accounts</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                accounts::printHeaders($findall_accounts[0]);
            ?>
        </tr>

    <?php 
        accounts::printAll($findall_accounts);
}
else
    echo "<h1>No record found or already the account has been deleted</h1>";

$record = todos::findOne(10);
if($record != null){
    $record->delete();
    $all_todos = todos::findAll();
    ?>
    <table border="0">
        <tr><th>Before deleting in Todos</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                todos::printHeaders($findall_todos[0]);
            ?>
        </tr>

    <?php 
        todos::printAll($findall_todos);
        $all_todos = todos::findAll();
    ?>
    <table border="0">
        <tr><th>After deleting in Todos</th></tr>
        <tr COLSPAN=2 BGCOLOR="#55ff00">
            <?php
                todos::printHeaders($findall_todos[0]);
            ?>
        </tr>

    <?php 
        todos::printAll($findall_todos);
}

else
    echo "<h1>No record found or already the todo has been deleted</h1>";
?>