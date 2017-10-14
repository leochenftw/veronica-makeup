<div class="tile is-ancestor">
    <div class="tile is-4 is-parent">
        <% loop $PhotoSets.limit(1, 0) %>
            <% with $SmartCover(portrait) %>
                <% include PhotoSetTile Link=$Up.Link %>
            <% end_with %>
        <% end_loop %>
    </div>
    <div class="tile is-8 is-vertical">
        <div class="tile">
            <div class="tile is-parent is-half">
            <% loop $PhotoSets.limit(1, 1) %>
                <% with $SmartCover(landscape) %>
                    <% include PhotoSetTile Link=$Up.Link %>
                <% end_with %>
            <% end_loop %>
            </div>
            <div class="tile is-parent is-half">
            <% loop $PhotoSets.limit(1, 2) %>
                <% with $SmartCover(landscape) %>
                    <% include PhotoSetTile Link=$Up.Link %>
                <% end_with %>
            <% end_loop %>
            </div>
        </div>
        <div class="tile is-parent">
            <% loop $PhotoSets.limit(1, 3) %>
                <% with $SmartCover(landscape) %>
                    <% include PhotoSetTile Link=$Up.Link %>
                <% end_with %>
            <% end_loop %>
        </div>
    </div>
</div>
<div class="tile is-ancestor">
    <div class="tile is-4 is-parent is-vertical">
        <% loop $PhotoSets.limit(1, 4) %>
            <% with $SmartCover(landscape) %>
                <% include PhotoSetTile Link=$Up.Link %>
            <% end_with %>
        <% end_loop %>
        <% loop $PhotoSets.limit(1, 5) %>
            <% with $SmartCover(portrait) %>
                <% include PhotoSetTile Link=$Up.Link %>
            <% end_with %>
        <% end_loop %>
        <% loop $PhotoSets.limit(1, 6) %>
            <% with $SmartCover(landscape) %>
                <% include PhotoSetTile Link=$Up.Link %>
            <% end_with %>
        <% end_loop %>
    </div>
    <div class="tile is-8 is-vertical">
        <div class="tile">
            <div class="tile is-parent">
            <% loop $PhotoSets.limit(1, 7) %>
                <% with $SmartCover(portrait) %>
                    <% include PhotoSetTile Link=$Up.Link %>
                <% end_with %>
            <% end_loop %>
            </div>
            <div class="tile is-vertical">
                <div class="tile is-parent">
                    <% loop $PhotoSets.limit(1, 8) %>
                        <% with $SmartCover(landscape) %>
                            <% include PhotoSetTile Link=$Up.Link %>
                        <% end_with %>
                    <% end_loop %>
                </div>
                <div class="tile is-parent">
                    <% loop $PhotoSets.limit(1, 9) %>
                        <% with $SmartCover(landscape) %>
                            <% include PhotoSetTile Link=$Up.Link %>
                        <% end_with %>
                    <% end_loop %>
                </div>
            </div>
        </div>
        <div class="tile is-parent">
            <% loop $PhotoSets.limit(1, 10) %>
                <% with $SmartCover(landscape) %>
                    <% include PhotoSetTile Link=$Up.Link %>
                <% end_with %>
            <% end_loop %>
        </div>
    </div>
</div>
<div class="tile is-ancestor">
    <div class="tile is-4 is-parent">
        <% loop $PhotoSets.limit(1, 11) %>
            <% with $SmartCover(landscape) %>
                <% include PhotoSetTile Link=$Up.Link %>
            <% end_with %>
        <% end_loop %>
    </div>
    <div class="tile is-8 is-parent">
        <% loop $PhotoSets.limit(1, 12) %>
            <% with $SmartCover(landscape) %>
                <% include PhotoSetTile Link=$Up.Link %>
            <% end_with %>
        <% end_loop %>
    </div>
</div>
