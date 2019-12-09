<h1>Template for User</h1>
<h2>In this page I can see all the articles of a single user</h2>

<button>New article</button>
<div><?php 
foreach($userArticles as $a) {
    $this->insert('articleTemplateForEditing', ['article'=> $a]);
}?>
<button>Log Out</button>
