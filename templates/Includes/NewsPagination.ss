<% if NewsItems.MoreThanOnePage %>
	<div id="PageNumbers">
		<p>
			<% if NewsItems.NotFirstPage %>
				<a class="prev" href="$NewsItems.PrevLink" title="View the previous page">Prev</a>
			<% end_if %>
		
			<span>
		    	<% loop NewsItems.PaginationSummary(4) %>
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
		
			<% if NewsItems.NotLastPage %>
				<a class="next" href="$NewsItems.NextLink" title="View the next page">Next</a>
			<% end_if %>
		</p>
	</div>
<% end_if %>