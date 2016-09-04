	 	<script src="{$BASEURL}js/Jquery-ui.js"></script>
	 	<script src="{$BASEURL}js/bootstrap.min.js"></script>
	 	<script src="{$BASEURL}js/Jquery.dataTables.min.js"></script>
	 	<script src="{$BASEURL}js/DataTables.tableTools.min.js"></script>
	 	<script src="{$BASEURL}js/DataTables.responsive.min.js"></script>
	 	<script src="{$BASEURL}js/common.js"></script>
	 	<script src="{$BASEURL}js/custom.js"></script>
	 	<script src="{$BASEURL}js/validation.js"></script>
	 	{assign var=file value=$FCPATH|cat:'js/'|cat:$processName|cat:'.js'}
	 	{if file_exists($file)}
	 	<script src="{$BASEURL}js/{$processName}.js"></script>
	 	{/if}	
	 	{literal}
	 	<script type="text/javascript">
	        $("[rel=tooltip]").tooltip();
	        $(function() {
	            $('.demo-cancel-click').click(function(){return false;});
	            $('#tableView').dataTable( {
			        "paging"    : false,
			        "searching" : false,
			        "ordering"  : false,
			        "bLengthChange": false,
			        "bInfo" : false,
			        "responsive": true
			    });
	        });
	    </script>
    	{/literal}
    	
    	<div id="modalDiv" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" id="modalBody">
					</div>
					<div class="modal-footer" id="modalFooter">
						<button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div id="alertDiv" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" id="alertBody">
					</div>
					<div class="modal-footer" id="modalFooter">
						<button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
