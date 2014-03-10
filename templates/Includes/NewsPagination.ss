<% if NewsItemsPaginated.MoreThanOnePage %>
	<div id="PageNumbers">
		<p>
			<% if NewsItemsPaginated.NotFirstPage %>
				<a class="prev" href="$NewsItemsPaginated.PrevLink" title="<% _t('NewsItemsPaginated.VIEWPREV', 'View the previous page') %>"><% _t('NewsItemsPaginated.PREV', 'Prev') %></a>
			<% end_if %>
		
			<span>
		    	<% loop NewsItemsPaginated.PaginationSummary(4) %>
				<% if CurrentBool %>
					$PageNum
				<% else %>
					<% if Link %>
						<a href="$Link" title="<% _t('NewsItemsPaginated.VIEWPAGE', 'View page') %> $PageNum">$PageNum</a>
					<% else %>
						&hellip;
					<% end_if %>
				<% end_if %>
			<% end_loop %>
			</span>
		
			<% if NewsItemsPaginated.NotLastPage %>
				<a class="next" href="$NewsItemsPaginated.NextLink" title="<% _t('NewsItemsPaginated.VIEWNEXT', 'View the next page') %>"><% _t('NewsItemsPaginated.NEXT', 'Next') %></a>
			<% end_if %>
		</p>
	</div>
<% end_if %>
