<form method="post" action="" class="defaultForm form-horizontal">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-cogs"></i>
            Configuration du module
        </div>

        {if isset($confirmation)}
            <div class="alert alert-success">
                Configuration mise à jour
            </div>
        {/if}


    <div class="form-wrapper">
        <div class="form-group">
            <label class="control-label col-lg-3">Activer les notes :</label>
            <div class="col-lg-9">
                <img src="../img/admin/enabled.gif" />
                <input type="radio" id="enable_grades_1" name="enable_grades" value="1" {if $enable_grades eq 1}checked{/if}/>
                <label class="t" for="enable_grades_1">Oui</label>
                <img src="../img/admin/disabled.gif" />
                <input type="radio" id="enable_grades_0" name="enable_grades" value="0" {if $enable_grades ne 1}checked{/if}/>
                <label class="t" for="enable_grades_0">Non</label>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-lg-3">Activer les commentaires :</label>
            <div class="col-lg-9">
                <img src="../img/admin/enabled.gif" />
                <input type="radio" id="enable_comments_1" name="enable_commenents" value="1" {if $enable_comments eq 1}checked{/if}/>
                <label class="t" for="enable_commenents_1">Oui</label>
                <img src="../img/admin/disabled.gif" />
                <input type="radio" id="enable_commenents_0" name="enable_commenents" value="0" {if $enable_comments ne 1}checked{/if}/>
                <label class="t" for="enable_commenents_0">Non</label>
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-default pull-right" name="submit_modcomments_form" value="1" type="submit">
                <i class="process-icon-save"></i> Enregistrer
            </button>
        </div>
    </div>
    </div>
</form>
