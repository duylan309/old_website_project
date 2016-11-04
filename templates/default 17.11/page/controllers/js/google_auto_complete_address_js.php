<!-- Google autocomplete -->
<script>
  var autocomplete,autocomplete_location;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    administrative_area_level_2: 'long_name',
  };

  $(window).load(function() {
    initAutocomplete();
    function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete(
          (document.getElementById('autocomplete')),
          {types: ['geocode']});

      autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
      var place = autocomplete.getPlace();
      
      var long_address_value = '';
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          long_address_value += place.address_components[i][componentForm[addressType]]+', ';
        }
      }
     
     
      var lat = document.getElementById('lat');
      if (lat != null) {
        document.getElementById('lat').setAttribute("value",place.geometry.location.lat());
      }

      var lng = document.getElementById('lng');
      if (lng != null) {
        document.getElementById('lng').setAttribute("value",place.geometry.location.lng());
      }
      
      document.getElementById('autocomplete').value = long_address_value.slice(0, -2);
    
    }

    function fillInAddressLocation() {
      var place = autocomplete_location.getPlace();

      var long_address_value = '';
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          long_address_value += place.address_components[i][componentForm[addressType]]+', ';
        }
      }
     
      var lat = document.getElementById('lat_location');
      if (lat != null) {
        document.getElementById('lat_location').setAttribute("value",place.geometry.location.lat());
      }

      var lng = document.getElementById('lng_location');
      if (lng != null) {
        document.getElementById('lng_location').setAttribute("value",place.geometry.location.lng());
      }
      
      document.getElementById('autocomplete_add_location').value = long_address_value.slice(0, -2);
    
    }

    $('.add_location').click(function() {
         setupAutocomplete('autocomplete_add_location'); 
    });

    $('.location-select').click(function() {
      var $latSelect = $(this).attr('lat');       
      var $lngSelect = $(this).attr('lng');  
      var $lo      = $(this).attr('lo');   
      $("#lat").attr('value',$latSelect);  
      $("#lng").attr('value',$lngSelect);  
      $("#lo").attr('value',$lo);  
    });

    $( document ).ajaxComplete(function( event, xhr, settings ) {
      
      if(xhr.responseJSON.code != undefined){
        if(xhr.responseJSON.code == 990){
          setupAutocomplete('autocomplete_add_location'); 
        } 
      }

    });
  
    function setupAutocomplete($id) {
      autocomplete_location = new google.maps.places.Autocomplete((document.getElementById($id)),{types: ['geocode']});
      autocomplete_location.addListener('place_changed', fillInAddressLocation);
    }  


  });
  

  
  
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLEAPIKEY?>&libraries=places"></script>

