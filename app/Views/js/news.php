<script>
    var table = $('#data').DataTable({
        scrollX: true,
    });

    // async function Data() {

    //     table.clear().draw();

    //     await $.ajax({
    //         type: "POST",
    //         url: `${baseUrl}/admin/news/getData`,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: false,
    //         success: function(response) {
    //             var res = JSON.parse(response);

    //             var no = 1;

    //             var dataRows = res.body.results.map(element => {

    //                 return [
    //                     no++,
    //                     element.title ? capitalizeFirstLetter(element.title) : "-",
    //                     // element.banner_link ? `<img src='${element.banner_link}'>` : "-",
    //                     `<div class="send-panel"> 
    //                         <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="${baseUrl}/admin/news/edit/${element.id}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Event"><i class="ri-edit-line text-primary"></i></a></label>&nbsp;
    //                         <label class="ml-2 mb-0 iq-bg-primary rounded"><a onclick="DetailNews('${element.id}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Detail"> <i class="ri-list-check-2 text-primary"></i></a> </label>&nbsp;
    //                         <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DeleteNews(${element.id})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Event"> <i class="ri-delete-bin-line text-primary"></i></a></label>
    //                     </div>`
    //                 ]
    //             });

    //             table.rows.add(dataRows).draw();
    //         },
    //         error: function(err) {
    //             $(".loader-table").css({
    //                 "display": "none"
    //             });
    //             console.log(err);
    //         }
    //     });
    // }

    // Data();

    function capitalizeFirstLetter(string) {
        const words = string.split(' ');
        const output = words.map(word => {
            const firstLetter = word.substring(0, 1).toUpperCase();
            const rest = word.substring(1);

            return `${firstLetter}${rest}`
        })

        return output.join(' ')
    }

    CreateNews = async () => {
        var data = new FormData();
        var title = $("#title").val();
        var link = $("#link").val();
        var image = $('#imageNews')[0].files[0];
        var content = $("#froalaContent").val();

        console.log(content);

        // data.append('newsId', uuidv4())
        data.append('title', title);
        data.append('link', link);
        data.append('image', image);
        data.append('content', content);

        $("#createNews").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/news/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response);
                toastr.success('create news success');
                setInterval(function() {
                    window.top.location.href = `${baseUrl}/admin/news`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createNews").text('Submit');
            }
        });
    }

    UpdateNews = async () => {
        var data = new FormData();
        var newsId = $("#newsId").val();
        var title = $("#title").val();
        var link = $("#link").val();
        var image = $('#imageNews')[0].files[0];
        var content = $("#froalaContent").val();
        var imageOld = $("#imageOld").val();

        data.append('newsId', newsId);
        data.append('title', title);
        data.append('link', link);
        data.append('image', image);
        data.append('content', content);
        data.append('imageOld', imageOld);

        $("#updateNews").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/news/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response);
                toastr.success('update news success');
                setInterval(function() {
                    window.top.location.href = `${baseUrl}/admin/news`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateNews").text('Update');
            }
        });
    }

    DetailNews = async (newsId) => {
        $("#imageNews").removeAttr("src");
        $('#detailNews').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/news/detail/${newsId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);

                if (!data.body.imageUrl === "") {
                    $("#imageNews").attr('src', `../public/assets/images/image-default.png`).css("object-fit", "cover");
                } else {
                    $("#imageNews").attr('src', data.body.imageUrl);
                }
                $("#contentNews").html(data.body.description);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    function DeleteNews(id) {
        $.ajax({
            type: "DELETE",
            url: `${baseUrl}/admin/news/delete/${id}`,
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