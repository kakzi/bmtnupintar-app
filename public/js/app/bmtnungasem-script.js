$( "#target_notif" ).change(function() {
    calculateSum();
});


$( "#tercapai_notif" ).change(function() {
    calculateSum();
});


function calculateSum() {
    // Get elements by name
    var input1 = document.getElementsByName('target_notif')[0].value;
    var input2 = document.getElementsByName('tercapai_notif')[0].value;

    // Convert the input values to numbers
    var number1 = parseFloat(input1);
    var number2 = parseFloat(input2);

    // Perform the calculation
    var sum = number1 + number2;

    // Set the result in the result input field
    document.getElementsByName('kurang_notif')[0].value = sum;
}