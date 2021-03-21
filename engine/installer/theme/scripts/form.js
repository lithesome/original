if (!defined(window.formObject)) {
	window.formObject = {
		uploadImage: function (event) {
			let parent = $(this).parent();
			let url = $(this).attr('data-action');
			let name = $(this).attr('data-name');
			let preview_block = $('.preview-image', parent);
			let formData = new FormData();

			if (this.files && this.files[0]) {
				formData.append(name, this.files[0]);
				formData.append('field_name', name);
				$.ajax({
					xhr: function () {
						parent.append('<div class="progress">\n' +
							'  <div class="progress-bar" role="progressbar" style="width:0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>\n' +
							'</div>');

						let xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", function (evt) {
							if (evt.lengthComputable) {
								let percentComplete = evt.loaded / evt.total;
								$('.progress .progress-bar', parent).css('width', percentComplete * 100 + '%');
							}
						}, false);
						return xhr;
					},
					type: "POST",
					url: url,
					cache: false,
					contentType: false,
					processData: false,
					data: formData,
					dataType: 'JSON',
					complete: function (response) {
						let content = response.responseJSON.content.image;
						let remove_link = response.responseJSON.content.remove_link;
						let upload_dir = response.responseJSON.content.upload_dir;
						preview_block.removeClass('d-none');
						if (defined(content)) {
							preview_block.html(
								'<div class="image-item d-inline-block position-relative" onclick="formObject.removeImage(this)">' +
								'<input type="hidden" data-url="' + remove_link + '" name="' + name + '" value="' + content + '">\n' +
								'<a class="close">\n' +
								'<span>×</span>\n' +
								'</a>\n' +
								'<div class="image">\n' +
								'<img src="' + upload_dir + '/medium/' + content + '">\n' +
								'</div>' +
								'</div>'
							);
						} else {
							preview_block.html('');
							$.each(response.responseJSON.content.errors, function (i, v) {
								preview_block.append('<div class="errors">' + v + '</div>');
							});
						}
						$('.progress', parent).remove();
					},
					error: function (error) {
						// alert(error.code);
					}
				});
			}
			return this;
		},
		uploadImages: function (event) {
			let self = this;
			let parent = $(this).parent();
			let url = $(this).attr('data-action');
			let name = $(this).attr('data-name');
			let preview_block = $('.preview-image', parent);
			let formData = new FormData();

			$.ajaxSetup({
				xhr: function () {
					parent.append('<div class="progress">\n' +
						'  <div class="progress-bar" role="progressbar" style="width:0" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>\n' +
						'</div>');

					let xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							let percentComplete = evt.loaded / evt.total;
							$('.progress .progress-bar', parent).css('width', percentComplete * 100 + '%');
						}
					}, false);
					return xhr;
				},
			});

			self.uploadNextFile = function (index) {
				if (this.files && this.files[index]) {
					let file = this.files[index];

					formData.append(name, file);
					formData.append('field_name', name);
					$.ajax({
						type: "POST",
						url: url,
						cache: false,
						contentType: false,
						processData: false,
						data: formData,
						dataType: 'JSON',
						complete: function (response) {
							let content = response.responseJSON.content.image;
							let remove_link = response.responseJSON.content.remove_link;
							let upload_dir = response.responseJSON.content.upload_dir;
							preview_block.removeClass('d-none');
							if (defined(content)) {
								if (empty($('input[value="' + content + '"]'))) {
									preview_block.append(
										'<div class="col mb-2" onclick="formObject.removeImage(this)">' +
										'<div class="image-item d-inline-block position-relative">' +
										'<input type="hidden" data-url="' + remove_link + '" name="' + name + '[]" value="' + content + '">\n' +
										'<a class="close">\n' +
										'<span>×</span>\n' +
										'</a>\n' +
										'<div class="image">\n' +
										'<img src="' + upload_dir + '/medium/' + content + '">\n' +
										'</div>' +
										'</div>' +
										'</div>'
									);
								}
							} else {
								$.each(response.responseJSON.content.errors, function (i, file) {
									preview_block.append('<div class="errors">' + file + '</div>');
								});
							}
							$('.progress', parent).remove();
							self.uploadNextFile(index + 1);
						},
						error: function (error) {
						}
					});
					return true;
				}
				return false;
			};
			self.uploadNextFile(0);
			return this;
		},
		lockBreakLine: function (event) {
			if (event.type === 'keypress' && event.keyCode === 13) {
				event.preventDefault();
			}
			let parent = $(this).parent();
			let variants = $('.select-options', parent);
			let text = $(this).text();
			variants.removeClass('d-none');

			$.each($('div', variants), function (i, v) {
				if ($(this).text().trim().toLowerCase().indexOf(text) === -1) {
					$(this).addClass('d-none');
				} else {
					$(this).removeClass('d-none');
				}
			});
			return this;
		},
		selectVariant: function (self) {
			let selectedVariants = $('.selected-variants');
			let selectOptions = $('.select-options');
			let selectField = $('.select-field');
			let id = $(self).attr('data-value');
			let parent = $(self).attr('data-parent');
			let field_name = $(self).parent().attr('data-name');
			let value = $(self).text();

			if (empty($('input[data-id=' + id + ']', selectedVariants))) {
				selectedVariants.append('<div class="col btn btn-light m-1" onclick="$(this).remove();$(\'.field-' + field_name + ' [data-value=' + id + ']\').show();">\n' +
					'<input data-id="' + id + '" type="hidden" class="form-control category" name="' + field_name + '[' + id + ']" value="' + value + '">\n' +
					'<a class="close">\n' +
					'<span>×</span>\n' +
					'</a>\n' +
					value +
					'</div>'
				);
			}

			if (!empty(parent)) {
				$('[data-value=' + parent + ']', selectOptions).click();
			}

			$('div', selectOptions).removeClass('d-none');
			selectOptions.addClass('d-none');
			selectField.text('');
			return this;
		},
		removeImage: function (selector) {
			let link = $('input', selector).attr('value');
			let imagesBlock = $(selector).closest('form');
			if (!empty(link)) {
				$.ajax({
					url: $('input', selector).attr('data-url'),
					data: {
						image: link
					},
					method: 'POST',
					dataType: 'JSON',
					complete: function (response) {
						$(selector).remove();
						$('#images-form-field .progress', imagesBlock).remove();
					}
				});
			}
		}
	};

	$(document).on('change', '#image-form-field input[type=file]', formObject.uploadImage);
	$(document).on('change', '#images-form-field input[type=file]', formObject.uploadImages);
	$(document).on('keypress click focus input', '.input[contenteditable]', formObject.lockBreakLine);
}