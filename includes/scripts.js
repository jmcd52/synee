// JavaScript Document
( function() {
	
	"use strict";
	
	$( document ).ready( function() {		
		
		$(".delete").on( "click", function( ) {
						
			//e.preventDefault();
			
			
			if ( confirm( "Are you sure you want to delete this post?" ) )
			{
				
				return true;
				
			} else {
				
				return false;
				
			}
			/*
			$.confirm({
				
				title: 'Wait...',
				
				content: 'Are you sure you want to delete this post?',
				
				buttons: {
					
					 formSubmit:  {
						text: 'Yes', 
						action: function() {
							
							//$.alert('Post Deleted!');
							return true;
							
						}
					},
					cancel: function () {
						$.alert('Cancelled!');
						//return false;
					},
					somethingElse: {
						text: 'Something else',
						btnClass: 'btn-blue',
						keys: ['enter', 'shift'],
						action: function(){
							$.alert('Something else?');
						}
					}
				}
				
			});
			*/
		});

	});
	
})();