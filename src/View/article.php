<h1>Articolo</h1>
<a href="/"><input type="button" value="Home"></a>
<div><?php
$this->insert('articleTemplateFull', ['article'=> $article, 'authorName' => $authorName]);
?></div>