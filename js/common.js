function common()
{
	this.validateProcess	= function(processName, formName, methodName)
	{
		if(!validation.getFormData(formName))
		{
			return false;
		}
		
		if (eval("typeof "+processName+" == 'function'"))
		{
			var processObj 			= 	new window[processName]();
			processObj.formName		=	formName;
			processObj.processName	=	processName;
			if(methodName==''){
				methodName = 'index';
			}
			if(!processObj[methodName]())
			{
				return false;
			}
		}
		return true;
	}

	this.triggerModal = function(id){
		$('#'+id).modal('show');
	}
	
	this.onReponse	=	function(processName,methodName)
	{	
		if (eval("typeof "+processName+" == 'function'"))
		{	
			var processObj 			= 	new window[processName]();
			processObj.processName	=	processName;
			if(!processObj[methodName]())
			{
				return false;
			}
		}
		return true;
	}
	
	this.call	=	function(url,dataVal,type)
	{
		var request	=	$.ajax({
					            url: url,
					            type: "POST",
					            data: dataVal
					        });

        request.done(function( dataResponse ) {
	        switch(type){
	        	case 'popup':
	        		if(dataResponse=='TIMEOUT'){
	        			window.location.reload();
	        		}
	        		else{
	        			$('#modalBody').html(dataResponse);
	        			common.generateTableView();
	        			common.triggerModal('modalDiv');
	        		}
	        	break;
	        	case 'innerHtml':
	        		if(dataResponse=='TIMEOUT'){
	        			window.location.reload();
	        		}
	        		else{
		        		$('#ajaxDiv').html(dataResponse);
		        		common.onReponse($('#processName').val());
		        	}
	        	break;
	        	case 'reload':
	        		window.location.reload();
	        	break;
	        	default:
	        		if(dataResponse=='TIMEOUT'){
	        			window.location.reload();
	        		}
	        		else{
	        			$('#ajaxReponse').val(dataResponse);
	        		}
	        	break;
	        }
	    });

	    request.fail(function( jqXHR, textStatus ) {
  			alert( "Request failed: " + textStatus );
		});
	}
	
	this.generateTableAjax	=	function(pageUrl,formData)
	{
	    $.fn.dataTable.pipeline = function ( opts ) {
		    // Configuration options
		    var conf = $.extend( {
		        pages: 5,     // number of pages to cache
		        url: '',      // script url
		        data: null,   // function or object with parameters to send to the server
		                      // matching how `ajax.data` works in DataTables
		        method: 'POST' // Ajax HTTP method
		    }, opts );
		 	
		    // Private variables for storing the cache
		    var cacheLower = -1;
		    var cacheUpper = null;
		    var cacheLastRequest = null;
		    var cacheLastJson = null;
		 
		    return function ( request, drawCallback, settings ) {
		        var ajax          = false;
		        var requestStart  = request.start;
		        var drawStart     = request.start;
		        var requestLength = request.length;
		        var requestEnd    = requestStart + requestLength;
		         
		        if ( settings.clearCache ) {
		            // API requested that the cache be cleared
		            ajax = true;
		            settings.clearCache = false;
		        }
		        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
		            // outside cached data - need to make a request
		            ajax = true;
		        }
		        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
		                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
		                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
		        ) {
		            // properties changed (ordering, columns, searching)
		            ajax = true;
		        }
		         
		        // Store the request for checking next time around
		        cacheLastRequest = $.extend( true, {}, request );
		 		
		        if ( ajax ) {
		            // Need data from the server
		            if ( requestStart < cacheLower ) {
		                requestStart = requestStart - (requestLength*(conf.pages-1));
		 
		                if ( requestStart < 0 ) {
		                    requestStart = 0;
		                }
		            }
		             
		            cacheLower = requestStart;
		            cacheUpper = requestStart + (requestLength * conf.pages);
		 
		            request.start = requestStart;
		            request.length = requestLength*conf.pages;
		 
		            // Provide the same `data` options as DataTables.
		            if ( $.isFunction ( conf.data ) ) {
		                // As a function it is executed with the data object as an arg
		                // for manipulation. If an object is returned, it is used as the
		                // data object to submit
		                var d = conf.data( request );
		                if ( d ) {
		                    $.extend( request, d );
		                }
		            }
		            else if ( $.isPlainObject( conf.data ) ) {
		                // As an object, the data given extends the default
		                $.extend( request, conf.data );
		            }
		 			
		            settings.jqXHR = $.ajax( {
		                "type":     conf.method,
		                "url":      conf.url,
		                "data":     request,
		                "dataType": "json",
		                "cache":    false,
		                "success":  function ( json ) {
		                    cacheLastJson = $.extend(true, {}, json);
		 
		                    if ( cacheLower != drawStart ) {
		                        json.data.splice( 0, drawStart-cacheLower );
		                    }
		                    json.data.splice( requestLength, json.data.length );
		                     
		                    drawCallback( json );
		                }
		            } );
		        }
		        else {
		            json = $.extend( true, {}, cacheLastJson );
		            json.draw = request.draw; // Update the echo for each response
		            json.data.splice( 0, requestStart-cacheLower );
		            json.data.splice( requestLength, json.data.length );
		 
		            drawCallback(json);
		        }
		    }
		};
		 
		$.fn.dataTable.Api.register( 'clearPipeline()', function () {
		    return this.iterator( 'table', function ( settings ) {
		        settings.clearCache = true;
		    } );
		} );

		$('#tableList').dataTable( {
	        "processing": true,
	        "serverSide": true,
	        "paging"	: true,
	        "searching"	: false,
	   		"ordering"	: false,
	   		"bLengthChange": false,
	        "ajax": $.fn.dataTable.pipeline( {
	            url 	: pageUrl,
	            pages 	: 5,
	            data 	: formData  // number of pages to cache
	        } )
	    } );
	}

	this.generateTableView	=	function()
	{
		$('#tableView').dataTable( {
	        "paging"    : false,
	        "searching" : false,
	        "ordering"  : false,
	        "bLengthChange": false,
	        "bInfo" : false,
	        "responsive": true
	    });
	}

	this.showCompany = function()
	{
		var accountId = $('#account_id').val();
		var option = "<option value=0>All</option>";
		for(var i=0; i<company.length;i++)
		{
			if(accountId==company[i]['account_id']){
				option +="<option value="+company[i]['company_id']+">"+company[i]['company_name']+"</option>"; 
			}
		}
		var $el = $("#company_id");
		$el.empty(); // remove old options
		$el.append(option);
	}
}
var common = new common;