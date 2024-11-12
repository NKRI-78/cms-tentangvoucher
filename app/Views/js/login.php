<script>
$('input').keypress(function(event) {
    if (event.which == 13) { // 13 is the Enter key
        $("#btn-login").click(); // Trigger the login button click
    }
});

$("#btn-login").click(async function() {
    let data = new FormData()

    var username = $("#username").val()
    var password = $("#password").val()

    data.append('val', username)
    data.append('password', password)

    $("#btn-login").text('Loading...')

    await $.ajax({
        type: "POST",
        url: `${baseUrl}/auth/login`,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        success: function(response) {
            console.log(response);
            location.href = `${baseUrl}/admin/dashboard`
        },
        error: function(err) {
            $("#btn-login").text('Sign in');
            toastr.error('Username or password incorrect!')
        }
    })
})
</script>