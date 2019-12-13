<h1>Create your articles</h1>
<?php if($warning): ?>
    <p>Fill all the fields</p>
<?php endif ?>
<form action="/CRUDOperations" method="POST" name="edit">
    <p>Title:</p> 
    <input type="text" name="title"?><br>
    <p>Content:</p> 
    <textarea name="content" rows="4" cols="50"></textarea><br><br>
    <input type="submit" value="Create" name="operation">
    <a href="/Editing"><input type="button" value="Back"></a>
</form>
