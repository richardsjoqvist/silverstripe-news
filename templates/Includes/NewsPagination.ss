<% if NewsItemsPaginated.MoreThanOnePage %>
	<div id="PageNumbers">
		<p>
			<% if NewsItemsPaginated.NotFirstPage %>
				<a class="prev" href="$NewsItemsPaginated.PrevLink" title="View the previous page">Prev</a>
			<% end_if %>
		
			<span>
		    	<% loop NewsItemsPaginated.PaginationSummary(4) %>
					<% if CurrentBool %>
						$PageNum
					<% else %>
						<% if Link %>
							<a href="$Link" title="View page number $PageNum">$PageNum</a>
						<% else %>
							&hellip;
						<% end_if %>
					<% end_if %>
				<% end_loop %>
			</span>
		
			<% if NewsItemsPaginated.NotLastPage %>
				<a class="next" href="$NewsItemsPaginated.NextLink" title="View the next page">Next</a>
			<% end_if %>
		</p>
	</div>
<% end_if %>