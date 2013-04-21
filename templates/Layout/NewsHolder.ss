<div id="NewsContent">
	<% if NewsItems %>
		<% loop NewsItems %>
			<% include NewsItemSummary %>
		<% end_loop %>
	<% else %>
		<h3><%t NewsHolder "NOENTRIES" %></h3>
	<% end_if %>
	<% include NewsPagination %>
</div>
