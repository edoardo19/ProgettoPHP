<h1>Edit your articles</h1>
<form action=<?="/CRUDOperations?title=".$this->e($article->TITLEFORURL).'&id='.$this->e($article->ID)?> method="POST" name="edit">
    <p>Title:</p>
    <input type="text" name="title" value="<?= $this->e($article->TITLE)?>" ><br>
    <p>Content:</p>
    <textarea name="content" rows="4" cols="50"><?= $this->e($article->CONTNENT) ?></textarea><br><br>
    Update date of submit: <input type="checkbox" name="updateDate"><br><br>
    <input type="submit" value="Delete" name="operation">
    <input type="submit" value="Update" name="operation">
    <a href="/Editing"><input type="button" value="Back"></a>
</form>
