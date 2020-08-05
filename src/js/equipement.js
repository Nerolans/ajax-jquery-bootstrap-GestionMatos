
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
    $.each(columns, function(index, value){
        if("$"+$id ==index)
        {
            columns.index = false;
            $('#'+$id+"Title").addClass("d-none");
            $('.'+$id+"Content").addClass("d-none");
        }
    });
}

function addColumns($id)
{
    $.each(columns, function(index, value){
        if("$"+$id == index)
        {
            columns.index = true;
            $('#'+$id+"Title").removeClass("d-none");
            $('.'+$id+"Content").removeClass("d-none");
        }
    });
}

function refreshLine($id)
{
    $.each(columns, function(index, value){
        console.log("#"+$id+' .'+index.split("$")[1]+"Content");
        if(value == true){
            $("#"+$id+' .'+index.split("$")[1]+"Content").removeClass("d-none");
        }
        else
        {
            $("#"+$id+' .'+index.split("$")[1]+"Content").addClass("d-none");
        }
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
            $count = 0;
            $("#ddMenu a").each(function( index ) {
                if($(this).hasClass("active"))
                {
                    $count +=1;
                }
            });
            if($count==0)
            {
                location.reload(true);
            }
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
                $('table tbody tr').remove();
                $('table tbody').append(response);
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
                        $("#contactSuccess").text("Un mail vous a été envoyé"); 
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