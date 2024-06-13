function generateSeatTable() {
    const seatMap = $('#seatTable');
    const selectedSeatInput = $('#selected-seat');
    
    const businessRows = 6; 
    const businessCols = 4; 
    const totalBusinessSeats = 24; 
    
    const economyCols = 6;  
    const totalEconomySeats = 180; 
    const totalEconomyRows = Math.ceil(totalEconomySeats / economyCols); 

    let seatNumber = 1; 

    for (let i = 1; i <= businessRows; i++) {
        const row = $('<tr></tr>');
        for (let j = 1; j <= businessCols; j++) {
            const seat = $('<td></td>');
            seat.addClass('available business');
            seat.data('seat', `B${seatNumber}`); 
            seat.text(seat.data('seat'));

            seat.on('click', function() {
                if (!seat.hasClass('unavailable')) {
                    $('#seatTable .selected').removeClass('selected');
                    seat.addClass('selected');
                    selectedSeatInput.val(seat.data('seat'));
                }
            });

            row.append(seat);
            seatNumber++;
        }
        seatMap.append(row);
    }

    seatNumber = 1;
    for (let i = 1; i <= totalEconomyRows; i++) {
        const row = $('<tr></tr>');
        for (let j = 1; j <= economyCols; j++) {
            if (seatNumber > totalEconomySeats) break; 
            const seat = $('<td></td>');
            seat.addClass('available economy');
            seat.data('seat', `E${seatNumber}`); 
            seat.text(seat.data('seat'));

            seat.on('click', function() {
                if (!seat.hasClass('unavailable')) {
                    $('#seatTable .selected').removeClass('selected');
                    seat.addClass('selected');
                    selectedSeatInput.val(seat.data('seat'));
                }
            });
            row.append(seat);
            seatNumber++;
        }
        seatMap.append(row);
    }
}

$(document).ready(function() {
    generateSeatTable();

    $("#seatTable td").each(function() {
        const value = $(this).text();
        if (occupiedSeats.includes(value)) {
            $(this).addClass("unavailable");
        }
    });

    $("#seatTable *").click(function() {
        const selectedSeat = $("#seatTable .selected");
        const value = $(selectedSeat).text();

        $("#chosenSeat").text(value);
        $("#seat").val(value);
        if (value.startsWith("B")) {
            $("#chosenClass").text("Business");
            $("#chosenPrice").text(businessPrice);
            $("#price").val(businessPrice);
        } else {
            $("#chosenClass").text("Economy");
            $("#chosenPrice").text(economyPrice);
            $("#price").val(economyPrice);
        }

        $("#buyButton").prop("disabled", false);
    });
})