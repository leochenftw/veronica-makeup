<% if $CurrentMember.Purchased %>
    <div class="columns heading">
        <div class="column is-2 is-offset-7 item-download-pass has-text-centered">
            Download pass
        </div>
        <div class="column is-2 item-download-pass has-text-right">
            Extraction pass
        </div>
        <div class="column is-1 item-download has-text-right"></div>
    </div>
    <% loop $CurrentMember.Purchased %>
        <div class="columns item">
            <div class="column is-1 has-text-right only-image">$SmartCover('landscape').FillMax(41, 26)</div>
            <div class="column item-title"><a href="$Link">$Title</a></div>
            <div class="column is-2 item-download-pass has-text-centered">
                <% if $DownloadPass %>
                    $DownloadPass
                <% else %>
                    -
                <% end_if %>
            </div>
            <div class="column is-2 item-download-pass has-text-centered">
                <% if $ExtractPass %>
                    $ExtractPass
                <% else %>
                    -
                <% end_if %>
            </div>
            <div class="column is-1 item-download has-text-right">
                <a target="_blank" class="button is-small is-outlined is-success" href="$DownloadLink.URL">Download</a>
            </div>
        </div>
    <% end_loop %>
<% else %>
    <p>You haven't purchased anything</p>
<% end_if %>
