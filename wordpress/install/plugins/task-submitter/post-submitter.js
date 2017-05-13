
jQuery( document ).ready( function ( $ ) {
    $( '#task-submission-form' ).on( 'submit', function(e) {
        e.preventDefault();
        var title = $( '#task-submission-title' );
        var status = 'draft';

        var data = {
            title: title.val(),
            status: 'todo'
        };

        $.ajax({
            method: "POST",
            url: POST_SUBMITTER.root + 'wp/v2/tasks',
            data: data,
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', POST_SUBMITTER.nonce );
            },
            success : function( response ) {
                console.log( response );
                title.val('');
                loadtasks();
            },
            fail : function( response ) {
                console.log( response );
                alert( POST_SUBMITTER.failure );
            }
        });
    });

    function loadtasks() {
      $.ajax({
        method: "GET",
        url: POST_SUBMITTER.root + 'wp/v2/tasks?status=completed,todo',
        beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', POST_SUBMITTER.nonce );
        },
        success : function (tasks) {
          var list = $( '#tasks-list' );

          list.empty();
          tasks.map(function(task) {
            $('<li/>')
              .text(task.title.rendered)
              .appendTo(list);
          });
        },
        fail : function (response) {
          console.debug( response )
        }
      })
    }

    loadtasks();

} );
