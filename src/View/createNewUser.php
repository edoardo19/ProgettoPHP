<h1>Create new user</h1>
<?php if($warning): ?>
    <p><?php echo($message) ?></p>
<?php endif ?>
<form action="/AdminManagerOperations" method="POST" name="edit">
    <p>Name:</p> 
    <input type="text" name="name" ?><br>
    <p>Password:</p> 
    <input type="password" name="password" ?><br>
    <input type="password" name="password2" ?><br>
    <p>Admin: 
        <input type="checkbox" name="adminRole">
    </p><br>
    <input type="submit" value="Create" name="operation">
    <a href="/AdminManager"><input type="button" value="Back"></a>
</form>