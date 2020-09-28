
//ADDING///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
    //adding equipment
    makeTotal();
    $("#buttonADD").click(function(){
        //getting the form
        var $form = $("#formADD");
        var $inputs = $form.find("input, select, textarea");
        var serializedData = $form.serialize();

        $inputs.prop("disabled", true);

        //ajax query (sending the post answer of the form) to checkequipment.php
        $.ajax({
            url: "checkEquipment.php",
            type: "POST",
            data: serializedData,

            //if an answer is received (an echo somewhere)
            success:function (response){

                //if the text received is "Success"
                if (response.indexOf("Success") >= 0)
                {
                    //validation for the user
                    $("#getChangeError").text("");
                    $("#getChangeSuccess").text("L'équipement a bien été ajouté"); 

                    //adding the equipment to the main table 
                    window.setTimeout(function(){
                        $('#formADD')[0].reset();
                        $inputs.prop("disabled", false);
                        $(function () {
                            $('#myModal').modal('toggle');
                        });
                        $("#getChangeSuccess").text("");
                        $('#tableMain tbody').append(response.split("|")[1]);
                        makeTotal();
                        refreshLine(response.split("|")[2]);
                    }, 1500);
                }
                //if the text received is different from "Success" = an error
                else
                {
                    $inputs.prop("disabled", false);
                    $("#getChangeError").text(response);
                }

            },
            //logging any error into the console
            error:function (resultat, statut, erreur){

                console.log(resultat, statut, erreur );
            }
            
        });
    });

//ADD TYPE///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////CHECKED

    //same than above but for adding a new type
    $("#buttonADD2").click(function(){
        var $form = $("#formADD2");
        var $inputs = $form.find("input");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);

        $.ajax({
            url: "checkType.php",
            type: "POST",
            data: serializedData,

            success:function (response){

                if(response.indexOf("Success") >= 0)
                {
                    $("#getChangeError2").text("");
                    $("#getChangeSuccess2").text("Le type à bien été ajouté à la liste"); 

                    window.setTimeout(function(){
                        $inputs.prop("disabled", false);
                        $('#myModal2').modal('toggle');
                        $("#getChangeSuccess2").text("");
                        $('#type').append(response.split("|")[1]);
                        $('#typeDelete').append(response.split("|")[1]);
                        $('#ddMenu').append(response.split("|")[2]);
                        if($lastModal == "#myModal")
                        {
                            $($lastModal).modal('toggle');
                        }
                        else
                        {
                            edit($lastID);
                        }
                    }, 1150);
                }
                else
                {
                    $inputs.prop("disabled", false);
                    $("#getChangeError2").text(response);
                }

            },

            error:function (resultat, statut, erreur){

                console.log(resultat, statut, erreur );
            }
            
        });
    });

//SEARCH BAR // TOTAL // COUNT COLUMNS // DRAW ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//search bar




//todo
$("#myInput").on("keyup", function() {
    showLines();
    var value = $(this).val().toLowerCase();
    if(value=="")
    {
        showLines(); 
    }
    else
    {
        $("#tableMain tbody tr:visible").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        makeTotal();
    }
    });
}); 






function makeTotal(){
    $(document).ready(function(){
        var $total = 0;
        $('#tableMain tr').each(function(index, tr){
            $trHere = $(this);
            if($(this).is(":visible")){
                $(this).find('td').each (function() {
                    if($(this).attr("id") == "price"){
                        $number = ($trHere).find('#number').html().split("x")[1];
                        $total += (parseInt($(this).html()) * parseInt($number));
                        $("#totalText").html($total+" CHF");
                    }
                }); 
            }
        });
    }); 
}

function changeImage($id){
    $(document).ready(function(){
        if($('#'+$id).attr("src")=="../../../ressources/images/eye.png")
        {
            $('#'+$id).attr("src", "../../../ressources/images/eyeclosed.png");
            deleteColumns($id);
        }
        else
        {
            $('#'+$id).attr("src", "../../../ressources/images/eye.png");
            addColumns($id);
            
        }
    }); 
}

function deleteColumns($id)
{
    for (var index in columns) {
        if("$"+$id == index)
        {
            columns[index] = false;
            $('#'+$id+"Title").addClass("d-none");
            $('.'+$id+"Content").addClass("d-none");
        }
    } 
}

function addColumns($id)
{
    for (var index in columns) {
        if("$"+$id == index)
        {
            columns[index] = true;
            $('#'+$id+"Title").removeClass("d-none");
            $('.'+$id+"Content").removeClass("d-none");
        }
    } 
}

