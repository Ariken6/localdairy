<div class="homepage">
    <div class="jcarousel slider" data-jcarousel="true">
        <ul>
            <% loop $HomePageSlides %>
                <li class="slide" style="background-image:url('$Slide.URL')">
                    <div class="splash">
                        <div class="splash-title">$Title</div>
                        <div class="splash-content">$Content</div>
                    </div>
                </li>
            <% end_loop %>
        </ul>
        <div class="jcarousel-control prev"><</div>
        <div class="jcarousel-control next">></div>
    </div>
</div>