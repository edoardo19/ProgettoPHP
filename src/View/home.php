<h1>Giornale</h1>
<button>Login</button>
<div><?php 
foreach($articles as $a) {
 $this->insert('articleTemplate', ['article'=> $a]);
}
?></div>


