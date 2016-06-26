<header class="header" role="banner">
    <div class="inner">
        <a href="$BaseHref" class="brand" rel="home">
			<% if $SiteConfig.CompanyLogo %>
				$SiteConfig.CompanyLogo.croppedImage(400,150)
			<% else %>
                <h1 class="header-title">$SiteConfig.Title</h1>
			<% end_if %>
        </a>
    </div>
	<% include Navigation %>
</header>
