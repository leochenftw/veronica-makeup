<% include CartHero Size='medium' %>
<div class="section cart-content">
    <div class="container width-is-720 content">
    <% with $Cart %>
        <% if $OrderItems.Count > 0 %>
        <div class="columns heading">
            <div class="column is-1 has-text-right"></div>
            <div class="column">Set name</div>
            <div class="column is-1 has-text-right">Credit</div>
            <div class="column is-1">$Cost</div>
        </div>
        <% loop $OrderItems %>
            <% with $Product %>
                <div class="columns item">
                    <div class="column is-1 has-text-right only-image"><a href="$Link">$SmartCover('landscape').FillMax(41, 26)</a></div>
                    <div class="column item-title"><a href="$Link">$Title</a></div>
                    <div class="column is-1 item-credit has-text-right">$Cost</div>
                    <div class="column is-1"><a class="button is-small is-danger is-outlined btn-item-remover" href="/cart/remove?id=$Up.ID">remove</a></div>
                </div>
            <% end_with %>
        <% end_loop %>
        <div class="columns summary">
            <div class="column is-10 has-text-right">Total</div>
            <div id="sum" class="column is-1 has-text-right">$Amount.Amount</div>
            <div class="column is-1"></div>
        </div>
        <% with $Top.PaymentForm %>
            <form $FormAttributes class="columns">
                <div class="column is-10 has-text-right $MessageType">
                    <% if $Message %>$Message<% end_if %>
                    $clearMessage
                    $Fields
                </div>
                <div class="column is-1 has-text-right Actions">$Actions</div>
                <div class="column is-1"></div>
            </form>
        <% end_with %>
        <% else %>
            <p class="has-text-centered">The cart is empty</p>
        <% end_if %>
    <% end_with %>
    </div>
</div>
