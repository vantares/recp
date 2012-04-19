{if $class == 'notice'}
    <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0.7em;"> 
            <p>
                <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                {$notice}
            </p>
        </div>

        </div>
        {elseif $class == 'errornotice'}
        <div class="ui-widget separador10">
        <div class="ui-state-error ui-corner-all" style="padding: 0.7em;"> 
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
            {$notice} </p>
        </div>
    </div>
{/if} 