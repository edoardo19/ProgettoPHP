<h1>Giornale</h1>
<a href="/Login"><button>Login</button></a>
<div><?php 
foreach($articles as $a) {
    $this->insert('articleTemplate', ['article'=> $a]);
}
?></div>


