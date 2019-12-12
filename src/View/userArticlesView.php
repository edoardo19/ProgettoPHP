<h1>Template for User</h1>
<h2>In this page I can see all the articles of a single user</h2>

<button>New article</button>

<div><?php 
<<<<<<< HEAD
foreach($userArticles as $a) {
    $this->insert('articleTemplateForEditing', ['article'=> $a]);
}?>
<br>
=======
    $this->insert('articleTemplateForEditing', ['articles'=> $userArticles]);
?>
>>>>>>> 3af65a15670d236c18dde8d284e1b6012293a5c0
<button>Log Out</button>
