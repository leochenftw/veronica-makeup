<% include PhotoSetHero Size='medium' %>
<div class="section">
    <div class="container">
        <div class="columns should-wrap">
            <% loop $Photos %>
                <div class="column is-2">$Image.SetWidth(375)</div>
            <% end_loop %>
        </div>
    </div>
</div>
$PurchaseForm
