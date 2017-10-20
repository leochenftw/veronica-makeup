<% include HomeHero %>
<%-- <div class="section">
    <div class="container">
        <% include PhotoSetCovers %>
    </div>
</div> --%>
<section id="gallery" class="section">
    <div class="container">
        <h2 class="title is-2 has-text-centered">$PhotosTitle</h2>
        <p class="subtitle is-5 has-text-centered">
            <a class="gallery-tab button is-info is-active" href="/?tab=all">All</a>
        <% loop $PhotoCategories %>
            <a class="gallery-tab button is-info" href="/?tab=$Key">$Value</a>
        <% end_loop %>
        </p>
        <div class="ajax-content" data-endpoint="/api/v/1/pohto">
            <div class="ajax-list is-masonry"></div>
            <div class="ajax-nav has-text-centered"><a class="button is-primary">Load more</a></div>
        </div>
    </div>
</section>
<section id="about-me" class="section">
    <div class="container has-text-centered">
        <h2 class="title is-2">About Veronica</h2>
        <p class="subtitle is-5">A fashion stylist who is experienced in many ways</p>
        <div class="content">
            $Content
        </div>
    </div>
</section>
<section id="contact-form" class="section">
    <div class="container">
        <h2 class="title is-2 has-text-centered">$ContactTitle</h2>
        <p class="subtitle is-5 has-text-centered">
            <% loop $SiteConfig.SocialNetworkLinks.Sort('SortOrder ASC') %>
                <a class="button is-info icon $ExtraClass is-large"<% if $Network == 'wechat' %> data-lightbox="QR Code" data-title="Scan to add Veronica on WeChat"<% end_if %> href="$URL"<% if $Network != 'phone' %> target="_blank"<% end_if %>><i class="fa fa-$Network"></i></a>
            <% end_loop %>
        </p>
        <div class="content has-text-centered">$ContactContent</div>
        <div class="columns">
            <div class="column is-4">
                <div class="contact-form-image"<% if $ContactImage %> style="background-image: url($ContactImage.Cropped.SetWidth(500).URL);"<% end_if %>></div>
            </div>
            <div class="column is-8">
                $ContactForm
            </div>
        </div>
    </div>
</section>