function refreshLine($id)
{
    console.log(columns[index] + "  "+ index)
    for (var index in columns) {
        if(columns[index] == true)
        {
            $("#"+$id+' .'+index.split("$")[1]+"Content").removeClass("d-none");
        }
        else
        {
            $("#"+$id+' .'+index.split("$")[1]+"Content").addClass("d-none");
        }
    } 
}

//SORTING///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var toSearchFor = [];
//to check all check how .toggle works/////////////////////
function changeType(typeName)
{
    toSearchFor = [];
    $( "#tableMain tbody tr" ).hide();

    $("#ddMenu a").each(function( index ) {
        if($(this).hasClass("active"))
        {
            toSearchFor.push($(this).text());
        }
    });

    if($("#"+typeName).hasClass("active"))
    {
        $('#'+typeName).removeClass("active")
        const index = toSearchFor.indexOf($('#'+typeName).text());
        toSearchFor.splice(index, 1);
        if(toSearchFor.length == 0)
        {
            $( "#tableMain tbody tr" ).show();
        }
        else
        {
            showLines();
        }  
    }
    else
    {
        $('#'+typeName).addClass("active")
        toSearchFor.push($('#'+typeName).text());
        showLines();
    }
}

function showLines()
{
    $(toSearchFor).each(function( index, name ) {
        $("#tableMain tbody tr:hidden").filter(function () {
            $(this).toggle($(this).text().indexOf(name) > -1)
        });
    });
    if(toSearchFor.length == 0)
    {
        $("#tableMain tbody tr:hidden").show();
    }

    makeTotal();
}  

