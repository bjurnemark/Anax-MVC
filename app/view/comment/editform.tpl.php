<div class='comment-form'>
    <form method=post>
        <input type='hidden' name='redirect'  value="<?=$this->url->create($page_id)?>">
        <input type='hidden' name='page_id'   value='<?=$page_id?>'/>
        <input type='hidden' name='timestamp' value='<?=$timestamp?>'/>
        <fieldset>
        <legend>Redigera kommentar</legend>
        <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p>
            <div class='short-field'><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></div>
            <div class='short-field'><label>E-post:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></div>
        </p>
        <p class=buttons>
            <input type='submit' name='doEdit' value='Spara' onClick="this.form.action = '<?=$this->url->create('my_comment/replace')?>'"/>
            <input type='reset' value='Reset'/>
        </p>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>
