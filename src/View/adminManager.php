<h1>Welcome 
    <a href=<?="/EditUser?id=".$this->e($adminID).'&&author='.$this->e($adminName)?>>
        <?=$this->e($adminName)?>
    </a>
</h1>

<form action="/AdminManagerOperations" method="POST" name="edit">
    <input type="submit" value="Create new user" name="operation">
</form>

<p>----------------------------------------------------------------------------------------------------------------------------------</p>
<?php foreach($users as $user):?> 
    <h3>
        <?=$this->e($user['ID'])?> 
            <a href=<?='\EditUser?id='.$this->e($user['ID']).'&&author='.$this->e($adminName)?>>
                <?=$this->e($user['NAME'])?>
            </a>
    </h3>
    <p>----------------------------------------------------------------------------------------------------------------------------------</p>
<?php endforeach ?> 

<a href="\Logout"><input type="button" value="Logout"></a>