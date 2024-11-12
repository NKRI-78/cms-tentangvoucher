<script>
    var table = $('#data-event').DataTable();

    async function Data() {

        table.clear().draw();

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/event/getData`,
            cache: false,
            contentType: false,
            processData: false,
            data: false,
            success: function(response) {
                var res = JSON.parse(response);
                var no = 1;

                var dataRows = res.body.data.map(element => {

                    return [
                        no++,
                        element.title ? capitalizeFirstLetter(element.title) : "-",
                        `<div class="send-panel"> 
                            <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="${baseUrl}/admin/event/edit/${element.id}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Event"><i class="ri-edit-line text-primary"></i></a></label>&nbsp;
                            <label class="ml-2 mb-0 iq-bg-primary rounded"><a onclick="DetailEvent('${element.id}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Detail"> <i class="ri-list-check-2 text-primary"></i></a> </label>&nbsp;
                            <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="${baseUrl}/admin/event/delete/${element.id}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Event"> <i class="ri-delete-bin-line text-primary"></i></a></label>
                        </div>`
                    ]
                });

                table.rows.add(dataRows).draw();
            },
            error: function(err) {
                $(".loader-table").css({
                    "display": "none"
                });
                console.log(err);
            }
        });
    }

    Data();

    function capitalizeFirstLetter(string) {
        const words = string.split(' ');
        const output = words.map(word => {
            const firstLetter = word.substring(0, 1).toUpperCase();
            const rest = word.substring(1);

            return `${firstLetter}${rest}`
        })

        return output.join(' ')
    }

    CreateEvent = async () => {
        var data = new FormData();

        var title = $("#title").val();
        var eventDateStart = $("#eventDateStart").val();
        var eventDateEnd = $("#eventDateEnd").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var description = $("#description").val();
        var location = $("#location").val();
        var image = $('#picture')[0].files[0];

        // data.append('id', uuidv4());
        data.append('start', start);
        data.append('end', end);
        data.append('eventDateStart', eventDateStart);
        data.append('eventDateEnd', eventDateEnd);
        data.append('title', title);
        data.append('description', description);
        data.append('image', image);
        data.append('location', location);

        $("#createEvent").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/event/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create event success');
                setInterval(function() {
                    window.top.location.href = `${baseUrl}/admin/event`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createEvent").text('Submit');
            }
        });
    }

    UpdateEvent = async () => {
        var data = new FormData();

        var eventId = $("#eventId").val();
        var title = $("#title").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var eventDateStart = $("#eventDateStart").val();
        var eventDateEnd = $("#eventDateEnd").val();
        var description = $("#description").val();
        var image = $('#picture')[0].files[0];
        var location = $("#location").val();
        var oldImage = $('#OldImage').val();

        data.append('eventId', eventId);
        data.append('start', start);
        data.append('end', end);
        data.append('eventDateStart', eventDateStart);
        data.append('eventDateEnd', eventDateEnd);
        data.append('title', title);
        data.append('description', description);
        data.append('image', image);
        data.append('location', location);
        data.append('oldImage', oldImage);

        $("#updateEvent").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/event/postUpdate`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update event success');
                setInterval(function() {
                    window.top.location.href = `${baseUrl}/admin/event`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateEvent").text('Update');
            }
        });
    }

    DetailEvent = async (eventId) => {
        $("#imageEvent").removeAttr("src");
        $('#detailEvent').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/event/detail/${eventId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                console.log(data,'test');

                if (!data.body.picture === "") {
                    $("#imageEvent").attr('src', `../public/assets/images/image-default.png`).css("object-fit", "cover");
                } else {
                    
                    $("#imageEvent").attr('src', data.body.imageUrl);
                }
                $("#startDate").html(moment.utc(data.body.startDate).format('DD MMMM YYYY'));
                $("#endDate").html(moment.utc(data.body.endDate).format('DD MMMM YYYY'));
                $("#startEnd").html(data.body.start + " - " + data.body.end);
                $("#description").html(data.body.description);
                $("#location").html(data.body.address);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    // DeleteEvent = (id) => {

    //     $.ajax({
    //         type: "DELETE",
    //         url: `${baseUrl}/admin/event/delete`,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: JSON.stringify({
    //             id: id
    //         }),
    //         success: function(response) {
    //             toastr.success('update event success');
    //             Data();
    //         },
    //         error: function(err) {
    //             toastr.error('something went wrong');
    //         }
    //     });
    // }

    function DeleteEvent(id) {
        $.ajax({
            type: "DELETE",
            url: `${baseUrl}/admin/event/delete/${id}`,
            success: function(response) {
                // Handle respon sukses
                // Misalnya, refresh data setelah hapus
                Data();
            },
            error: function(err) {
                // Handle error
                console.error('Error:', err);
            }
        });
    }
</script>