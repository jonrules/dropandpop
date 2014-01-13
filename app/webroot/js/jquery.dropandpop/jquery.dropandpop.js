(function ($) {
	
	$.fn.dropandpop = function(uploadUrl, onDrop, onComplete) {
		var $this = this;
		var isUploading = false;
		
		
		/*
		 * Add classes
		 */
		
		this.addClass('dropandpop');
		
		/* 
		 * Add elements
		 */
		
		this.append('<div class="dropandpop-progress-bar"></div>');
		
		
		/*
		 * Helper functions
		 */
		
		var setUploading = function() {
			isUploading = true;
			$this.addClass('dropandpop-uploading');
			$this.find('.dropandpop-progress-bar').css('left', '-100%').text('');
		};
		
		var unsetUploading =  function() {
			isUploading = false;
			$this.removeClass('dropandpop-uploading');
			$this.find('.dropandpop-progress-bar').css('left', '-100%').text('');
		};
		
		
		/*
		 * Event handlers
		 */
		
		var updateProgressHandler = function(e) {
			var complete = Math.round(e.loaded / e.total * 100);
			var left = complete - 100;
			$this.find('.dropandpop-progress-bar').css('left', left + '%').text(complete + '%');
		};
		
		var transferCompleteHandler = function() {
			if (onComplete) {
				onComplete($.parseJSON(this.responseText), this);
			}
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
			if (onDrop) {
				onDrop(files, e);
			}
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