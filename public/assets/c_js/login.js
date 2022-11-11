$("#auth_login").click(function () {
    Swal.fire({
        title: "잠시만 기다려주세요.",
        allowEscapeKey: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
    $.ajax({
        type: "POST",
        url: "/api/v1/user/auth_check",
        data: {
            user_id: $("#user_id").val(),
            user_password: $("#user_password").val(),
        },
        success: function (res) {
            $.cookie("X-Token", res.data.XToken);
            $.cookie("H-Token", res.data.HToken);
            location.replace("/");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            let data = XMLHttpRequest.responseJSON;
            Swal.fire({
                icon: "error",
                title: `에러(${data.result.resultCd})`,
                text: data.result.advanceMsg,
            });
        },
    });
});
