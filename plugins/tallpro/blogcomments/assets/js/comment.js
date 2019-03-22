$('#send-comment').click(function(){
    $(this).request('onComment', {
    	success: function(data) {

			$('#message').html(data.message);

			setTimeout(function() {
				$('#message').html('');
		    }, 5000);

	        var commentBlock = $('#all-comments');
	      	$('#tallpro_comments_comment-text').val('');
            if ($("#tallpro_comments_user_email").length !== 0) {
                $("#tallpro_comments_user_email").val('');
            }
            if ($("#tallpro_comments_user_name").length !== 0) {
                $("#tallpro_comments_user_name").val('');
            }

			// commentBlock.append($('<ul>').html(data.content));
			commentBlock.prepend(data.content);
	        // this.countIncrement()

    }});
})

$('.comment-reply').each(function(){
	$(this).click(function(e){
		e.preventDefault();

		var id = $(this).attr('data-id');

	console.log(id);

            // this.clearMessage();
            $('#comment-' + id).find('.comment-content').append($('#comment-form'));

	})
})
