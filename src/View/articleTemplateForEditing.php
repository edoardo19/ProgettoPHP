<?php foreach($articles as $article):?> 

<h2><a href=<?="/Article?title=".$this->e($article->TITLEFORURL)?>> <?= $this->e($article->TITLE) ?> </a></h2>

<<<<<<< HEAD
<a href=<?="/EditArticle?title=".$this->e($article->TITLEFORURL)?>><?=  $this->e($article->TITLE)?> </a>
<br>
<?= $this->e($article->ContentPreview()) ?>
<br>
<?= $this->e($article->DATEOFSUBMIT) ?>
=======
Title: <input type="text"  value=<?= $this->e($article->TITLE) ?>>
<textarea rows="4" cols="50"><?= $this->e($article->ContentPreview()) ?></textarea>
Date: <input type="text"  value=<?= $this->e($article->DATEOFSUBMIT) ?>>

<button>delete</button>
<button>update</button>

<?php endforeach ?> 
>>>>>>> 3af65a15670d236c18dde8d284e1b6012293a5c0
