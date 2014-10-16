	<link href="/../tablesorter/css/theme.bootstrap.css" rel="stylesheet">
	<!-- <link href="/../tablesorter/addons/pager/jquery.tablesorter.pager.css" rel="stylesheet"> -->
	
	<script src="/../tablesorter/js/jquery.tablesorter.min.js"></script>
	<script src="/../tablesorter/js/jquery.tablesorter.widgets.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$.extend($.tablesorter.themes.bootstrap, {
					// these classes are added to the table. To see other table classes available,
					// look here: http://twitter.github.com/bootstrap/base-css.html#tables
					table      : 'table table-striped', // bootstrap table class here
					caption    : 'caption',
					header     : 'bootstrap-header', // give the header a gradient background
					footerRow  : '',
					footerCells: '',
					icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
					sortNone   : 'bootstrap-icon-unsorted',
					sortAsc    : 'icon-chevron-up glyphicon glyphicon-chevron-up',     // includes classes for Bootstrap v2 & v3
					sortDesc   : 'icon-chevron-down glyphicon glyphicon-chevron-down', // includes classes for Bootstrap v2 & v3
					active     : '', // applied when column is sorted
					hover      : '', // use custom css here - bootstrap class may not override it
					filterRow  : '', // filter row class
					even       : '', // odd row zebra striping
					odd        : ''  // even row zebra striping
				});

				// call the tablesorter plugin and apply the uitheme widget
				$("table").tablesorter({
					// this will apply the bootstrap theme if "uitheme" widget is included
					// the widgetOptions.uitheme is no longer required to be set
					theme : "bootstrap",

					widthFixed: false,

					headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

					// widget code contained in the jquery.tablesorter.widgets.js file
					// use the zebra stripe widget if you plan on hiding any rows (filter widget)
					widgets : [ "uitheme", "filter", "zebra" ],

					widgetOptions : {
						// using the default zebra striping class name, so it actually isn't included in the theme variable above
						// this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
						zebra : ["even", "odd"],

						// reset filters button
						filter_reset : ".reset"

						// set the uitheme widget to use the bootstrap theme class names
						// this is no longer required, if theme is set
						// ,uitheme : "bootstrap"

					}
				})
				
				
				.tablesorterPager({

					// target the pager markup - see the HTML block below
					container: $(".ts-pager"),

					// target the pager page select dropdown - choose a page
					cssGoto  : ".pagenum",

					// remove rows from the table to speed up the sort of large tables.
					// setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
					removeRows: false,

					// output string - default is '{page}/{totalPages}';
					// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
					output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
				});

			
			
				// filter button demo code
				$('button.filter').click(function(){
					var col = $(this).data('column'),
						txt = $(this).data('filter');
					$('table').find('.tablesorter-filter').val('').eq(col).val(txt);
					$('table').trigger('search', false);
					return false;
				});

				
				// toggle zebra widget
				$('button.zebra').click(function(){
					var t = $(this).hasClass('btn-success');
					$('table')
						.toggleClass('table-striped')[0]
						.config.widgets = (t) ? ["uitheme", "filter"] : ["uitheme", "filter", "zebra"];
					$(this)
						.toggleClass('btn-danger btn-success')
						.find('i')
						.toggleClass('icon-ok icon-remove glyphicon-ok glyphicon-remove').end()
						.find('span')
						.text(t ? 'disabled' : 'enabled');
					$('table').trigger('refreshWidgets', [false]);
					return false;
				});
			

				$("table:first").tablesorter({
					theme : 'blue',
					// initialize zebra striping and resizable widgets on the table
					widgets: [ "zebra", "resizable" ],
					widgetOptions: {
						resizable_addLastColumn : true
					}
				});

				$("table:last").tablesorter({
					theme : 'blue',
					// initialize zebra striping and resizable widgets on the table
					widgets: [ "zebra", "resizable" ],
					widgetOptions: {
						resizable: true,
						// These are the default column widths which are used when the table is
						// initialized or resizing is reset; note that the "Age" column is not
						// resizable, but the width can still be set to 40px here
						resizable_widths : [ '10%', '10%', '40px', '10%', '100px' ]
					}
				});
			
		});
	</script>