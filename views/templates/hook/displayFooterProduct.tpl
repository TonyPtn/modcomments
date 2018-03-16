<h3 class="page-product-heading" id="modcomments-content-tab" {if isset($new_comment_posted)} data-scroll='true'{/if}>{l s='Comments' mod='modcomments'}</h3>
<div class="rte">
    {foreach from=$comments item=comment}
        <p>
            <strong>{l s='Comment' mod='modcomments'} #{$comment.id_modcomments} :</strong>
            {$comment.comment}<br />
            <strong>{l s='Grade' mod='modcomments'} : </strong>{$comment.grade}/5<br></br>
        </p>
    {/foreach}
    <form method="post" action="" id="comment-form">
        {if $enable_grades eq 1}
        <div class="form-group">
            <label for="grade">{l s='Grade' mod='modcomments'} :</label>
            <div class="row">
                <div class="col-xs-4">
                    <select id="grade" class="form-control" name="grade">
                        <option value="0">-- {l s='Choose' mod='modcomments'} --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>
        {/if}
        {if $enable_comments eq 1}
        <div class="form-group">
            <label for="comment">{l s='Comment' mod='modcomments'} :</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
        {/if}
        {if $enable_grades eq 1 OR $enable_comments eq 1}
        <div class="submit">
            <button type="submit" name="modcomment_pc_submit_comment" class="btn btn-primary">
                {l s='Send' mod='modcomments'}
            </button>
        </div>
        {/if}
    </form>
</div>
