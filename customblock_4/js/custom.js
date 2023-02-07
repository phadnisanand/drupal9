(function ($, Drupal) {
  Drupal.behaviors.mycustomblock = {
    attach: function (context) {
      $("#edit-title").change(function (event) {
        var title = $(this).val();
        var endpoint = Drupal.url('ajaxresponse/' + title);
        Drupal.ajax({ url: endpoint }).execute();
        /*var jsonObjects = {title: $(this).val()};*/
       /* $.ajax({
          url: Drupal.url('ajaxresponse'),  
          type: 'POST',
          dataType: 'json',
          data: JSON.stringify(jsonObjects),
          success: function (response) {
            //console.log(response); 
            $("#temp").text(response.temp);
            $("#feels_like").text(response.feels_like);
            $("#temp_min").text(response.temp_min);
            $("#temp_max").text(response.temp_max);
            $("#location").text(response.location);
          }
        });*/


      });
    }
  };
})(jQuery, Drupal);
