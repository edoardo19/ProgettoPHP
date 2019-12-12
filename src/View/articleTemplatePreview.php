<p>----------------------------------------------------------------------------------------------------------------------------------</p>
<?php foreach($articles as $article):?> 

    <h2><a href=<?="/Article?title=".$this->e($article->TITLEFORURL)?>> <?= $this->e($article->TITLE) ?> </a></h2>

    <h3><?= $this->e($article->ContentPreview()) ?></h3>
    <h4><?= $this->e($article->DATEOFSUBMIT) ?></h4>

    <p>----------------------------------------------------------------------------------------------------------------------------------</p>
<?php endforeach ?> 
