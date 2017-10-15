<section data-jarallax data-speed="0.2" class="jarallax hero is-<% if $Size %>$Size<% else %>large<% end_if %>" style="background-image: url($PageHero.Cropped.SetWidth(1920).URL);">
    <div class="hero-body">
        <div class="container">
            <header class="has-text-centered">
                <h1 class="title is-1">$SiteConfig.Title</h1>
                <p class="subtitle is-6">$SiteConfig.Tagline</p>
            </header>
            <div class="has-text-centered">
                <% if $CurrentMember %>
                    <a href="/member/action/purchased" class="button is-transparent is-outlined">Purchased items</a>
                <% else %>
                    <a href="/signup" class="button is-transparent is-outlined">Sign up</a>
                <% end_if %>
            </div>
        </div>
    </div>
</section>
