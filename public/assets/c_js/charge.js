let charge_data = [];

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

$("#charge_add").click(function () {
    let charge_name = $("#charge_name").val();
    let charge_money = $("#charge_money").val();

    if (charge_money == "" || charge_name == "") {
        Swal.fire("", "빈값이 존재합니다.", "error");
        return;
    }
    Swal.fire({
        html: `입금자명이 <b>${charge_name}</b> 님이 맞습니까? 입금 금액: ${comma(charge_money)} 원 <br> 계속 추가를 원하시면 <b>네</b> 를 눌러주세요`,
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
                bank_user: charge_name,
                money: charge_money,
            };
            charge_data.push(data);
            $(".money_list").prepend(`<div class="row text-center mb-3">
                                        <div class="col-sm-3"><span
                                                class="border py-2 bg-light d-block mb-2 mb-lg-0">${
                                                    data.bank_user
                                                }</span></div>
                                        <div class="col-sm-4"><span
                                                class="border py-2 bg-light d-block">${comma(
                                                    charge_money
                                                )} 원</span>
                                        </div>
                                    </div>`);
            $("#charge_name").val("");
            $("#charge_money").val("");
        }
    });
});

$("#charge_send").click(function () {
    if (charge_data == null || charge_data.length == 0) {
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
        url: "/api/v1/user/charge_send",
        headers: {
            Authorization: "Bearer " + $.cookie("X-Token"),
        },
        data: {
            data: charge_data,
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
