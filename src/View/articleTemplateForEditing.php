<?php foreach($articles as $article):?> 

<h2><a href=<?="/Article?title=".$this->e($article->TITLEFORURL)?>> <?= $this->e($article->TITLE) ?> </a></h2>

Title: <input type="text"  value=<?= $this->e($article->TITLE) ?>>
<textarea rows="4" cols="50"><?= $this->e($article->ContentPreview()) ?></textarea>
Date: <input type="text"  value=<?= $this->e($article->DATEOFSUBMIT) ?>>

<button>delete</button>
<button>update</button>

<?php endforeach ?> 
