$(document).ready(() => {


    $('#part_input').on('change', () => {
        let partId = $('#part_input').val()
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/dashboard/item/${partId}`,
            success: function (response) {
                console.log(response)

                $('#info_part_img').attr("src", response.file_name)
                $('#info_part_name').html(response.part_name)
                $('#info_part_qty').html(response.qty)
                $('#info_part_job').html(response.part_job)
                $('#info_part_judge').html(response.part_judge)
            }
        })
    })

    $('#item_input').on('change', () => {
        let partId = $('#part_input').val()
        let itemCode = $('#item_input').val()
        let itemId = itemCode.slice(8, 20)        

        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/dashboard/item/${itemId}`,
            success: function (response) {
                $('#info_item_img').attr("src", response.file_name)
                $('#info_item_name').html(response.part_name)
                $('#info_item_qty').html(response.qty)
                $('#info_item_job').html(response.part_job)
                $('#info_item_judge').html(response.part_judge)
            }
        })

        setTimeout(() => {
            $.ajax({
                type: "GET",
                url: `http://localhost:8000/api/dashboard/item/${partId}/${itemId}`,
                success: function (response) {
                    console.log(response)
                    if(partId == itemId) {
                        $('#info_part_judge').html("OK")
                        $('#info_item_judge').html("OK")
                    } else {
                        $('#info_part_judge').html("NG")
                        $('#info_item_judge').html("NG")
                    }
                },
                
            })
        }, 3500)
    })
})