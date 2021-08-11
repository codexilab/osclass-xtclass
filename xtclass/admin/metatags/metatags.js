/*document.addEventListener("DOMContentLoaded", function(event) {
	// Ace editor
	$(function() {
		$('textarea[data-editor]').each(function() {
			let textarea = $(this);
			let mode = textarea.data('editor')
			let editDiv = $('<div>', {
				position: 'absolute',
				class: textarea.attr('class')

			}).insertBefore(textarea)

			textarea.css('display', 'none')

			let editor = ace.edit(editDiv[0]);
			editor.renderer.setShowGutter(textarea.data('gutter'))
			editor.getSession().setValue(textarea.val())
			editor.getSession().setMode("ace/mode/" + mode)
			editor.setTheme("ace/theme/monokai")
			
			let readOnly = false
			if (mode == 'css') {
				readOnly = true
			}

			editor.setOptions({
		        enableBasicAutocompletion: true,
		        enableSnippets: true,
		        enableLiveAutocompletion: true,
		        showPrintMargin: false,
		        readOnly: readOnly
		    })

			textarea.closest('form').submit(function() {
				textarea.val(editor.getSession().getValue())
			})
		})
	})
})*/