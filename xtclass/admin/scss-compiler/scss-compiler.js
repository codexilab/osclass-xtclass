// Horizontal scrolling
jQuery(function ($) {
    $.fn.hScroll = function (amount) {
        amount = amount || 1200;
        $(this).bind("DOMMouseScroll mousewheel", function (event) {
            let oEvent = event.originalEvent, 
                direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta, 
                position = $(this).scrollLeft();
            position += direction > 0 ? -amount : amount
            $(this).scrollLeft(position)
            event.preventDefault()
        })
    }
})

document.addEventListener("DOMContentLoaded", function(event) {
	$('.scroll-h-auto').hScroll(1350) // You can pass (optionally) scrolling amount
	
	// Handle work spaces (wrappers)
	const wrapperScss 	= document.getElementById('wrapper-scss')
	const tabScss 		= document.getElementById('tab-scss')
	const separator 	= document.getElementById('separator')
	const wrapperCss 	= document.getElementById('wrapper-css')
	const tabCss 		= document.getElementById('tab-css')

	function showScssEditor() {
		wrapperScss.classList.remove('flex-1')
		wrapperScss.classList.add('flex-5')

		wrapperCss.classList.remove('flex-5')
		wrapperCss.classList.add('flex-1')
	}

	function showCssEditor() {
		wrapperScss.classList.remove('flex-5')
		wrapperScss.classList.add('flex-1')

		wrapperCss.classList.remove('flex-1')
		wrapperCss.classList.add('flex-5')
	}

	function showBothEditors() {
		wrapperScss.classList.remove('flex-1')
		wrapperScss.classList.add('flex-5')

		wrapperCss.classList.remove('flex-1')
		wrapperCss.classList.add('flex-5')
	}

	if (localStorage.stateEditors == 'showScssEditor') {
		showScssEditor()
	} 

	if (localStorage.stateEditors == 'showCssEditor') {
		showCssEditor()
	}

	if (localStorage.stateEditors == 'showBothEditors') {
		showBothEditors()
	}

	tabScss.addEventListener('click', () => {
		showScssEditor()
		localStorage.setItem('stateEditors', 'showScssEditor')
	})

	tabCss.addEventListener('click', () => {
		showCssEditor()
		localStorage.setItem('stateEditors', 'showCssEditor')
	})

	separator.addEventListener('click', () => {
		showBothEditors()
		localStorage.setItem('stateEditors', 'showBothEditors')
	})

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
})