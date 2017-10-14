<% if $CurrentMember.Orders %>
    <div class="columns heading">
        <div class="column is-1">Transac</div>
        <div class="column">Purchase content</div>
        <div class="column is-2">Time</div>
        <div class="column is-1 order-credit">Credit</div>
    </div>
    <% loop $CurrentMember.Orders.Sort('ID', 'DESC') %>
        <div class="columns transaction">
            <div class="column is-1">$getSuccessPayment.TransacID</div>
            <div class="column order-images">
                <% loop $OrderItems.limit(7) %>
                    <a href="$getProduct.Link" target="_blank" class="is-inline-block">$getProduct.SmartCover('landscape').FillMax(41, 26)</a>
                <% end_loop %>
            </div>
            <div class="column is-2">$Created</div>
            <div class="column is-1 order-credit">$Amount.Amount cr</div>
        </div>
    <% end_loop %>
<% else %>
    <p>No purchase history</p>
<% end_if %>
