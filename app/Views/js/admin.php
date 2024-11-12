<?php

use Config\Services;

$session = Services::session();

?>
<script>
    function uuidv4() {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    $('#data').DataTable();

    $('#detailJoin').DataTable({
        "pageLength": 100
    });

    $('#dataCommerceConfiguration').DataTable({
        "scrollX": true
    });
    
    $(document).ready(function() {
        var table = $('#member').DataTable({
            responsive: true,
            // "responsive" : true,
            // "scrollX": true,
            // "scrollCollapse": true,
            "paging": true,
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'print'
            ],
            // pageLength: 2000,
        });
        new $.fn.dataTable.FixedColumns(table, {
            leftColumns: 2,
        });
    });

    DetailBanner = async (bannerId) => {
        $("#imageBanner").removeAttr("src");
        $('#detailBanner').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/banner/detail/${bannerId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                $("#imageBanner").attr('src', data.data.image);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    UpdateBanner = async (event) => {
        event.preventDefault();

        var data = new FormData();

        var bannerId = $("#bannerId").val();
        var name = $("#name").val();
        var image = $('#imageBanner')[0].files[0];
        var bannerOldImage = $("#bannerOldImage").val();

        console.log(bannerOldImage);

        data.append('bannerId', bannerId);
        data.append('name', name);
        data.append('image', image);
        data.append('bannerOldImage', bannerOldImage);

        $("#updateBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/banner/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update banner success');
                location.href = `${baseUrl}/admin/banner`;
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateBanner").text('Update');
            }
        });
    }

    $('#dataCommerceBanner').DataTable();
    $('#dataOrder').DataTable();
    $('#dataCampaign').DataTable();

    CreateCommerceBanner = async () => {
        let data = new FormData();
        var actionType = $("#actionType").val();
        var index = $("#index").val();
        var targetId = $("#targetId").val();
        let image = $('#imageBanner')[0].files[0];

        data.append('actionType', actionType);
        data.append('index', index);
        data.append('targetId', targetId);
        data.append('image', image);

        $("#createBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/commerce-banner/post-commerce-banner`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create banner success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createBanner").text('Submit');
            }
        });
    }

    DetailCommerceBanner = async (bannerId) => {
        $("#imageBanner").removeAttr("src");
        $('#detailBanner').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/commerce-banner/detail/${bannerId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                $("#imageBanner").attr('src', `${imageUrl + data.data.image.path}`);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    UpdateCommerceBanner = async () => {
        let data = new FormData();
        var bannerId = $("#bannerId").val();
        var actionType = $("#actionType").val();
        var index = $("#index").val();
        var targetId = $("#targetId").val();
        let image = $('#imageBanner')[0].files[0];

        data.append('bannerId', bannerId);
        data.append('actionType', actionType);
        data.append('index', index);
        data.append('targetId', targetId);
        data.append('image', image);

        $("#updateBanner").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/commerce-banner/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update banner success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateBanner").text('Submit');
            }
        });
    }

    CreateCampaign = async () => {
        let data = new FormData();
        var index = $("#index").val();
        var title = $("#title").val();
        var subtitle = $("#subtitle").val();
        var backgroundColor = $("#backgroundColor").val();
        var titleColor = $("#titleColor").val();
        var titleBgColor = $("#titleBgColor").val();
        var campaignType = $("#campaignType").val();
        var startDate = $("#startDate").val();
        var endDate = $("#endDate").val();
        let image = $("#imageCampaign")[0].files[0];
        var products = $('#products').val();

        data.append('index', index);
        data.append('image', image);
        data.append('title', title);
        data.append('subtitle', subtitle);
        data.append('backgroundColor', backgroundColor);
        data.append('titleBgColor', titleBgColor);
        data.append('titleColor', titleColor);
        data.append('campaignType', campaignType);
        data.append('startDate', startDate);
        data.append('endDate', endDate);
        data.append('products', products);

        $("#createCampaign").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/campaign/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create campaign success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCampaign").text('Submit');
            }
        });
    }

    CreateCategory = async () => {
        let data = new FormData();
        var name = $("#name").val();
        var type = $("#type").val();
        let image = $('#imageCategory')[0].files[0];

        data.append("categoryId", uuidv4())
        data.append('name', name);
        data.append('type', type);
        data.append('image', image);

        $("#createCategory").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/category/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create category success');
                setInterval(function() {
                    location.href = baseUrl + '/admin/category';
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCategory").text('Submit');
            }
        });
    }

    UpdateCategory = async () => {
        let data = new FormData();

        var categoryId = $("#categoryId").val();
        var name = $("#name").val();
        var type = $("#type").val();
        let image = $('#imageCategory')[0].files[0];
        let imageOld = $('#oldImage').val();

        data.append('categoryId', categoryId);
        data.append('name', name);
        data.append('type', type);
        data.append('image', image);
        data.append('imageOld', imageOld);

        $("#updateCategory").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/category/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update category success');
                setInterval(function() {
                    location.href = baseUrl + '/admin/category';
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateCategory").text('Submit');
            }
        });
    }

    DetailCategory = async (categoryId) => {
        $("#imageCategory").removeAttr("src");
        $('#detailCategory').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/category/detail/${categoryId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.data.picture !== "undefined" && data.data.picture !== "null") {
                    $("#imageCategory").attr('src', `${data.data.picture}`);
                } else {
                    $("#imageCategory").attr('src', `../public/assets/images/image-default.png`);
                }
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    UpdateConfiguration = async () => {
        let data = new FormData();
        var configId = $("#configId").val();
        var delayedSettlementWhenOrderCompletedInHours = $("#delayedSettlementWhenOrderCompletedInHours").val();
        var expiringOrderWhenNoRespondInHours = $("#expiringOrderWhenNoRespondInHours").val();
        var expiringTransactionWhenNotPaidInHours = $("#expiringTransactionWhenNotPaidInHours").val();
        var internalWalletAccount = $("#internalWalletAccount").val();
        var productChargePercentage = $("#productChargePercentage").val();
        var serviceCharge = $("#serviceCharge").val();

        data.append('configId', configId);
        data.append('delayedSettlementWhenOrderCompletedInHours', delayedSettlementWhenOrderCompletedInHours);
        data.append('expiringOrderWhenNoRespondInHours', expiringOrderWhenNoRespondInHours);
        data.append('expiringTransactionWhenNotPaidInHours', expiringTransactionWhenNotPaidInHours);
        data.append('internalWalletAccount', internalWalletAccount);
        data.append('productChargePercentage', productChargePercentage);
        data.append('serviceCharge', serviceCharge);

        $("#updateConfiguration").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/configuration/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update configuration success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateConfiguration").text('Submit');
            }
        });
    }

    CreateCourier = async () => {
        let data = new FormData();
        var courierId = $("#courierId").val();
        var checkPriceSupported = $("#checkPriceSupported").val();
        var checkResiSupported = $("#checkResiSupported").val();
        var name = $("#name").val();
        let image = $('#image')[0].files[0];

        data.append('name', name);
        data.append('courierId', courierId);
        data.append('checkPriceSupported', checkPriceSupported);
        data.append('checkResiSupported', checkResiSupported);
        data.append('image', image);

        $("#createCourier").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create courier success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCourier").text('Submit');
            }
        });
    }

    UpdateCourier = async () => {
        let data = new FormData();
        var courierId = $("#courierId").val();
        var checkPriceSupported = $("#checkPriceSupported").val();
        var checkResiSupported = $("#checkResiSupported").val();
        var name = $("#name").val();
        let image = $('#image')[0].files[0];

        data.append('name', name);
        data.append('courierId', courierId);
        data.append('checkPriceSupported', checkPriceSupported);
        data.append('checkResiSupported', checkResiSupported);
        data.append('image', image);

        $("#updateCourier").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update courier success');
                setInterval(function() {
                    location.reload();
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateCourier").text('Submit');
            }
        });
    }

    CreateCourierService = async () => {
        let data = new FormData();
        var courierId = $("#courierId").val();
        var name = $("#name").val();
        var code = $("#code").val();
        var type = $("#type").val();
        var minWeight = $("#minWeight").val();
        var estimateDays = $("#estimateDays").val();

        data.append('courierId', courierId);
        data.append('name', name);
        data.append('code', code);
        data.append('type', type);
        data.append('minWeight', minWeight);
        data.append('estimateDays', estimateDays);

        $("#createCourierService").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/post-service`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create courier service success');
                setInterval(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#createCourierService").text('Submit');
            }
        });
    }

    UpdateCourierService = async () => {
        let data = new FormData();
        var courierServiceId = $("#courierServiceId").val();
        var courierId = $("#courierId").val();
        var name = $("#name").val();
        var code = $("#code").val();
        var type = $("#type").val();
        var minWeight = $("#minWeight").val();
        var estimateDays = $("#estimateDays").val();

        data.append('courierServiceId', courierServiceId);
        data.append('courierId', courierId);
        data.append('name', name);
        data.append('code', code);
        data.append('type', type);
        data.append('minWeight', minWeight);
        data.append('estimateDays', estimateDays);

        $("#updateCourierService").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/courier/update-service`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update courier service success');
                setInterval(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateCourierService").text('Submit');
            }
        });
    }

    ChangePassword = async () => {
        let data = new FormData();
        var oldPassword = $("#oldPassword").val();
        var newPassword = $("#newPassword").val();
        var confirmNewPassword = $("#confirmNewPassword").val();

        data.append('oldPassword', oldPassword);
        data.append('newPassword', newPassword);
        data.append('confirmNewPassword', confirmNewPassword);

        $("#changePassword").text('Loading...');

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/setting/change-password`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('change password success');
                setInterval(function() {
                    location.reload();
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#changePassword").text('Submit');
            }
        });
    }

    UpdateUser = async (userId) => {
        let data = new FormData();
        var userId = userId;
        let fullname = $('#fullname').val();
        let no_member = $('#no_member').val();
        let address = $('#address').val();

        data.append('userId', userId);
        data.append('fullname', fullname);
        data.append('no_member', no_member);
        data.append('address', address);

        $("#updateUser").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/member/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update member success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/member`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateUser").text('Submit');
            }
        });
    }

    function HandleCheck(userId, month) {

        $.ajax({
            url: baseUrl + '/admin/membershipfee/add/' + userId + '/' + month,
            type: 'POST',
            data: false,
            contentType: false,
            processData: false,
            success: function(response) {
                toastr.success('update membershipfee success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/membershipfee`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateUser").text('Submit');
            }
        })
    }

    cancel = async (id) => {
        let data = new FormData();

        $("cancel").text('Loading');
        await $.ajax({
            type: "POST",
            url: baseUrl + '/admin/membershipfee/cancel/' + id,
            // url: `${baseUrl}/admin/membershipfee/cancel`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update membership success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/membershipfee`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateUser").text('Submit');
            }
        });

    }

    function PhotoSelfie(path) {
        $("#imageMember").removeAttr("src");
        $('#detailPhoto').modal('show');
        $("#imageMember").attr('src', `${apiUrl + path}`);
        $("#downloadFile").attr('href', '<?= base_url("admin/newmember/download?path=") ?>' + `${apiUrl + path}`);
    }
</script>