function sortTable(asc, column, special) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("tableMain");
    switching = true;
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[column];
            y = rows[i + 1].getElementsByTagName("TD")[column];
            //check if the two rows should switch place:
            if(special == '')
            {
                if(asc == true)
                {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                else
                {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            else if(special == "price")
            {
                if(asc == true)
                {
                    if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                else
                {
                    if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            else if(special == "number")
            {
                if(asc == true)
                {
                    if (parseInt(x.innerHTML.split("x")[1]) < parseInt(y.innerHTML.split("x")[1])) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                else
                {
                    if (parseInt(x.innerHTML.split("x")[1]) > parseInt(y.innerHTML.split("x")[1])) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

var lastUP = "";
var lastDown = "";

function changeMe($id, $className)
{
    if(lastUP != "")
    {
        if(lastUP == $className){}
        else{
            $("."+lastUP).attr("src", "../../../ressources/images/up-arrow-empty.png")
            $("."+lastUP).attr("id","upEmpty");
        }
    }
    if(lastDown != "")
    {
        if(lastDown == $className){}
        else{
            $("."+lastDown).attr("src", "../../../ressources/images/down-arrow-empty.png")
            $("."+lastDown).attr("id","downEmpty");
        }
    }
    if($id == "upEmpty")
    {
        lastUP = $className;
        lastDown = "";
        $("."+$className).attr("src", "../../../ressources/images/up-arrow.png");
        $("."+$className).attr("id","upFull");
    }
    if($id == "downEmpty")
    {
        lastDown = $className;
        lastUP = "";
        $("."+$className).attr("src", "../../../ressources/images/down-arrow.png");
        $("."+$className).attr("id","downFull")
    }
    /*if (id == "upEmpty") {
        if(lastUP == ""){
            $("."+lastUP).attr("src", "../../../ressources/images/up-arrow-empty.png")
            $("."+lastUP).attr("id","upEmpty");
        }
        else if (lastUP != ""){
            lastUP = className;
            lastDown = "";
            alert(("."+lastUP));
            $("."+className).attr("src", "../../../ressources/images/up-arrow.png");
            $("."+className).attr("id","upFull");
        }
    }

    if (id == "downEmpty") {
        if(lastDown != ""){
            $("."+lastDown).attr("src", "../../../ressources/images/down-arrow-empty.png")
            $("."+lastDown).attr("id","downEmpty")
        }
        else{
        lastDown = className;
        lastUP = "";
        $("#"+id).attr("src", "../../../ressources/images/down-arrow.png");
        $("#"+id).attr("id","downFull")
        }
    }*/
}

//EDITING///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on("click", ".parameters", function(){
    $lastID = $(this).attr('id');
    edit($lastID)
});
function edit($id)
{  
    $.ajax({
        url: "getInfos.php",
        type: "POST",
        data: {info:$id},

        success:function(response){
            $('#bodyEdit').html(response);
            $('#myModalEdit').modal('show');
        },

        error:function (resultat, statut, erreur){

            console.log(resultat, statut, erreur );
        }
    });
    $(".buttonEdit").prop('id', $id);
    $(".buttonDelete").prop('id', $id); 
}

$(document).on("click", ".buttonEdit", function(){
    var $form = $("#formEdit");
    var $inputs = $form.find("input");
    var serializedData = $form.serializeArray();
    var $idid = $lastID;
    $inputs.prop("disabled", true);
    serializedData.push({name:"info",value:$lastID})
    $.ajax({
        url: "editInfos.php",
        type: "POST",
        data: serializedData,
    
        success:function(response){

            if (response.indexOf("Success") >= 0)
                {
                    $("#getChangeErrorEdit").text("");
                    //validation for the user
                    $("#getChangeSuccessEdit").text("L'équipement a bien été modifié"); 
                    
                    //adding the equipment to the main table 
                    window.setTimeout(function(){
                        $('#formEdit')[0].reset();
                        $inputs.prop("disabled", false);
                        $(function () {
                            $('#myModalEdit').modal('toggle');
                        });
                        $("#getChangeSuccessEdit").text("");
                        //HEREHEREHEREHERE
                        $("tr#tr"+$idid).replaceWith(response.split("|")[1]);
                        makeTotal();
                        refreshLine(response.split("|")[2]);
                    }, 1500);
                }
                //if the text received is different from "Success" = an error
                else
                {
                    $inputs.prop("disabled", false);
                    $("#getChangeErrorEdit").text(response);
                }
        },

        error:function (resultat, statut, erreur){

            console.log(resultat, statut, erreur );
        }
    });
});

//DELETING EQUIPMENT///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on("click", ".buttonDelete", function(){
    $id = $(this).attr('id');
    $('#myModalConfirmation').modal('toggle') 
    $( ".buttonConfirmation" ).click( function() {
        $.ajax({
            url: "deleteEquipment.php",
            type: "POST",
            data: {info:$id},
    
            success:function(response){
                if(response == "success"){
                    $('#tr'+ $id).empty();
                    makeTotal();
                }
            },
    
            error:function (resultat, statut, erreur){
    
                console.log(resultat, statut, erreur );
            }
        });
        $(".buttonEdit").prop('id', $id);
    });
});

//DELETING TYPE///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on("click", "#buttonDeleteType", function(){
    var $form = $("#formDeleteType");
    var $inputs = $form.find("input");
    var serializedData = $form.serializeArray();
    $inputs.prop("disabled", true);

    $.ajax({
        url: "deleteType.php",
        type: "POST",
        data: serializedData,

        success:function(response){
            if (response.indexOf("success") >= 0)
            {
                $("#getErrorType").text("");
                $("#getChangeType").text("Le type à bien été supprimé"); 
                window.setTimeout(function(){
                    $inputs.prop("disabled", false);
                    $("#getChangeType").text("");
                    $('#myModalDeleteType').modal('toggle');
                    $($lastModal).modal('toggle');
                    $('#type option[value='+response.split("-")[1]+']').remove();
                    $('#typeDelete option[value='+response.split("-")[1]+']').remove();
                    $('#ddMenu #'+response.split("-")[1]).remove();
                }, 1150);
            }
            else
            {
                $inputs.prop("disabled", false);
                $("#getErrorType").text(response);
            }
        },

        error:function (resultat, statut, erreur){

            console.log(resultat, statut, erreur );
        }
    });
});

//RESET PASSWORD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
    $("#buttonSearch").click(function(){
        if(!$("#buttonSearch").hasClass("disabled"))
        {
            var $form = $("#formReset");
            var $inputs = $form.find("input");
            var serializedData = $form.serialize();

            $.ajax({
                url: "checkEmailName.php",
                type: "POST",
                data: serializedData,

                success:function (response){

                    if(response == "Success")
                    {
                        $("#messageReset").text("Un mail vous a été envoyé"); 
                        $('#buttonSearch').prop('disabled',true);
                    }
                    else
                    {
                        $inputs.prop("disabled", false);
                        $("#messageReset").text(response);
                    }

                },

                error:function (resultat, statut, erreur){

                    console.log(resultat, statut, erreur );
                }
                
            });
        }
    });
});

//SEND MAIL///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
    $("#buttonContact").click(function(){
            var $form = $("#contactForm");
            var $inputs = $form.find("input");
            var serializedData = $form.serialize();

            $.ajax({
                url: "checkContact.php",
                type: "POST",
                data: serializedData,

                success:function (response){

                    if(response == "Success")
                    {
                        $("#contactError").text("");
                        $("#contactSuccess").text("Votre mail a bien été envoyé"); 
                        $('#buttonContact').prop('disabled',true);
                    }
                    else
                    {
                        $inputs.prop("disabled", false);
                        $("#contactError").text(response);
                    }

                },

                error:function (resultat, statut, erreur){

                    console.log(resultat, statut, erreur );
                }
                
            });
    });
});