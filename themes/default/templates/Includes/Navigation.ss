<nav class="navbar is-transparent">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/" id="logo" rel="start">
            <% if $SiteConfig.Logo %>
                <% with $SiteConfig.Logo.SetHeight(80) %>
                <img alt="$Up.Up.Title" width="$Width" height="$Height" src="$URL" />
                <% end_with %>
            <% else %>
                $SiteConfig.Title
            <% end_if %>
            </a>
            <div class="navbar-burger">
                <a class="button icon" href="/?anchor=contact-form"><i class="fa fa-paper-plane"></i></a>
                <%-- <span></span>
                <span></span>
                <span></span> --%>
            </div>
        </div>

        <div class="navbar-menu">
            <div class="navbar-end">
                <% loop $MenuSet('Main Menu').MenuItems %>
                <a href="$Link" class="navbar-item <% if LinkOrCurrent = current || $LinkOrSection = section %>is-active<% end_if %>">$MenuTitle.XML</a>
                <% end_loop %>
            </div>
        </div>
    </div>
</nav>
