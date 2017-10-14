<section class="hero is-<% if $Size %>$Size<% else %>large<% end_if %> parallax-window" data-parallax="scroll" data-image-src="$PageHero.Cropped.SetWidth(1920).URL">
    <div class="hero-body">
        <div class="container">
            <header class="has-text-centered">
                <h1 class="title is-1">$Title</h1>
                <p class="subtitle is-4"><span>$Photos.Count</span> image<% if $Photos.Count > 1 %>s<% end_if %>, <span>$Cost</span> credit<% if $Cost > 1 %>s<% end_if %></p>
            </header>
            <% if $Purchased %>
                <div class="has-text-centered download-link-holder">
                    <a class="button is-outlined is-transparent" href="$DownloadLink.URL" target="_blank">Download</a>
                </div>
                <% if $DownloadPass || $ExtractPass %>
                    <p class="has-text-centered subtitle is-6 extra-info">
                        <% if $DownloadPass %>Download pass: <span>$DownloadPass</span><% if $ExtractPass %><br /><% end_if %><% end_if %>
                        <% if $ExtractPass %>Extraction pass: <span>$ExtractPass</span><% end_if %>
                    </p>
                <% end_if %>
            <% else %>
                <% if $isCarted %>
                    <div class="has-text-centered download-link-holder">
                        <a class="button is-outlined is-transparent" href="/cart">Check out</a>
                    </div>
                <% else %>
                    $Top.PurchaseForm
                <% end_if %>
            <% end_if %>
        </div>
    </div>
</section>
