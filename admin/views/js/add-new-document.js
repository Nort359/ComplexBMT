$(function() {
	var count = 0;

	$( '#add-document' ).click(function(event) {
		event.preventDefault();

		count++;

		var formDocument = '<div class="document col-md-12">'
						 + 		'<label for="compitation-document-title-' + count + '" class="col-md-6 lbl-input">Введите название документа: </label>'
						 + 		'<div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">'
	                     +      	'<div class="container-input">'
	                     +          	'<p class="input-placeholder">Название документа</p>'
	                     +          	'<input type="text"'
	                     +                 		'class="form-control"'
	                     +                 		'placeholder="Название документа"'
	                     +                 		'id="compitation-document-title-' + count + '"'
	                     +                 		'name="compitation-document-title-' + count + '">'
	                     +          	'<div class="input-undeline"></div>'
	                     +      	'</div>'
	                     +  	'</div>'
	                     +		'<label for="compitation-document-file-' + count + '" class="col-md-6 lbl-input">Загрузите документ: </label>'
	                     +		'<div class="col-md-6 col-md-offset-0 col-xs-10 col-xs-offset-1 element-input">'
		                 +          '<div class="container-input">'
		                 +              '<input type="file"'
		                 +                     'class="form-control"'
		                 +                     'placeholder="Загрузите изображение"'
		                 +                     'id="compitation-document-file-' + count + '"'
		                 +                     'name="compitation-document-file-' + count + '">'
		                 +          '</div>'
		                 +      '</div>'
						 + '</div>';



		$( '.documents' ).append( formDocument );
	});
}); // конец события ready