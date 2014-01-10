(function ($) {
	
	$.fn.dropandpop = function(uploadUrl, onDrop, onComplete) {
		var $this = this;
		var isUploading = false;
		
		
		/*
		 * Add classes
		 */
		
		this.addClass('dropandpop');
		
		
		/*
		 * Helper functions
		 */
		
		var setUploading = function() {
			isUploading = true;
			$this.addClass('dropandpop-uploading');
		};
		
		var unsetUploading =  function() {
			isUploading = false;
			$this.removeClass('dropandpop-uploading');
		};
		
		
		/*
		 * Event handlers
		 */
		
		var updateProgressHandler = function() {

		};
		
		var transferCompleteHandler = function() {
			unsetUploading();
		};
		
		var transferFailedHandler = function() {
			unsetUploading();
		};
		
		var transferCanceledHandler = function() {
			unsetUploading();
		};
		
		var changeHandler = function(e) {
			e.preventDefault();
		}
		this.bind('change', changeHandler);
		
		var dropHandler = function(e) {
			e.preventDefault();
//			if (isUploading) return;
			
			$(this).removeClass('dropandpop-drag-over');
			setUploading();
			var files = e.originalEvent.target.files || e.originalEvent.dataTransfer.files;
			var xhr = new XMLHttpRequest();
			xhr.addEventListener("progress", updateProgressHandler, false);
			xhr.addEventListener("load", transferCompleteHandler, false);
			xhr.addEventListener("error", transferFailedHandler, false);
			xhr.addEventListener("abort", transferCanceledHandler, false);
			xhr.open('POST', uploadUrl, true);
			var formData = new FormData;
			for (var f = 0; f < files.length; f++) {
				formData.append('uploadedFiles[' + f + ']', files[f]);
			}
			xhr.send(formData);
		}
		this.bind('drop', dropHandler);
		
		var dragoverHandler = function(e) {
			e.preventDefault();
			$(this).addClass('dropandpop-drag-over');
		}
		this.bind('dragover', dragoverHandler);
		
		var dragleaveHandler = function(e) {
			e.preventDefault();
			$(this).removeClass('dropandpop-drag-over');
		}
		this.bind('dragleave', dragleaveHandler);
		
		
		return this;
	};
	
}(jQuery));