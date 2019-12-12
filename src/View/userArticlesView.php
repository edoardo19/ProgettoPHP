<h1>Template for User</h1>
<h2>In this page I can see all the articles of a single user</h2>

<button>New article</button>
<div><?php 
    $this->insert('articleTemplateForEditing', ['articles'=> $userArticles]);
?>
<button>Log Out</button>
