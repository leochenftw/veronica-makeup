<section data-jarallax data-speed="0.2" class="jarallax hero is-<% if $Size %>$Size<% else %>large<% end_if %>" style="background-image: url($PageHero.Cropped.SetWidth(1920).URL);">
    <div class="hero-body">
        <div class="container">
            <header class="has-text-centered">
                <h1 class="title is-1">$SiteConfig.Title</h1>
                <p class="subtitle is-4">$SiteConfig.Tagline</p>
            </header>
            <div class="has-text-centered">
                <a href="/?anchor=gallery" class="button">View Gallery</a>
            </div>
        </div>
    </div>
</section>
