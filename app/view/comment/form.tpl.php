<div class='comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($page_id)?>">
        <fieldset>
        <legend>Skapa en kommentar</legend>
        <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p>
            <div class='short-field'><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></div>
            <div class='short-field'><label>E-post:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></div>
        </p>
        <input type='hidden' name='page_id' value='<?=$page_id?>'/>
        <p class=buttons>
            <input type='submit' name='doCreate' value='Kommentera' onClick="this.form.action = '<?=$this->url->create('my_comment/add')?>'"/>
            <input type='reset' value='Reset'/>
            <input type='submit' name='doRemoveAll' value='Radera alla' onClick="this.form.action = '<?=$this->url->create('my_comment/remove-all')?>'"/>
        </p>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>
