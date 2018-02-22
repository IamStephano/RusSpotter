
//<![CDATA[
var mapOverlay;
var blackOverlay;
var textOverlay;

var placingMarker;

var map;
var newMarker;
var markersArray = [];

document.addEventListener('DOMContentLoaded', function() {
  initialize();
}, false);
      
function initialize() {
	map = new google.maps.Map(document.getElementById("map"), {
  	center: new google.maps.LatLng(56.166477, 10.1978439),
    zoom: 18,
    mapTypeId: 'roadmap'  
	});
	
	var infoWindow = new google.maps.InfoWindow;
	if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
	
	google.maps.event.addListener(map, 'click', function(event) {
	if(placingMarker){
    	placeMarker(event.latLng);
    	//addToDatabase(event.latLng);
	}
    });
    


/*	if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(function (position) {
             initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
             map.setCenter(initialLocation);
         });
     }*/
	
         
  /*var textBounds = new google.maps.LatLngBounds(
  	new google.maps.LatLng(56.40250000, 10.8955000),
    new google.maps.LatLng(56.40367000, 10.9006000));
      
    textOverlay = new google.maps.GroundOverlay('russpotter.png',textBounds);
    textOverlay.setMap(map);
*/
    // Get data as XML
    downloadUrl("lib/generatexml.php", function(data) {
  
		var xml = data.responseXML;
      	var rus = xml.documentElement.getElementsByTagName("rus");
      
		for (var i = 0; i < rus.length; i++) {
				
        
			if(rus[i].getAttribute("desc") === "rus"){
				var id = rus[i].getAttribute("id");
				var desc = rus[i].getAttribute("desc");
            	var point = new google.maps.LatLng(
					parseFloat(rus[i].getAttribute("lat")),
              		parseFloat(rus[i].getAttribute("lng")));
						
				var html = "<b>" + id + "</b>";
            	var rusMarker = new google.maps.Marker({
					map: map,
              		position: point,
              		icon: 'img/rus.png',
            	});
				
				markersArray.push(rusMarker);
				      
			}
                 
			//bindInfoWindow(rus, map, infoWindow, html);
        
		}
      
	});
	
	var markerCluster = new MarkerClusterer(map, markersArray,
    	{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    
    
	//$.post('checkmarkers.php');
  
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }


function downloadUrl(url, callback) {

	var request = window.ActiveXObject ?
			new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;
   
	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
  
}

var placed = false;
function placeMarker(location) {
  if(placed == false){
    newMarker = new google.maps.Marker({
        position: location, 
        map:map,
        title:'rus',
        draggable:true,
        icon:'img/rus.png',
    });

    //$.post('addmarker.php',{latitude:lat,longitude:long});
    placed = true;


    //map.setCenter(location);
  }
}

function addOrSaveMarker(event){
	if(placingMarker) {
		document.getElementById("spotted-button").firstChild.classList.remove('fa-check');
		document.getElementById("spotted-button").firstChild.classList.add('fa-male');
		if(newMarker){
			var lng = newMarker.position.lng;
			var lat = newMarker.position.lat;
			$.post('lib/addmarker.php', {latitude:lat,longitude:lng});
		}
		updateMarkers();
		placingMarker = false;
		placed = false;
	} else {
		placingMarker = true;
		document.getElementById("spotted-button").firstChild.classList.remove('fa-male');
		document.getElementById("spotted-button").firstChild.classList.add('fa-check');
	}
	
}

function clearMarkers() {
  for (var i = 0; i < markersArray.length; i++ ) {
    markersArray[i].setMap(null);
  }
  markersArray.length = 0;
}

function updateMarkers() {
	clearMarkers();
	
	downloadUrl("lib/generatexml.php", function(data) {
  
		var xml = data.responseXML;
      	var rus = xml.documentElement.getElementsByTagName("rus");
      
		for (var i = 0; i < rus.length; i++) {
				
        
			if(rus[i].getAttribute("desc") === "rus"){
				var id = rus[i].getAttribute("id");
				var desc = rus[i].getAttribute("desc");
            	var point = new google.maps.LatLng(
					parseFloat(rus[i].getAttribute("lat")),
              		parseFloat(rus[i].getAttribute("lng")));
						
				var html = "<b>" + id + "</b>";
            	var rusMarker = new google.maps.Marker({
					map: map,
              		position: point,
              		icon: 'img/rus.png',
            	});
				      
			}
                 
			//bindInfoWindow(rus, map, infoWindow, html);
        
		}
      
	});
}

window.setInterval(function(){
  updateMarkers();
}, 15000);


function doNothing() {}
