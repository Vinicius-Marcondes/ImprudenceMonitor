<script>
    var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/waves.js"></script>
<script src="../../js/wow.min.js"></script>
<script src="../../js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="../../js/jquery.scrollTo.min.js"></script>
<script src="../../assets/chat/moment-2.2.1.js"></script>
<script src="../../assets/jquery-sparkline/jquery.sparkline.min.js"></script>       
<script src="../../assets/jquery-detectmobile/detect.js"></script>
<script src="../../assets/fastclick/fastclick.js"></script>        
<script src="../../assets/jquery-slimscroll/jquery.slimscroll.js"></script>        
<script src="../../assets/jquery-blockui/jquery.blockUI.js"></script>                     
<!-- sweet alerts -->
<script src="../../assets/sweet-alert/sweet-alert.min.js"></script>
<script src="../../assets/sweet-alert/sweet-alert.init.js"></script>
<!-- flot Chart -->
<script src="../../assets/flot-chart/jquery.flot.js"></script>
<script src="../../assets/flot-chart/jquery.flot.time.js"></script>
<script src="../../assets/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="../../assets/flot-chart/jquery.flot.resize.js"></script>
<script src="../../assets/flot-chart/jquery.flot.pie.js"></script>
<script src="../../assets/flot-chart/jquery.flot.selection.js"></script>
<script src="../../assets/flot-chart/jquery.flot.stack.js"></script>
<script src="../../assets/flot-chart/jquery.flot.crosshair.js"></script>
<!-- Counter-up -->
<script src="../../assets/counterup/waypoints.min.js" type="text/javascript"></script>
<script src="../../assets/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- CUSTOM JS -->
<script src="../../js/jquery.app.js"></script>
<script src="../../assets/tagsinput/jquery.tagsinput.min.js"></script>
<script src="../../assets/toggles/toggles.min.js"></script>
<script src="../../assets/timepicker/bootstrap-timepicker.min.js"></script>
<script src="../../assets/timepicker/bootstrap-datepicker.js"></script>
<script type="../../text/javascript" src="assets/colorpicker/bootstrap-colorpicker.js"></script>
<script type="../../text/javascript" src="assets/jquery-multi-select/jquery.multi-select.js"></script>
<script type="../../text/javascript" src="assets/jquery-multi-select/jquery.quicksearch.js"></script>
<script src="../../assets/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script type="../../text/javascript" src="assets/spinner/spinner.min.js"></script>
<script src="../../assets/select2/select2.min.js" type="text/javascript"></script>
<script src="../../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/datatables/dataTables.bootstrap.js"></script>
<!-- Dashboard -->
<script src="../../js/jquery.dashboard.js"></script>
<!-- Chat -->
<script src="../../js/jquery.chat.js"></script>
<!-- Todo -->
<script src="../../js/jquery.todo.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').dataTable();
	} );
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>
<script>
	jQuery(document).ready(function() {
             
	// Tags Input
	jQuery('#tags').tagsInput({width:'auto'});
	// Form Toggles
	jQuery('.toggle').toggles({on: <?php echo "true"; ?>});

	// Time Picker
	jQuery('#timepicker').timepicker({defaultTIme: false});
	jQuery('#timepicker2').timepicker({showMeridian: false});
	jQuery('#timepicker3').timepicker({minuteStep: 15});

	// Date Picker
	jQuery('#datepicker').datepicker();
	jQuery('#datepicker-inline').datepicker();
	jQuery('#datepicker-multiple').datepicker({
		numberOfMonths: 3,
		showButtonPanel: true
	});
	
	//colorpicker start
	$('.colorpicker-default').colorpicker({
		format: 'hex'
	});
	$('.colorpicker-rgba').colorpicker();
	
	//multiselect start
	$('#my_multi_select1').multiSelect();
	$('#my_multi_select2').multiSelect({
		selectableOptgroup: true
	});
	$('#my_multi_select3').multiSelect({
		selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
		selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
		afterInit: function (ms) {
			var that = this,
			$selectableSearch = that.$selectableUl.prev(),
			$selectionSearch = that.$selectionUl.prev(),
			selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
			selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

			that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
				.on('keydown', function (e) {
					if (e.which === 40) {
						that.$selectableUl.focus();
						return false;
					}
				});
			that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
				.on('keydown', function (e) {
					if (e.which == 40) {
						that.$selectionUl.focus();
						return false;
					}
				});
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
        //spinner start
        $('#spinner1').spinner();
        $('#spinner2').spinner({disabled: true});
        $('#spinner3').spinner({value:0, min: 0, max: 10});
        $('#spinner4').spinner({value:0, step: 5, min: 0, max: 200});
        //spinner end

        // Select2
        jQuery(".select2").select2({
            width: '100%'
        });
    });
</script>