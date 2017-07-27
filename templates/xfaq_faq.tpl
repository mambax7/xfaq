<div class="xfaq">
    <div class="pad5 marg5 ui-widget-content ui-corner-all">
        <div class="pad5 marg5 ui-widget-header ui-corner-all"><{$smarty.const._AM_XFAQ_FAQ_QUESTION}>
            : <{$question}></div>
        <div class="pad5 marg5 ui-widget-content ui-corner-all"><{$answer}></div>

        <div class="pad5 marg5 ui-widget-content ui-corner-all">
            <p><{$smarty.const._AM_XFAQ_FAQ_HOWDOI}> : <{$howdoi}></p>
            <p><{$smarty.const._AM_XFAQ_FAQ_DIDUNO}> <{$diduno}></p>
            <p><{$url}></p>
        </div>

        <div class="pad5 marg5 ui-state-default ui-corner-all">
            <{$smarty.const._AM_XFAQ_FAQ_DATE_CREATED}>: <{$datecreated}>
            <{$smarty.const._AM_XFAQ_FAQ_SUBMITTER}>: <a
                    href="<{$xoops_url}>/userinfo.php?uid=<{$submitterid}>"><{$submittername}></a>
            <{if $ansuserid != 0}>
                <{$smarty.const._AM_XFAQ_FAQ_ANSUSER}>:
                <a href="<{$xoops_url}>/userinfo.php?uid=<{$ansuserid}>"><{$ansusername}></a>
            <{/if}>
        </div>


        <{if $tags}>
            <div><{include file="db:tag_bar.tpl"}></div>
        <{/if}>
    </div>
</div>
