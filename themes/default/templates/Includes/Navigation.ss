<nav id="main_nav" class="nav column header__nav is-2 is-paddingless">
    <% if $CurrentMember %>
        <ul class="columns is-paddingless is-marginless">
            <li class="column<% if LinkOrCurrent = current || $LinkOrSection = section %> current<% end_if %>">
                <a href="/cart">Cart</a>
            </li>
            <li class="column<% if LinkOrCurrent = current || $LinkOrSection = section %> current<% end_if %>">
                <a href="/member">Member</a>
            </li>
        </ul>
    <% else %>
        <ul class="columns is-paddingless is-marginless">
            <% loop $MenuSet('Main Menu').MenuItems %>
            <li class="column<% if LinkOrCurrent = current || $LinkOrSection = section %> current<% end_if %>">
                <a href="$Link" class="$LinkingMode" <% if IsNewWindow %>target="_blank"<% end_if %>>$MenuTitle</a>
            </li>
            <% end_loop %>
        </ul>
    <% end_if %>

    <%-- <div class="column is-1 is-relative is-paddingless has-text-right">
        <button id="btn-mobile-menu" class="header__nav__menu-toggler is-paddingless">
            <span class="t1"></span>
            <span class="t2"></span>
            <span class="t3"></span>
        </button>
    </div> --%>
</nav>
