<table class="outer">
    <{foreachq item=faq from=$block}>
    <tr class="<{cycle values = "even,odd"}>">
        <td><{$faq.faq_id}>;
            <{$faq.faq_question}>;
            <{$faq.faq_answer}>;
            <{$faq.faq_submitter}>;
            <{$faq.faq_date_created}>;
            <{$faq.faq_online}>;
        </td>
    </tr>
    <{/foreach}>
</table>

