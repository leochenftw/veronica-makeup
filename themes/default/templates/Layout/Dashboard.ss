<% include CartHero Size='medium' %>
<div class="section member-dashboard">
    <div class="container">
        <div class="columns">
            <aside class="column is-2">
                <ul>
                    <li><a href="/member/action/profile">Profile</a></li>
                    <li><a href="/member/action/password">Password</a></li>
                    <li><a href="/member/action/purchased">Purchased</a></li>
                    <li><a href="/member/action/history">Transactions</a></li>
                    <li><a href="/member/signout">Sign out</a></li>
                </ul>
            </aside>
            <div class="column is-10">
                <% if $tab == 'profile' || not $tab %>
                    <h2 class="title is-2">Member profile</h2>
                    $MemberProfileForm
                <% end_if %>

                <% if $tab == 'password' %>
                    <h2 class="title is-2">Change password</h2>
                    $UpdatePasswordForm
                <% end_if %>

                <% if $tab == 'purchased' %>
                    <h2 class="title is-2">Purcahsed items</h2>
                    <% include PurchasedItems %>
                <% end_if %>

                <% if $tab == 'history' %>
                    <h2 class="title is-2">Transactions</h2>
                    <% include PurchaseHistory %>
                <% end_if %>
            </div>
        </div>
    </div>
</div>
