<h1>Template for User</h1>
<h2>In this page I can see all the articles of a single user</h2>

<form action="/CRUDOperations" method="POST" name="edit">
    <input type="submit" value="Create new article" name="operation">
</form>

<div><?php 
    $this->insert('articleTemplateForChoosing', ['articles'=> $userArticles]);
?>

<button>Log Out</button>
