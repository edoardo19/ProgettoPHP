<h1>Edit your articles</h1>

<h2><a href=<?="/Article?title=".$this->e($article->TITLEFORURL)?>> <?= $this->e($article->TITLE) ?> </a></h2>

<?= $this->e($article->ID) ?> <!--perchè non stampa output da db? -->
<?= $this->e($article->TITLE) ?>

    <div class="title">
    Title: <input type="text"  value=<?= $this->e($article->TITLE) ?>>
    </div>
<br>
    <div class="content">
    Content: <textarea rows="4" cols="50"><?= $this->e($article->CONTNENT) ?></textarea>
    </div>
<br>
    <div class="date">
    Date: <input type="text"  value=<?= $this->e($article->DATEOFSUBMIT) ?>>
    </div>
<br>
<button>update</button>
<button>delete</button>
