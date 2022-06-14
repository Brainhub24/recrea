


// keeping the chat from the bottom
var dmcc = document.getElementById('display-messages-container-answers');
dmcc.scrollTop = dmcc.scrollHeight - dmcc.clientHeight;

// handles messages deletion
$('.delmsgbtn').on('click', function() {
        
    //update #comment_id_input in the popup form, 
    //based on data-comment_id added to the button from the first snippet
    $('#ques_id_input').val($(this).data('comment-id')); 

    $('#delmsg').modal('show'); //open the modal
});

// handles messages modification
$('.modmsgbtn').on('click', function() {
        
    //update #comment_id_input in the popup form, 
    //based on data-comment_id added to the button from the first snippet
    $('#modques-id-input').val($(this).data('comment-id')); 
    // showing the question in the popup 
    $('#ques-cont-input').val($(this).data('comment-content')); 

    $('#modmsg').modal('show'); //open the modal
});