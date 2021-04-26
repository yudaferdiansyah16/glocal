let oTable = null;
function setValue(column, data){
	let index = '-1';
	switch (column) {
		case 't_job':
			$('.id_job').val(data.id_job);
			$('.no_job').val(data.no_job);
			$('.btn-search-customer').hide();
			$('.btn-clear-customer').show();
			oTable.ajax.reload( null, false );
			break;
		default:
			break;
	}
}

$(document).ready(function(){
	var todayDate = moment().startOf('day');
	var YM = todayDate.format('YYYY-MM');
	var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
	var TODAY = todayDate.format('YYYY-MM-DD');
	var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

	var calendarEl = document.getElementById('calendar');

	let events = [];

	function initCalendar() {
		var calendar = new FullCalendar.Calendar(calendarEl,
			{
				plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
				themeSystem: 'bootstrap',
				timeZone: 'UTC',
				//dateAlignment: "month", //week, month
				buttonText:
					{
						today: 'today',
						month: 'month',
						week: 'week',
						day: 'day',
						list: 'list'
					},
				eventTimeFormat:
					{
						hour: 'numeric',
						minute: '2-digit',
						meridiem: 'short'
					},
				navLinks: true,
				header:
					{
						left: 'prev,next today addEventButton',
						center: 'title',
						right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
					},
				footer:
					{
						left: '',
						center: '',
						right: ''
					},
				customButtons:
					{
						addEventButton:
							{
								text: '+',
								click: function()
								{
									var dateStr = prompt('Enter a date in YYYY-MM-DD format');
									var date = new Date(dateStr + 'T00:00:00'); // will be in local time

									if (!isNaN(date.valueOf()))
									{ // valid?
										calendar.addEvent(
											{
												title: 'dynamic event',
												start: date,
												allDay: true
											});
										alert('Great. Now, update your database...');
									}
									else
									{
										alert('Invalid date.');
									}
								}
							}
					},
				//height: 700,
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				views:
					{
						sevenDays:
							{
								type: 'agenda',
								buttonText: '7 Days',
								visibleRange: function(currentDate)
								{
									return {
										start: currentDate.clone().subtract(2, 'days'),
										end: currentDate.clone().add(5, 'days'),
									};
								},
								duration:
									{
										days: 7
									},
								dateIncrement:
									{
										days: 1
									},
							},
					},
				events: events,
				/*eventClick:  function(info) {
					$('#calendarModal .modal-title .js-event-title').text(info.event.title);
					$('#calendarModal .js-event-description').text(info.event.description);
					$('#calendarModal .js-event-url').attr('href',info.event.url);
					$('#calendarModal').modal();
					console.log(info.event.className);
					console.log(info.event.title);
					console.log(info.event.description);
					console.log(info.event.url);
				},*/
				/*viewRender: function(view) {
					localStorage.setItem('calendarDefaultView',view.name);
					$('.fc-toolbar .btn-primary').removeClass('btn-primary').addClass('btn-outline-secondary');
				},*/

			});

		calendar.render();
	}
	$.ajax({
		type: 'GET',
		url: _baseurl+"master/job/viewjson",
		dataType: 'json',
		success: function (response) {
			events = [];
			for (let i = 0; i < response.length; i++) {
				const job = response[i];
				events.push({
					title: job.no_job,
					url: '#',
					start: job.tanggal_job,
					end: job.due_date
				});
			}
			initCalendar();
		}
	});
});
