var arr = [];
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

$("#bank_check").click(function () {
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
        url: "/api/v1/user/bank_check",
        data: {
            bank_code: $("#bank_code").val(),
            bank_number: $("#bank_number").val(),
            money: $("#money").val(),
        },
        headers: {
            Authorization: "Bearer " + $.cookie("X-Token"),
        },
        success: function (res) {
            Swal.fire({
                html: `예금주 <b>${res.data.user_name}</b> 님이 맞습니까? 송금 금액: ${res.data.money} 원 <br> 계속 추가를 원하시면 <b>네</b> 를 눌러주세요`,
                icon: "success",
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "네",
                cancelButtonText: "아니요",
            }).then((result) => {
                if (result.isConfirmed) {
                    let data = {
                        bank_user: res.data.user_name,
                        bank_number: $("#bank_number").val(),
                        money: $("#money").val(),
                        bank_name: res.data.bankName,
                    };
                    arr.push(data);
                    $(".money_list").prepend(`<div class="row text-center mb-3">
                                        <div class="col-sm-3"><span
                                                class="border py-2 bg-light d-block mb-2 mb-lg-0">${
                                                    data.bank_user
                                                }</span></div>
                                        <div class="col-sm-4"><span
                                                class="border py-2 bg-light d-block mb-2 mb-lg-0">${
                                                    data.bank_number
                                                }</span></div>
                                        <div class="col-sm-4"><span
                                                class="border py-2 bg-light d-block">${comma(
                                                    data.money
                                                )} 원</span>
                                        </div>
                                    </div>`);
                    $("#bank_user").val("");
                    $("#money").val("");
                    $("#bank_code").val("");
                    $("#bank_number").val("");
                }
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            let data = XMLHttpRequest.responseJSON;
            Swal.fire({
                icon: "error",
                title: "에러코드 : " + data.result.resultCd,
                text: data.result.advanceMsg,
            });
        },
    });
});

$("#remittance_send").click(function () {
    if (arr == null || arr.length == 0) {
        Swal.fire("", "값이 없습니다.", "error");
        return;
    }
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
        url: "/api/v1/user/remittance_send",
        headers: {
            Authorization: "Bearer " + $.cookie("X-Token"),
        },
        data: {
            data: arr,
        },
        success: function (res) {
            alert("충전 신청이 완료 되었습니다.");
            location.replace("/history");
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
