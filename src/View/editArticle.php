<h1>Edit your articles</h1>
<form action=<?="/CRUDOperations?title=".$this->e($article->TITLEFORURL).'&id='.$this->e($article->ID)?> method="POST" name="edit">
    Title: <input type="text" name="title" value=<?= $this->e($article->TITLE)?> ><br>
    Content: <textarea name="content" rows="4" cols="50"><?= $this->e($article->CONTNENT) ?></textarea><br>
    Update date: <input type="checkbox" name="updateDate"><br>
    <input type="submit" value="Delete" name="operation">
    <input type="submit" value="Update" name="operation">
</form>
