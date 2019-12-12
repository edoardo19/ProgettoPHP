<h2><a href=<?="/Article?title=".$this->e($article->TITLEFORURL)?>> <?= $this->e($article->TITLE) ?> </a></h2>

<a href=<?="/EditArticle?title=".$this->e($article->TITLEFORURL)?>><?=  $this->e($article->TITLE)?> </a>
<br>
<?= $this->e($article->ContentPreview()) ?>
<br>
<?= $this->e($article->DATEOFSUBMIT) ?>
