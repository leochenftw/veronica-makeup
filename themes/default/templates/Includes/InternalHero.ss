<section class="hero is-<% if $Size %>$Size<% else %>large<% end_if %> parallax-window" data-parallax="scroll" data-image-src="$PageHero.Cropped.SetWidth(1920).URL">
    <div class="hero-body">
        <div class="container">
            <header class="has-text-centered is-marginless">
                <h1 class="title is-1">$Title</h1>
                <p class="subtitle is-6">$SiteConfig.Tagline</p>
            </header>
        </div>
    </div>
</section>
