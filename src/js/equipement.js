
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
                        $('#tableMain').append(response.split("-")[1]);
                        makeTotal();
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
                        $('#formADD')[0].reset();
                        $inputs.prop("disabled", false);
                        $(function () {
                            $('#myModal2').modal('toggle');
                        });
                        $("#getChangeSuccess2").text("");
                        $('#type').append(response.split("-")[1]);
                    }, 1150);

                    $("#formADD").reload();
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

//SEARCH BAR // TOTAL///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //search bar
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tableMain tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        makeTotal();
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

//SORTING///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function changeType(typeName)
{
    var toSearchFor = [];

    $(document).ready(function(){
        if($('#'+typeName).hasClass("active"))
        {
            $('#'+typeName).removeClass("active")
        }
        else
        {
            $('#'+typeName).addClass("active");
        }

        $('.ddMenu a').each(function(){
            if($(this).hasClass("active"))
            {
                toSearchFor.push($(this).text());
            }
        });

        $.ajax({
            url: "typeChange.php",
            type: "POST",
            data: {info:toSearchFor},

            success:function(response){
                if(response.length == 0)
                {
                    location.reload(true);
                }
                else
                {
                    $('table tbody tr').remove();
                    $('table tbody').append(response);
                }
                makeTotal();
            },
            error:function (resultat, statut, erreur){

                console.log(resultat, statut, erreur );
            }            
        });


    });
}

//EDITING///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on("click", ".parameters", function(){
    $.ajax({
        url: "getInfos.php",
        type: "POST",
        data: {info:$(this).attr('id')},

        success:function(response){
            $('#bodyEdit').html(response);
            $('#myModalEdit').modal('show');
        },

        error:function (resultat, statut, erreur){

            console.log(resultat, statut, erreur );
        }
    });
    $(".buttonEdit").prop('id', $(this).attr('id'));
    $(".buttonDelete").prop('id', $(this).attr('id'));
});




$(document).on("click", ".buttonEdit", function(){
    var $form = $("#formEdit");
    var $inputs = $form.find("input");
    var serializedData = $form.serializeArray();
    var $idid = $(this).attr('id');
    $inputs.prop("disabled", true);
    serializedData.push({name:"info",value:$(this).attr('id')})
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
                        $("tr#tr"+$idid).replaceWith(response.split("-")[1]);
                        makeTotal();
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

//DELETING///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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