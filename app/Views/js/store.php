<script>
    $('#province').change(function() {
        var provinceId = $(this).val();

        const city = provinceId;
        // const encodedCity = encodeURIComponent(city);

        $('#city').html('<option disabled selected>Select City</option>');

        if (provinceId) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getCity`,
                type: 'POST',
                data: {
                    provinceId: city
                },
                success: function(response) {
                    var cities = response;

                    cities.body.map(element => {
                        $('#city').append('<option value="' + element.name + '">' + element.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    $('#city').change(function() {

        var cityName = $(this).val();
        const district = cityName;
        // const encodedDistrict = encodeURIComponent(district);

        $('#district').html('<option disabled selected>Select City</option>');

        if (cityName) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getDistrict`,
                type: 'POST',
                data: {
                    city_name: district
                },
                success: function(response) {
                    var districtResponse = response;

                    districtResponse.body.map(element => {
                        $('#district').append('<option value="' + element.name + '">' + element.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    $('#district').change(function() {

        var districtName = $(this).val();
        var cityName = $('#city').val();

        $('#posCode').val('');

        const subdistrict = districtName;
        // const encodedSubdistrict = encodeURIComponent(subdistrict);

        $('#subdistrict').html('<option disabled selected>Select SubDistrict</option>');
        $('#posCode').val('');

        if (districtName) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getSubdistrict`,
                type: 'POST',
                data: {
                    district_name: subdistrict,
                    city_name: cityName
                },
                success: function(response) {
                    var districtResponse = response;

                    $('#posCode').val('');

                    districtResponse.body.map(element => {
                        $('#subdistrict').append('<option value="' + element.subdistricts_name + '" data-poscode="' + element.name + '">' + element.subdistricts_name + '</option>');
                        // $('#posCode').val(element.name);
                    });

                    $('#subdistrict').change(function() {
                        var selectedSubdistrict = $(this).find(':selected');
                        var posCode = selectedSubdistrict.data('poscode');

                        console.log(posCode, selectedSubdistrict, 'cek code');
                        $('#posCode').val(posCode);
                        $('#posCodeCreate').val(posCode);
                    });

                    // $('#subdistrict').off('change').on('change', function() {
                    //     var selectedSubdistrict = $(this).find(':selected');
                    //     var posCode = selectedSubdistrict.data('poscode');
                    //     console.log(posCode, selectedSubdistrict, 'cek 1');
                    //     $('#posCode').val(posCode);
                    // });
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil data kota: ", error);
                }
            });
        }
    });

    $('#subdistrict').change(function() {
        // var selectedSubdistrictName = $(this).val();
        // var selectedSubdistrictId = $(this).find(':selected').data('subdistrict-id');
        var districtName = $(this).val();
        var cityName = $('#city').val();

        // $('#posCode').val('');

        if (districtName) {
            $.ajax({
                url: `${baseUrl}/admin/officialStore/getSubdistrict`,
                type: 'POST',
                data: {
                    district_name: districtName,
                    city_name: cityName
                },
                success: function(response) {
                    // console.log("Response from server:", response);

                    var selectedSubdistrict = $('#subdistrict').find(':selected');
                    var posCode = selectedSubdistrict.data('poscode');

                    $('#posCode').val(posCode);
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan saat mengambil kode pos: ", error);
                }
            });
        }
    });

    let selectedLatitude = parseFloat(document.getElementById("latitude").value) || -6.200000;
    let selectedLongitude = parseFloat(document.getElementById("longitude").value) || 106.816666;

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: selectedLatitude,
                lng: selectedLongitude
            },
            zoom: 13,
            mapTypeControl: false,
        });

        const marker = new google.maps.Marker({
            position: {
                lat: selectedLatitude,
                lng: selectedLongitude
            },
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true,
        });

        const input = document.getElementById("pac-input");
        const autocomplete = new google.maps.places.Autocomplete(input, {
            fields: ["formatted_address", "geometry", "name"],
            strictBounds: false,
        });

        autocomplete.bindTo("bounds", map);

        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById("infowindow-content");
        infowindow.setContent(infowindowContent);

        autocomplete.addListener("place_changed", () => {
            infowindow.close();
            marker.setVisible(false);

            const place = autocomplete.getPlace();
            if (place.geometry && place.geometry.location) {
                selectedLatitude = place.geometry.location.lat();
                selectedLongitude = place.geometry.location.lng();

                // Set the updated latitude and longitude to input fields
                document.getElementById("latitude").value = selectedLatitude;
                document.getElementById("longitude").value = selectedLongitude;
            }

            selectedLatitude = place.geometry.location.lat();
            selectedLongitude = place.geometry.location.lng();

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            infowindowContent.children["place-name"].textContent = place.name;
            infowindowContent.children["place-address"].textContent = place.formatted_address;
            infowindow.open(map, marker);

            document.getElementById("latitude").value = selectedLatitude;
            document.getElementById("longitude").value = selectedLongitude;
            document.getElementById("pac-input").value = place.formatted_address;
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            // const geocoder = new google.maps.Geocoder();
            // const latlng = {
            //     lat: event.latLng.lat(),
            //     lng: event.latLng.lng()
            // };

            // geocoder.geocode({
            //     location: latlng
            // }, (results, status) => {
            //     if (status === 'OK') {
            //         if (results[0]) {
            //             const address = results[0].formatted_address;
            //             const name = results[0].address_components.find(component => component.types.includes('street_address'))?.long_name || 'No name found';

            //             document.getElementById("latitude").value = latlng.lat;
            //             document.getElementById("longitude").value = latlng.lng;
            //             document.getElementById("pac-input").value = address;
            //             infowindowContent.children["place-name"].textContent = name;
            //             infowindowContent.children["place-address"].textContent = address;
            //         } else {
            //             window.alert('No results found');
            //         }
            //     } else {
            //         window.alert('Geocoder failed due to: ' + status);
            //     }
            // });

            selectedLatitude = event.latLng.lat();
            selectedLongitude = event.latLng.lng();

            document.getElementById("latitude").value = selectedLatitude;
            document.getElementById("longitude").value = selectedLongitude;
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();
    });

    UpdateStore = async () => {
        let data = new FormData();

        var title = $("#title").val();
        var address = $("#pac-input").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var subdistrict = $("#subdistrict").val();
        let image = $('#imageStore')[0].files[0];
        let imageProfile = $('#imageProfile')[0].files[0];
        var latitude = document.getElementById("latitude").value;
        var longitude = document.getElementById("longitude").value;
        var posCode = $("#posCode").val();
        var photoOld = $("#photoOld").val();
        var bannerOld = $("#bannerOld").val();

        data.append('title', title);
        data.append('address', address);
        data.append('province', province);
        data.append('city', city);
        data.append('district', district);
        data.append('subdistrict', subdistrict);
        data.append('image', image);
        data.append('imageProfile', imageProfile);
        data.append('latitude', latitude);
        data.append('longitude', longitude);
        data.append('posCode', posCode);
        data.append('photoOld', photoOld);
        data.append('bannerOld', bannerOld);

        $("#updateStore").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/officialStore/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update store success');
                setInterval(function() {
                    // location.reload();
                    window.top.location.href = `${baseUrl}/admin/officialStore/status/confirmed`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateStore").text('Submit');
            }
        });
    }

    $('#title').on('input', function() {
        let inputValue = $(this).val();
        let capitalizedValue = inputValue.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
        $(this).val(capitalizedValue);
    });

    CreateStore = async () => {
        let data = new FormData();

        var title = $("#title").val();
        var address = $("#pac-input").val();
        var province = $("#province").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var subdistrict = $("#subdistrict").val();
        let image = $('#imageStore')[0].files[0];
        let imageProfile = $('#imageProfile')[0].files[0];
        var latitude = document.getElementById("latitude").value;
        var longitude = document.getElementById("longitude").value;
        var posCode = $("#posCode").val();

        data.append('title', title);
        data.append('address', address);
        data.append('province', province);
        data.append('city', city);
        data.append('district', district);
        data.append('subdistrict', subdistrict);
        data.append('image', image);
        data.append('imageProfile', imageProfile);
        data.append('latitude', latitude);
        data.append('longitude', longitude);
        data.append('posCode', posCode);

        $("#createStore").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/officialStore/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create store success');
                setInterval(function() {
                    // location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createStore").text('Submit');
            }
        });
    }
</script>