//가맹점 추가
$("#req").click(function () {
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
        url: "/api/v1/user/franchisees_add",
        headers: {
            Authorization: "Bearer " + $.cookie("X-Token"),
        },
        data: {
            pk_id: $("#pk_id").val(),
            user_id: $("#user_id").val(),
            user_password: $("#user_password").val(),
            user_name: $("#user_name").val(),
            user_margin: $("#user_margin").val(),
        },
        success: function (res) {
            alert("가맹점 추가가 완료 되었습니다.");
            location.reload();
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
