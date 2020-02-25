$(document).ready(function() {
  var showMorePosts = $('#show-more-posts');
  var showMoreProjects = $('#load-more-projects');
  var showMoreArchive = $('#load-more-archive');
  var currentPage = 1;

  showMorePosts.on('click', function (e) {
    e.preventDefault();

    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'get_news_posts',
        page: currentPage += 1,
      },
      success: function( result ) {
        // alert( result );
        var jsonData = JSON.parse(result);
        if (jsonData.success) {
          showMorePosts.before(jsonData.data);
        } else {
          if (!jsonData.data) {
            showMorePosts.hide();
          }
        }
      }
    });
  });

  showMoreProjects.on('click', function (e) {
    e.preventDefault();

    $.ajax({
      url: '/category/projects/page/'+(currentPage + 1)+'/',
      type: 'post',
      data: {
        action: 'get_projects_posts',
        page: currentPage += 1,
        get_vars: JSON.parse(ajaxpagination.get_vars),
      },
      success: function( result ) {
		  $('.project-gallery').append(result);
		  if(result.length < 100) { 
			 showMoreProjects.hide();
		  }
		/*
        var jsonData = JSON.parse(result);
        if (jsonData.success) {
          $('.project-gallery').append(jsonData.data);
        } else {
          if (!jsonData.data) {
            showMoreProjects.hide();
          }
        }*/
      }
    });
  });

  showMoreArchive.on('click', function (e) {
    e.preventDefault();

    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'get_archive_posts',
        page: currentPage += 1,
        get_vars: JSON.parse(ajaxpagination.get_vars),
      },
      success: function( result ) {
        var jsonData = JSON.parse(result);
        if (jsonData.success) {
          $('.project-gallery').append(jsonData.data);
        } else {
          if (!jsonData.data) {
            showMoreArchive.hide();
          }
        }
      }
    });
  });

  $(document).on('click', '.image-file-btn', function () {
    $(this).parent().find('[type="file"]').click();
  });

  $(document).on('change', '[type="file"]', function () {
    var testImg = $(this).parent().find('[type="file"] + img.test-img');
    var warning = $(this).parent().find('.form-group__upload_warning');
  
    try {
      var file = $(this).prop("files")[0];              

      if (file) {
        $(this).parent().find('.form-group__upload_pic span').text(file.name);

        var img = new Image();
        img.onload = function() {
          if (this.width < 1000 || this.height < 1400 || this.width > 1000 || this.height > 1400) {
            // alert(this.width + 'x' + this.height);
			$("#cabinet-form2 button[type=submit]").attr('disabled', true);
            warning.show();
          } else {
			  $("#cabinet-form2 button[type=submit]").attr('disabled', false);
            warning.hide();
          }
        }

        var fr = new FileReader();
        fr.onload = function () {
          img.src = fr.result;
        }
        fr.readAsDataURL(file);
      }
    } catch(e) {

    }
  });

  $('#project-file-btn').on('click', function () {
    $("#project-file").click();
  });

  $('#project-file').on('change', function () {
    try {
      var file = $(this).prop("files")[0];              

      if (file) {
        $('#project-file + .form-group__upload_pic span').text(file.name);
      }
    } catch(e) {

    }
  });

  $(document).on('click', 'body:not(.logged-in) .like', function(e) {
    $(this).addClass('like__disabled');
    $(this).append($('<span class="warning-popup">Для голосования необходима <a href="/login"><u>авторизоваться</u></a><span>'));
    
    timer_long = 1.5;
    
    count = 0;
    
    timer = function() {
      count = count + 1;
      if (count >= timer_long) {
        count = 0;
        clearInterval(counter);
        $('.like').removeClass('like__disabled');
        $('.warning-popup').remove();
        return;
      }
    };
    
    counter = setInterval(timer, 1000);
    
    timerStart = function() {
      return counter = setInterval(timer, 1000);
    };
  });

  $(document).on('click', '.warning-popup', function(e) {
    window.location = '/login';
  });

  $(document).on('click', '.like', function(e) {
    e.preventDefault();
    e.stopPropagation();
  });

  var modal = $('[data-remodal-id="modal-project"]').remodal({
    hashTracking: false,
  });

  $(document).on('click', '.project-gallery__img', function (e) {
    var id = $(this).data('id');
    $.ajax({
      url: ajaxpagination.ajaxurl,
      type: 'post',
      data: {
        action: 'get_project_post',
        id: id,
      },
      success: function( result ) {
        var jsonData = JSON.parse(result);
        if (jsonData.success) {
          console.log(jsonData);
          $('[data-remodal-action="close"]').after(jsonData.data);
          modal.open();
          flexsliderStart();
        } else {
          
        }
      }
    });
  });

  $(document).on('closed', '.remodal', function (e) {
    setTimeout(function () {
      $('.modal-project__block').remove();
      $('.modal-project__desc').remove();
    }, 500);
  });

  var imageCount = 1;
  $('#load-more-img').on('click', function (e) {
    imageCount++;
    var  template = '<div class="form-group__upload_wrapper">' +
        '<span class="form-group__upload_warning">Размер изображения не соответствует требованиям (1000x1400пикс)</span>'+
        '<button class="upload-btn image-file-btn" type="button">Загрузить</button>' +
        '<input type="file" name="image-file-' + imageCount + '" hidden accept=".png,.jpg">' +
        '<div class="form-group__upload_pic">' +
            '<img src="/wp-content/themes/bimproject/img/google-drive-image.png" alt="Изображение">'+
            '<span>Project.png</span>'+
        '</div>'+
    '</div>';
    if (imageCount <= 6) {
      $(this).parent().before(template);
    } else {
      $(this).hide();
    }
  });
});