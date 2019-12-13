<h1>Edit user <?=$user[0]['NAME']?></h1>
<?php if($warning): ?>
    <p><?php echo($message) ?></p>
<?php endif ?>
<form action="/AdminManagerOperations" method="POST" name="edit">
    <input type="hidden" name="author" value=<?php echo $_GET['author'] ?>>
    <p>ID:</p>
    <input type="text" name="id" value="<?php echo($this->e($user[0]['ID']))?>" readonly><br>
    <p>Name:</p>
    <input type="text" name="name" value="<?= $this->e($user[0]['NAME'])?>" ><br>
    <p>New password:</p>
    <input type="password" name="password" value="" ><br>
    <input type="password" name="password2" value="" ><br><br>
    <input type="submit" value="Delete" name="operation">
    <input type="submit" value="Update" name="operation">
    <a href="/AdminManager"><input type="button" value="Back"></a>
</form>