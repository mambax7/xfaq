<div class="xfaq">
    <{if $faqNum > 0}>
        <script type="text/javascript">
            $(function () {
                $("#accordion").accordion({
                    collapsible: true,
                    active: false,
                    clearStyle: true,
                    icons: {'header': 'ui-icon-plus', 'headerSelected': 'ui-icon-minus'}
                });
            });
        </script>
    <{/if}>

    <{if $topicNum > 0}>
        <div class="pad5 marg5 ui-widget-content ui-corner-all">

            <div class="pad5 marg5 ui-state-default ui-corner-all"><{$smarty.const._AM_XFAQ_MANAGER_TOPIC}></div>
            <{foreach item=topic from=$topicList}>
                <div class="pad5 marg5 ui-widget-header ui-corner-all"><a
                            href="<{$xoops_url}>/modules/xfaq/index.php?cid=<{$topic.topic_id}>"><{$topic.topic_title}></a>
                </div>
                <{if $topic.topic_desc}>
                    <div class="pad5 marg5 ui-widget-content ui-corner-all">
                        <{if $topic.topic_img}>
                            <a href="<{$xoops_url}>/modules/xfaq/index.php?cid=<{$topic.topic_id}>">
                                <img src="<{$xoops_url}>/uploads/xfaq/topics/images/<{$topic.topic_img}>"> </a>
                        <{/if}>
                        <{$topic.topic_desc}>
                    </div>
                <{/if}>

            <{/foreach}>

        </div>
    <{/if}>

    <{if $faqNum > 0}>
        <div class="pad5 marg5 ui-widget-content ui-corner-all">

            <{if $faqpagenav != ''}>
                <div class="pagenav"><{$faqpagenav}>        </div>
            <{/if}>

            <div class="pad5 marg5 ui-state-default ui-corner-all">
                <strong><{$smarty.const._AM_XFAQ_MANAGER_FAQ}></strong></div>

            <div class="pad5 marg5">
                <div id="accordion">
                    <{foreach item=faq from=$faqList}>
                        <h3><strong>
                                <a href="#"><{$faq.faq_question}></a>
                            </strong></h3>
                        <div>


                            <div>
                                <div class="pad5 marg5 ui-widget-content ui-corner-all">
                                    <strong><{$smarty.const._AM_XFAQ_FAQ_ANSWER}>:</strong>
                                    <{if $faq.faq_answer == ''}>
                                        <{$smarty.const._AM_XFAQ_FAQ_NO_ANSWER}>
                                    <{else}>
                                        <{$faq.faq_answer}>
                                    <{/if}>
                                </div>

                                <div class="pad5 marg5 ui-state-default ui-corner-all">
                                    <{$smarty.const._AM_XFAQ_FAQ_DATE_CREATED}>: <{$faq.faq_date_created}>
                                    <{$smarty.const._AM_XFAQ_FAQ_SUBMITTER}>: <a
                                            href="<{$xoops_url}>/userinfo.php?uid=<{$faq.faq_submitterId}>"><{$faq.faq_submitter}></a>
                                    <{if $faq.faq_ansUserId != 0}>
                                        <{$smarty.const._AM_XFAQ_FAQ_ANSUSER}>:
                                        <a href="<{$xoops_url}>/userinfo.php?uid=<{$faq.faq_ansUserId}>"><{$faq.faq_ansUser}></a>
                                        <a href="<{$xoops_url}>/modules/xfaq/request.php?op=edit_faq&faq_id=<{$faq.faq_id}>"><img
                                                    src="<{$xoops_url}>/modules/xfaq/assets/images/icons/edit.png"
                                                    alt=<{$smarty.const._AM_XFAQ_EDIT}> title=<{$smarty.const._AM_XFAQ_EDIT}>></a>
                                        <a href="<{$xoops_url}>/modules/xfaq/request.php?op=delete_faq&faq_id=<{$faq.faq_id}>"><img
                                                    src="<{$xoops_url}>/modules/xfaq/assets/images/icons/delete.png"
                                                    alt=<{$smarty.const._AM_XFAQ_EDIT}> title=<{$smarty.const._AM_XFAQ_DELETE}>></a>
                                        <a href="<{$xoops_url}>/modules/xfaq/index.php?cid=<{$faq.faq_topicId}>"><img
                                                    src="<{$xoops_url}>/modules/xfaq/assets/images/icons/topic.png"
                                                    alt=<{$smarty.const._AM_XFAQ_FAQ_TOPIC}> title=<{$smarty.const._AM_XFAQ_FAQ_TOPIC}>></a>
                                    <{/if}>
                                </div>
                            </div>


                            <p><{$smarty.const._AM_XFAQ_FAQ_HOWDOI}> : <{$faq.faq_howdoi}></p>
                            <p><{$smarty.const._AM_XFAQ_FAQ_DIDUNO}> <{$faq.faq_diduno}></p>
                        </div>
                    <{/foreach}>
                </div>
            </div>

            <{if $faqpagenav != ''}>
                <div class="pagenav"><{$faqpagenav}></div>
            <{/if}>

        </div>
    <{/if}>

</div>
