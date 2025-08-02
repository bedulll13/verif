$(document).ready(() => {
    let itemId = "";
    const soundOk = new Audio("/audio/ok.mp3");
    const soundTidakCocok = new Audio("/audio/tidakCocok.mp3");
    const soundTelahDiscan = new Audio("/audio/telahDiscan.mp3");

    $('#part_input').focus();

    function extractCustomerCode() {
        return window.location.pathname.split("/")[1];
    }

    function parsePartId(customerCode, rawInput) {
        if (customerCode === "adm") return rawInput.slice(16, 26);
        if (customerCode === "yimm") return rawInput.slice(11, 25);
        if (customerCode === "hmi") return rawInput.slice(4, 14);
        if (customerCode === "sim-r2") return rawInput.slice(37, 48);
        if (customerCode === "sim-r4") return rawInput.slice(53, 68);
        return rawInput;
    }

    function parseItemId(customerCode, rawInput) {
        if (customerCode === "adm") return rawInput.slice(0, 11);
        if (customerCode === "yimm") return rawInput.slice(11, 25);
        if (customerCode === "hmi") return rawInput.slice(4, 14);
        if (customerCode === "sim-r2") return rawInput.slice(37, 48);
        if (customerCode === "sim-r4") return rawInput.slice(53, 68);
        return rawInput;
    }

    $('#part_input').on('change', () => {
        const customerCode = extractCustomerCode();
        const rawInput = $('#part_input').val();
        const partId = parsePartId(customerCode, rawInput);
        itemId = partId;

        let yimm_user = "", yimm_order_no = "";
        if (customerCode === 'yimm') {
            yimm_user = rawInput.slice(32, 36);
            yimm_order_no = rawInput.slice(38, 42);
        }

        console.log("Parsed Part ID:", partId);

        if (!partId || partId.trim() === "") {
            alert("Part ID kosong atau tidak valid.");
            return;
        }

        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/dashboard/item/${partId}`,
            success: function (response) {
                if (response === -1) {
                    soundTelahDiscan.play();
                    alert("Part sudah dicek hari ini!");
                    return;
                }

                $('#info_part_img').attr("src", response.file_name);
                $('#info_part_name').html(response.part_name);
                $('#info_part_qty').html(response.qty);
                $('#info_part_job').html(response.part_job);
                $('#info_part_judge').html(response.part_judge);
            },
            error: function (xhr) {
                console.log("Terjadi error saat load kanban", xhr);
            }
        });

        $('#item_input').focus();
    });

    $('#item_input').on('change', () => {
        const customerCode = extractCustomerCode();
        const rawInputpart = $('#part_input').val();
        const fullPartID = rawInputpart
        const partId = parsePartId(customerCode, rawInputpart);

        const rawInput = $('#item_input').val();
        const fullItemID = rawInput
        itemId = parseItemId(customerCode, rawInput);

        if (!itemId || itemId.trim() === "") {
            alert("Item ID kosong.");
            return;
        }

        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/dashboard/item/${itemId}`,
            success: function (response) {
                $('#info_item_img').attr("src", response.file_name);
                $('#info_item_name').html(response.part_name);
                $('#info_item_qty').html(response.qty);
                $('#info_item_job').html(response.part_job);
                $('#info_item_judge').html(response.part_judge);
            },
            error: function (xhr) {
                console.log("Terjadi error saat load item", xhr);
            }
        });

        setTimeout(() => {
            let apiUrl = "";

            if (customerCode === "yimm") {
                apiUrl = `http://localhost:8000/api/dashboard/item/${itemId}/${partId}/${rawInput}`;
            } else {
                apiUrl = `http://localhost:8000/api/${customerCode}/dashboard/item/${itemId}/${partId}/${fullItemID}/${fullPartID}`;
            }

            $.ajax({
                type: "GET",
                url: apiUrl,
                success: function (response) {
                    // Normalisasi dari GT-1442-001 → GT-1442001
                    const cleanPartId = partId.replace(/([A-Z]{2,})-(\d{4})-(\d{3})/, '$1-$2$3');
                    const cleanItemId = itemId.replace(/([A-Z]{2,})-(\d{4})-(\d{3})/, '$1-$2$3');

                    const isMatch = cleanPartId === cleanItemId;
                    console.log("Compare (normalized):", cleanPartId, cleanItemId, "->", isMatch);

                    if (isMatch) {
                        $('#info_part_judge').html("OK");
                        $('#info_item_judge').html("OK");
                        soundOk.play();
                    } else {
                        $('#info_part_judge').html("NG");
                        $('#info_item_judge').html("NG");
                        soundTidakCocok.play();
                        $('#fail_modal').removeClass("hidden");

                        $('#fail_button').on('click', () => {
                            const inputPass = $('#fail_input').val();
                            const correctPass = "leader123";
                            if (inputPass === correctPass) {
                                $('#fail_modal').addClass("hidden");
                            } else {
                                $('#fail_notice').removeClass("hidden");
                            }
                        });
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 488) {
                        soundTelahDiscan.play();
                        alert("Part telah discan.");
                        window.location.reload();
                        return;
                    }
                }
            });
        }, 1000);
    });
});
