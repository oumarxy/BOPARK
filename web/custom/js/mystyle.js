
//gestion preview image

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#previewIMG').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
};
$("#inputImage").change(function () {
    readURL(this);
    document.getElementById("uploadFile").value = this.value;
});

// gestion du plugin datedropper
$(".mydate").dateDropper({
    lang: 'fr',
    animate: true,
    format: 'd-m-Y'
});
$(".mytime").timeDropper({
    format: 'HH:mm',
    setCurrentTime: false
});


// gestion ajax info vehicule et conducteur

    var boFunction = {
        init: function (route, Id, watchElementDetails) {
            if (route === '' || watchElementDetails === '' || Id === '' || Id <= 0) {
                return null;
            }
            var Url = Routing.generate(route, {'id': Id});
            boFunction.globalChange(Url, watchElementDetails);

        },
        globalChange: function (UrlFormRoute, $tableauwEDetails) {

            $tableauwEDetails.empty(); // on vide la liste des détails
            $.ajax({
                type: 'GET',
                url: UrlFormRoute,
                dataType: 'json',
                success: function (data) {
                    $tableauwEDetails.append('<tbody>');
                    //console.log(data);
                    $.each(data, function (index, value) {
                        $tableauwEDetails.append('<tr><td style="text-transform: uppercase">' + index + '</td><td>' + value + '</td></tr>');
                    });
                    $tableauwEDetails.append('</tbody>');

                }
            });
        }
    };

    // watchElement = $('#selectionVehicule');
    $('#selectionVehicule').on('change', function () {
        var watchElementDetails = $('#detailsvehicule');
        var route = 'ajax_route_vehicule';
        boFunction.init(route, $(this).val(), watchElementDetails);
    });
    $('#selectionConducteur').on('change load', function () {
        var watchElementDetails = $('#detailsconducteur');
        var route = 'ajax_route_conducteur';
        boFunction.init(route, $(this).val(), watchElementDetails);
    });


