@if(isset($dt_filter))
    $.ajax({
        type: 'POST',
        url: jsonPath,
        data: exec_filter,
        beforeSend: function() {
        },
        success: function(data) {
            createHomepageGoogleMap(_latitude,_longitude,data);
        },
        error: function(e) {
            console.log(e)
        }
    });
@else
    $.getJSON(jsonPath)
        .done(function(json) {
            createHomepageGoogleMap(_latitude,_longitude,json);
        })
        .fail(function( jqxhr, textStatus, error ) {
            console.log(error);
        })
    ;
@endif