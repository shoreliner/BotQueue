<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th>Name</th>
		<th>Bot Status</th>
		<th>Last Seen</th>
		<th>Job</th>
		<th>Temps</th>
		<th>Status</th>
		<th>Elapsed</th>
		<th>ETA</th>
		<th colspan="2">Progress</th>
	</tr>
	</thead>
	<tbody>
	<% _ . each(collection, function (bot) { %>
		<tr>
			<td><a href="<%= bot . url %>"><%= bot . name %></a></td>
			<td>
				<div class="btn-group bot_status_button">
					<a id="bot_status_button_<%= bot . id %>"
					   class="btn btn-mini btn-bot-status btn-<%= bot . status_class %> dropdown-toggle"
					   data-toggle="dropdown" href="#">
						<span id="bot_status_txt<%= bot . id %>"><%= bot . status %></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<% _ . each(bot . menu, function (item) { %>
							<li><a href="<%= item . url %>"><i class="<%= item . icon %>"></i> <%= item . text %></a>
							</li>
						<% }) %>
					</ul>
				</div>
			</td>
			<td class="muted"><%= bot . last_seen %></td>
			<% if (typeof(bot . job) !== "undefined") { %>
				<td><a href="<%= bot . job . url %>"><%= bot . job . name %></a></td>
				<% if (bot . status == 'working') { %>
					<td>
						<% if (typeof(bot . temp_extruder) !== "undefined") { %>
							E: <%= bot . temp_extruder %>C /
						<% } %>
						<% if (typeof(bot . temp_bed) !== "undefined") { %>
							B: <%= bot . temp_bed %>C /
						<% } %>
						<% if (typeof(bot.temp_extruder) === "undefined" && typeof(bot.temp_bed) === "undefined") { %>
							n/a
						<% } %>
					</td>
				<% } else { %>
					<td class="muted">n/a</td>
				<% } %>
				<td><span class="label <%= bot . job . status_class %>"><%= bot . job . status %></span></td>
				<td class="muted"><%= bot . job . elapsed %></td>
				<td class="muted"><%= bot . job . estimated %></td>
				<td style="width:250px">
					<% if (bot . job . status == 'qa') { %>
						<% if (typeof(bot . job . qa_url) !== "undefined") { %>
							<div class="manage-job pull-right">
								<a class="btn btn-success btn-mini" href="<%= bot . job . qa_url %>/pass">PASS</a>
								<a class="btn btn-primary btn-mini" href="<%= bot . job . qa_url %>">VIEW</a>
								<a class="btn btn-danger btn-mini" href="<%= bot . job . qa_url %>/fail">FAIL</a>
							</div>
						<% } %>
					<% } else { %>
						<div class="progress progress-striped active" style="width: 250px">
							<div class="bar <%= bot . job . bar_class %>"
							     style="width: <%= bot . job . progress %>%"></div>
						</div>
					<% } %>
				</td>
				<td class="muted">
					<% if(typeof(bot.job.progress) !== "undefined") { %>
						<%= bot . job . progress %>%
					<% } else { %>
						100%
					<% } %>
				</td>
			<% } else if (bot . status == 'error') { %>
				<td colspan="7" class="muted"><span class="text-error"><%= bot . error_text %></span></td>
			<% } else { %>
				<td colspan="7" class="muted">&nbsp;</td>
			<% } %>
		</tr>
	<% }) %>
	</tbody>
</table>