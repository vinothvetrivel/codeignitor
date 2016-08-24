	 	<script src="{$BASEURL}js/bootstrap.min.js"></script>
	 	<script src="{$BASEURL}js/Jquery.dataTables.min.js"></script>
	 	<script src="{$BASEURL}js/DataTables.tableTools.min.js"></script>
	 	<script src="{$BASEURL}js/DataTables.responsive.min.js"></script>
	 	<script src="{$BASEURL}js/common.js"></script>
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
	</body>
</html>
