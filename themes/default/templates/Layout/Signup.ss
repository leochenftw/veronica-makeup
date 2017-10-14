<% include InternalHero Size='medium' %>
<div class="section signup-form-wrapper">
    <div class="container">
        <% with $SignupForm %>
            <form $FormAttributes>
                <% if $Message %>
                <div class="message-wrapper has-text-centered $Message.MessageType">$Message</div>
                <% end_if %>
                <div class="fields">
                    <% loop $Fields %>
                        $FieldHolder
                    <% end_loop %>
                </div>

                <div class="Actions">
                    $Actions
                </div>
                <div class="lnk-signup-wrapper margin-h-10-0-0 text-center"><a href="/signin?backURL=/member">Sign in</a></div>
            </form>
            $clearMessage
        <% end_with %>
    </div>
</div>
