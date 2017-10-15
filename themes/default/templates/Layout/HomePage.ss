<% include HomeHero %>
<%-- <div class="section">
    <div class="container">
        <% include PhotoSetCovers %>
    </div>
</div> --%>
<section class="section">
    <div class="container">
        <h2 class="title is-3 has-text-centered">$PhotosTitle</h2>
        <p class="subtitle is-6 has-text-centered">
        <% loop $PhotoCategories %>
            <a href="/?tab=$Key">$Value</a><% if not $Last %> - <% end_if %>
        <% end_loop %>
        </p>
    </div>
</section>
