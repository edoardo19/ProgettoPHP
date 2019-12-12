<h1>Edit your articles</h1>

    <div class="title">
    Title: <input type="text"  value=<?= $this->e($article->TITLE) ?>>
    </div>
<br>
    <div class="content">
    Content: <textarea rows="4" cols="50"><?= $this->e($article->CONTNENT) ?></textarea>
    </div>
<br>
    <div class="date">
    Update date: <input type="checkbox"  value=false >
    </div>
<br>
<button>update</button>
<button>delete</button>
